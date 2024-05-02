<?php

namespace App\Controllers;

use Framework\Database;

class ErrorController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * 404 not found error
     *
     * @return void
     */
    public static function notFound($message = 'Stranica ne postoji.')
    {
        //$brands = $this->db->query('SELECT * FROM brands')->fetchAll();
        http_response_code(404);
        loadView('error', ['status' => '404', 'message' => $message]);
    }

    /**
     * 403 unauthorized error
     *
     * @return void
     */
    public static function unauthorized($message = 'Nemate ovlasti za pregled traženog sadržaja.')
    {
        //$brands = $this->db->query('SELECT * FROM brands')->fetchAll();
        http_response_code(403);
        loadView('error', ['status' => '403', 'message' => $message]);
    }
}
