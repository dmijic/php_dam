<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class BrandController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show single brand
     * 
     * @return void
     */
    public function index($params)
    {
        //inspectAndDie($params);
        $brand = $this->db->query('SELECT * FROM brands WHERE id = :id', $params)->fetch();
        $products = $this->db->query('SELECT * FROM products WHERE brand_id = :id', $params)->fetchAll();
        $ingredients = $this->db->query('SELECT * FROM ingredients')->fetchAll();
        $claims = $this->db->query('SELECT * FROM claims')->fetchAll();

        loadView('brands/single_brand', ['brand' => $brand, 'ingredients' => $ingredients, 'claims' => $claims, 'products' => $products]);
    }

    /**
     * Delete a brand
     * 
     * @param array $params
     * @return void
     */
    public function destroy($params)
    {
        $id = $params['id'];
        $params = [
            'id' => $id
        ];

        $brand = $this->db->query('SELECT * FROM brands WHERE id = :id', $params)->fetch();

        if (!$brand) {
            ErrorController::notFound('Nema tog brenda.');
            return;
        }

        $products = $this->db->query('SELECT * FROM products WHERE brand_id = :id', $params)->fetchAll();

        foreach ($products as $product) {
            inspectAndDie($product->brand_id);
        }

        $this->db->query('DELETE FROM brands WHERE id = :id', $params);

        // Set flash message
        $_SESSION['success_message'] = "Brend <strong>{$brand->brand_name}</strong> je obrisan.";

        redirect('/brands');
    }

    /**
     * Update a brand
     * 
     * @param array $params
     * @return void
     */
    public function update($params)
    {
        $id = $params['id'];

        $brand = $this->db->query('SELECT * FROM brands WHERE id = ' . $id)->fetch();
        $products = $this->db->query('SELECT * FROM products WHERE brand_id = :id', $params)->fetchAll();
        $ingredients = $this->db->query('SELECT * FROM ingredients')->fetchAll();
        $claims = $this->db->query('SELECT * FROM claims')->fetchAll();



        $allowedFields = ['brand_name', 'brand_logo_url', 'brand_description', 'brand_web_url'];
        $updateValues = [];
        $updateValues = array_intersect_key($_POST, array_flip($allowedFields));
        $updateValues = array_map('sanitize', $updateValues);
        $requiredFields = ['brand_name'];

        $errors = [];

        if (empty($updateValues['brand_logo_url'])) {
            $updateValues['brand_logo_url'] = $brand->brand_logo_url;
        }

        foreach ($requiredFields as $field) {
            if (empty($updateValues[$field]) || !Validation::string($updateValues[$field])) {
                $errors['$field'] = ucfirst($field) . ' polje je obavezno.';
            }
        }

        if (!empty($errors)) {
            loadView('brands/single_brand', ['products' => $products, 'brand' => $brand, 'ingredients' => $ingredients, 'claims' => $claims, 'errors' => $errors]);
            exit;
        } else {
            // Submit to database
            $updateFields = [];
            foreach (array_keys($updateValues) as $field) {
                $updateFields[] = "{$field} = :{$field}";
            }

            $updateFields = implode(', ', $updateFields);
            $updateQuery = "UPDATE brands SET $updateFields WHERE id = :id";

            $updateValues['id'] = $id;
            $this->db->query($updateQuery, $updateValues);

            $_SESSION['success_message'] = 'Podaci su ažurirani.';
            redirect('/brand/' . $id);
        }
    }
}
