<?php

namespace App\Controllers;

use Framework\Database;

class SocialMediaController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show all posts
     * 
     * @return void
     */
    public function index()
    {
        $products = $this->db->query('SELECT * FROM products')->fetchAll();
        $posts = $this->db->query('SELECT * FROM posts')->fetchAll();
        loadView('social_media/index', ['products' => $products, 'posts' => $posts]);
    }

    /**
     * Show posts by the brand
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
        $posts = $this->db->query('SELECT * FROM posts WHERE brand_id = :brand', $params)->fetchAll();

        loadView('social_media/by_brand', ['products' => $products, 'posts' => $posts]);
    }

    /**
     * Create new post
     *
     * @return void
     */
    public function create()
    {
        loadView('social_media/create');
    }

    /**
     * Show single post
     *
     * @return void
     */
    public function single_post($params)
    {
        $product = $this->db->query('SELECT * FROM products WHERE id = :id', $params)->fetch();
        $brand = $this->db->query('SELECT * FROM brands WHERE id = ' . $product->brand_id)->fetch();
        $posts = $this->db->query('SELECT * FROM posts WHERE brand_id = :brand', $params)->fetchAll();

        loadView('social_media/single_post', ['product' => $product, 'brand' => $brand, 'posts' => $posts]);
    }
}
