<?php

namespace App\Controllers;

use Framework\Database;

class ClaimsController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show all claims
     *
     * @return void
     */
    public function index()
    {
        $ingredients = $this->db->query('SELECT * FROM ingredients')->fetchAll();
        $claims = $this->db->query('SELECT * FROM claims')->fetchAll();
        loadView('claims/index', ['ingredients' => $ingredients, 'claims' => $claims]);
    }

    /**
     * Create new claim
     *
     * @return void
     */
    public function create()
    {
        loadView('claims/create');
    }
}
