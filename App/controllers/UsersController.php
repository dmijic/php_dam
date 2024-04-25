<?php

namespace App\Controllers;

use Framework\Database;

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
        $brands = $this->db->query('SELECT * FROM brands')->fetchAll();
        $users = $this->db->query('SELECT * FROM users')->fetchAll();
        loadView('users/index', ['brands' => $brands, 'products' => $users]);
    }

    /**
     * Create new user
     *
     * @return void
     */
    public function create()
    {
        loadView('users/create');
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
}
