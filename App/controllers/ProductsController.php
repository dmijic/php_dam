<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\FileStorage;

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
        $brands = $this->db->query('SELECT * FROM brands')->fetchAll();
        loadView('products/create', ['brands' => $brands]);
    }

    /**
     * Store product in DB
     * 
     * @return void
     */
    public function store()
    {

        $allowedFields = ['name', 'product_description', 'product_image_url', 'brand_id', 'quantity', 'active_ingredients', 'suggested_use', 'remark'];
        $newProductData = array_intersect_key($_POST, array_flip($allowedFields));
        $newProductData = array_map('sanitize', $newProductData);
        $requiredFields = ['name', 'brand_id'];

        $storage = new FileStorage($_FILES, $_POST);

        foreach ($requiredFields as $field) {
            if (empty($newProductData[$field]) || !Validation::string($newProductData[$field])) {
                $errors[$field] = ucfirst($field) . ' je obavezan podatak';
            };
        }
        if (!Validation::image($_FILES)) {
            $errors['image'] = 'Prihvatljivi formati slika su .jpg, .jpeg i .png.';
        }
        if (!empty($errors)) {
            $brands = $this->db->query('SELECT * FROM brands')->fetchAll();
            loadView('products/create', ['brands' => $brands, 'errors' => $errors, 'product' => $newProductData]);
        } else {
            foreach ($newProductData as $field => $value) {
                $fields[] = $field;
            }

            $imageArrayKey = $storage->getImgKey();

            $fields[] = $imageArrayKey;

            $fields = implode(', ', $fields);

            $values = [];

            foreach ($newProductData as $field => $value) {
                if ($value === '') {
                    $newProductData[$field] = null;
                }
                $values[] = ':' . $field;
            }

            $values[] = ':' . $imageArrayKey;

            $values = implode(', ', $values);

            $query = "INSERT INTO products ({$fields}) VALUES ({$values})";

            $newProductData[$imageArrayKey] = $storage->returnImgUrl();

            $storage->uploadImage();

            $this->db->query($query, $newProductData);

            $_SESSION['success_message'] = "Dodan je novi proizvod: <strong>{$newProductData['name']}</strong>.";

            redirect('/products');
        }
    }
}
