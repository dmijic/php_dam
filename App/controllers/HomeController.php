<?php

namespace App\Controllers;

use Framework\Database;

class HomeController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show homepage (load dashboard)
     *
     * @return void
     */
    public function index()
    {
        $brands = $this->db->query('SELECT * FROM brands')->fetchAll();
        $products = $this->db->query('SELECT * FROM products')->fetchAll();
        loadView('home', ['brands' => $brands, 'products' => $products]);
    }
}
