<?php

namespace App\Controllers;

use Framework\Database;

class BrandsController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show all brands
     *
     * @return void
     */
    public function index()
    {
        $brands = $this->db->query('SELECT * FROM brands')->fetchAll();
        loadView('brands/index', ['brands' => $brands]);
    }

    /**
     * Create new brand
     *
     * @return void
     */
    public function create()
    {
        loadView('brands/create');
    }
}
