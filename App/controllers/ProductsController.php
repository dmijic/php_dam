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
        $brands = $this->db->query('SELECT * FROM brands')->fetchAll();
        $products = $this->db->query('SELECT * FROM products')->fetchAll();
        loadView('products/index', ['brands' => $brands, 'products' => $products]);
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
        $brands = $this->db->query('SELECT * FROM brands')->fetchAll();
        $products = $this->db->query('SELECT * FROM products WHERE brand_id = :brand', $params)->fetchAll();

        loadView('products/by_brand', ['brands' => $brands, 'products' => $products]);
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

    /**
     * Show single product
     *
     * @return void
     */
    public function single_product()
    {
        $id = $_GET['id'] ?? '';

        $params = [
            'id' => $id
        ];

        $brands = $this->db->query('SELECT * FROM brands')->fetchAll();
        $product = $this->db->query('SELECT * FROM products WHERE id = :id', $params)->fetch();
        $brand = $this->db->query('SELECT * FROM brands WHERE id = ' . $product->brand_id)->fetch();

        loadView('products/single_product', ['product' => $product, 'brand' => $brand, 'brands' => $brands]);
    }
}
