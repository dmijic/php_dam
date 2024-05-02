<?php

namespace App\Controllers;

use Framework\Database;

class IngredientsController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show list of all ingredients
     *
     * @return void
     */
    public function index()
    {
        $ingredients = $this->db->query('SELECT * FROM ingredients')->fetchAll();
        $claims = $this->db->query('SELECT * FROM claims')->fetchAll();

        loadView('ingredients/index', ['ingredients' => $ingredients, 'claims' => $claims]);
    }

    /**
     * Add new ingredient
     *
     * @return void
     */
    public function create()
    {
        loadView('ingredients/create');
    }
}
