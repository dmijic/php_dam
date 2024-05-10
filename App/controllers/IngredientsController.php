<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Storage;

class IngredientsController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show list of all ingredients
     *
     * @return void
     */
    public function index()
    {
        $ingredients = $this->db->query('SELECT * FROM ingredients')->fetchAll();
        $claims = $this->db->query('SELECT * FROM claims')->fetchAll();

        loadView('ingredients/index', ['ingredients' => $ingredients, 'claims' => $claims]);
    }

    /**
     * Add new ingredient
     *
     * @return void
     */
    public function create()
    {
        loadView('ingredients/create');
    }

    /**
     * Store new ingredient in DB
     * 
     * @return void
     */
    public function store()
    {
        $allowedFields = ['name', 'description'];
        $newIngredientData = array_intersect_key($_POST, array_flip($allowedFields));
        $newIngredientData = array_map('sanitize', $newIngredientData);
        $requiredFields = ['name'];

        foreach ($requiredFields as $field) {
            if (empty($newIngredientData[$field]) || !Validation::string($newIngredientData[$field])) {
                $errors[$field] = ucfirst($field) . ' je obavezan podatak';
            };
        }
        if (!empty($errors)) {
            loadView('ingredients/create', ['errors' => $errors, 'ingredient' => $newIngredientData]);
        } else {
            foreach ($newIngredientData as $field => $value) {
                $fields[] = $field;
            }

            $fields = implode(', ', $fields);
            $values = [];

            foreach ($newIngredientData as $field => $value) {
                if ($value === '') {
                    $newIngredientData[$field] = null;
                }
                $values[] = ':' . $field;
            }
            $values = implode(', ', $values);

            $query = "INSERT INTO ingredients ({$fields}) VALUES ({$values})";

            // inspectAndDie($newIngredientData);
            $this->db->query($query, $newIngredientData);

            redirect('/ingredients');
        }
    }
}
