<?php

namespace App\Controllers;

use Framework\Database;

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

        redirect('/brands');
    }
}
