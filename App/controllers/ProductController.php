<?php

namespace App\Controllers;

use Framework\Database;

class ProductController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show single product
     * 
     * @return void
     */
    public function index($params)
    {
        $product = $this->db->query('SELECT * FROM products WHERE id = :id', $params)->fetch();
        $brand = $this->db->query('SELECT * FROM brands WHERE id = ' . $product->brand_id)->fetch();

        loadView('products/single_product', ['product' => $product, 'brand' => $brand]);
    }

    /**
     * Show products by the brand
     *
     * @return void
     */
    public function by_brand()
    {
        $brand = $_GET['brand_id'] ?? '';

        $params = [
            'brand' => $brand
        ];
        $products = $this->db->query('SELECT * FROM products WHERE brand_id = :brand', $params)->fetchAll();

        loadView('products/by_brand', ['products' => $products]);
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
