<?php

namespace App\Controllers;

use Framework\Database;

class ProductsController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show all products
     * 
     * @return void
     */
    public function index()
    {
        $products = $this->db->query('SELECT * FROM products')->fetchAll();
        loadView('products/index', ['products' => $products]);
    }

    /**
     * Show all products
     * 
     * @return void
     */
    public function by_brand($params)
    {
        $products = $this->db->query('SELECT * FROM products WHERE brand_id = :brand', $params)->fetchAll();
        loadView('products/index', ['products' => $products]);
    }

    /**
     * Create new product
     *
     * @return void
     */
    public function create()
    {
        loadView('products/create');
    }
}
