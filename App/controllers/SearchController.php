<?php

namespace App\Controllers;

use Framework\Database;

class SearchController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show search results
     * 
     * @return void
     */
    public function search()
    {
        $searchTerm = isset($_GET['searchTerm']) ? trim($_GET['searchTerm']) : '';
        $params = [
            'searchTerm' => "%{$searchTerm}%"
        ];
        $products = $this->db->query('SELECT * FROM products WHERE name LIKE :searchTerm', $params)->fetchAll();
        $brands = $this->db->query('SELECT * FROM brands WHERE brand_name LIKE :searchTerm', $params)->fetchAll();
        $ingredients = $this->db->query('SELECT * FROM ingredients WHERE name LIKE :searchTerm', $params)->fetchAll();
        $claims = $this->db->query('SELECT * FROM claims WHERE content LIKE :searchTerm', $params)->fetchAll();

        loadView('search/index', ['products' => $products, 'ingredients' => $ingredients, 'claims' => $claims, 'brands' => $brands, 'searchTerm' => $searchTerm]);
    }
}
