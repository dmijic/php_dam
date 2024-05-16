<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Storage;

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

    /**
     * Store brand in DB
     * 
     * @return void
     */
    public function store()
    {
        $allowedFields = ['brand_name', 'brand_logo_url', 'brand_description', 'brand_web_url'];
        $newBrandData = array_intersect_key($_POST, array_flip($allowedFields));
        $newBrandData = array_map('sanitize', $newBrandData);
        $requiredFields = ['brand_name'];

        foreach ($requiredFields as $field) {
            if (empty($newBrandData[$field]) || !Validation::string($newBrandData[$field])) {
                $errors[$field] = ucfirst($field) . ' je obavezan podatak';
            };
        }
        if (!empty($errors)) {
            loadView('brands/create', ['errors' => $errors, 'brand' => $newBrandData]);
        } else {
            foreach ($newBrandData as $field => $value) {
                $fields[] = $field;
            }
            $fields = implode(', ', $fields);

            $values = [];
            foreach ($newBrandData as $field => $value) {
                if ($value === '') {
                    $newBrandData[$field] = null;
                }
                $values[] = ':' . $field;
            }

            $values = implode(', ', $values);

            $query = "INSERT INTO brands ({$fields}) VALUES ({$values})";

            $this->db->query($query, $newBrandData);

            $_SESSION['success_message'] = "Dodan je novi brend: <strong>{$newBrandData['brand_name']}</strong>.";

            redirect('/brands');
        }
    }
}
