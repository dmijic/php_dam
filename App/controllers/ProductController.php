<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\FileStorage;

class ProductController
{
    protected $db;
    protected $storage;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
        $this->storage = new FileStorage($_FILES, $_POST);
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
        $brands = $this->db->query('SELECT * FROM brands')->fetchAll();
        $ingredients = $this->db->query('SELECT * FROM ingredients')->fetchAll();
        $claims = $this->db->query('SELECT * FROM claims')->fetchAll();

        loadView('products/single_product', ['product' => $product, 'brand' => $brand, 'ingredients' => $ingredients, 'claims' => $claims, 'brands' => $brands]);
    }

    /**
     * Delete a product
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

        $product = $this->db->query('SELECT * FROM products WHERE id = :id', $params)->fetch();

        if (!$product) {
            ErrorController::notFound('Nema tog proizvoda.');
            return;
        }

        $this->db->query('DELETE FROM products WHERE id = :id', $params);
        $this->storage->deleteImage($product->product_image_url);

        // Set flash message
        $_SESSION['success_message'] = "Proizvod <strong>{$product->name}</strong> je obrisan.";

        redirect('/products');
    }

    /**
     * Update a product
     * 
     * @param array $params
     * @return void
     */
    public function update($params)
    {
        $this->storage = new FileStorage($_FILES, $_POST);

        $product = $this->db->query('SELECT * FROM products WHERE id = :id', $params)->fetch();
        $brand = $this->db->query('SELECT * FROM brands WHERE id = ' . $product->brand_id)->fetch();
        $brands = $this->db->query('SELECT * FROM brands')->fetchAll();
        $ingredients = $this->db->query('SELECT * FROM ingredients')->fetchAll();
        $claims = $this->db->query('SELECT * FROM claims')->fetchAll();

        $imageKey = $this->storage->getImgKey();

        $id = $params['id'];

        $allowedFields = ['name', 'product_description', 'product_image_url', 'brand_id', 'quantity', 'active_ingredients', 'suggested_use', 'remark'];
        $updateValues = [];
        $updateValues = array_intersect_key($_POST, array_flip($allowedFields));
        $updateValues = array_map('sanitize', $updateValues);
        $requiredFields = ['name'];

        if ($_FILES[$imageKey]['name'] != '') {
            $updateValues[$imageKey] = $this->storage->returnImgUrl();
        } elseif ($product->product_image_url != '') {
            $updateValues[$imageKey] = $product->product_image_url;
        } else {
            $updateValues[$imageKey] = '';
        }

        $errors = [];

        if (empty($updateValues['brand_id'])) {
            $updateValues['brand_id'] = $product->brand_id;
        }

        if (empty($updateValues['product_image_url'])) {
            $updateValues['product_image_url'] = $product->product_image_url;
        }

        foreach ($requiredFields as $field) {
            if (empty($updateValues[$field]) || !Validation::string($updateValues[$field])) {
                $errors['$field'] = ucfirst($field) . ' polje je obavezno.';
            }
        }

        if (!empty($errors)) {
            loadView('products/single_product', ['product' => $product, 'brand' => $brand, 'ingredients' => $ingredients, 'claims' => $claims, 'brands' => $brands, 'errors' => $errors]);
            exit;
        } else {
            // Submit to database
            $updateFields = [];
            foreach (array_keys($updateValues) as $field) {
                $updateFields[] = "{$field} = :{$field}";
            }

            $updateFields = implode(', ', $updateFields);
            $updateQuery = "UPDATE products SET $updateFields WHERE id = :id";

            $updateValues['id'] = $id;

            if ($_FILES[$imageKey]['name'] != '') {
                $this->storage->uploadImage();
            }

            $this->db->query($updateQuery, $updateValues);

            $_SESSION['success_message'] = 'Podaci su ažurirani.';
            redirect('/product/' . $id);
        }
    }
}
