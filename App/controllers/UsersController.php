<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;
use Framework\FileStorage;

class UsersController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show user page
     *
     * @return void
     */
    public function index()
    {
        $users = $this->db->query('SELECT * FROM users')->fetchAll();
        loadView('users/index', ['users' => $users]);
    }

    /**
     * Create new user
     *
     * @return void
     */
    public function create()
    {
        loadView('users/register');
    }

    /**
     * Show help page
     *
     * @return void
     */
    public function help()
    {
        loadView('users/help');
    }

    /**
     * Show account page
     *
     * @return void
     */
    public function account()
    {
        loadView('users/account');
    }

    /**
     * Show login page
     *
     * @return void
     */
    public function login()
    {
        loadView('users/login');
    }

    /**
     * Store user in db
     *
     * @return void
     */
    public function store()
    {
        $storage = new FileStorage($_FILES, $_POST);

        $name = $_POST['name'];
        $imageKey = $storage->getImgKey();
        $user_img_url = $storage->returnImgUrl();
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];
        $role = 'default';
        $terms = $_POST['terms'];

        if (!Validation::email($email)) {
            $errors['email'] = 'Upišite ispravnu email adresu.';
        }

        if (!Validation::string($name, 2, 50)) {
            $errors['name'] = 'Ime mora biti između 2 i 50 znakova.';
        }

        if (!Validation::string($username, 2, 50)) {
            $errors['username'] = 'Korisničko ime mora biti između 2 i 50 znakova.';
        }

        if (!Validation::string($password, 8, 50)) {
            $errors['password'] = 'Lozinka mora sadržavati najmanje 8 znakova.';
        }

        if (!Validation::match($password, $password_confirmation)) {
            $errors['password_confirmation'] = 'Lozinke se ne podudaraju.';
        }

        if (!empty($errors)) {
            loadView('users/register', [
                'errors' => $errors,
                'user' => [
                    'name' => $name,
                    'email' => $email,
                    'username' => $username
                ]
            ]);
            exit;
        } else if ($terms != 1) {
            $errors['terms'] = 'Morate prihvatiti uvjete korištenja.';
            loadView('users/register', [
                'errors' => $errors,
                'user' => [
                    'name' => $name,
                    'email' => $email,
                    'username' => $username
                ]
            ]);
            exit;
        }

        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if ($user) {
            $errors['email'] = 'Email adresa je već registrirana.';
            loadView('users/register', [
                'errors' => $errors
            ]);
            exit;
        }

        // Create user account
        $params = [
            'name' => $name,
            'email' => $email,
            'user_img_url' => $user_img_url,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role
        ];

        $storage->uploadImage();

        $this->db->query('INSERT INTO users (name, email, username, password, role, user_img_url) VALUES (:name, :email, :username, :password, :role, :user_img_url)', $params);

        // Get new user ID
        $userId = $this->db->conn->lastInsertId();

        Session::set('user', [
            'id' => $userId,
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'role' => $role,
            'user_img_url' => $user_img_url
        ]);

        redirect('/');
    }

    /**
     * Logout user and kill session
     * 
     * @return void
     */
    public function logout()
    {
        Session::clearAll();
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);
        redirect('/');
    }

    /**
     * Authenticate user
     * 
     * @return void
     */
    public function authenticate()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $errors = [];

        if (!Validation::string($username, 2, 50)) {
            $errors['username'] = 'Korisničko ime mora sadržavati najmanje 2 znaka.';
        }

        if (!Validation::string($password, 8, 50)) {
            $errors['password'] = 'Lozinka mora sadržavati najmanje 8 znakova.';
        }

        // Check for errors
        if (!empty($errors)) {
            loadView('users/login', [
                'errors' => $errors
            ]);
            exit;
        }

        //Check for username in db
        $params = [
            'username' => $username
        ];

        $user = $this->db->query('SELECT * FROM users WHERE username = :username', $params)->fetch();

        if (!$user) {
            $errors['username'] = 'Neispravni podaci.';
            loadView('users/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // Check if password is correct
        if (!password_verify($password, $user->password)) {
            $errors['username'] = 'Neispravni podaci.';
            loadView('users/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // Login
        Session::set('user', [
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
            'user_img_url' => $user->user_img_url
        ]);

        redirect('/');
    }
}
