<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Storage;

class ClaimsController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show all claims
     *
     * @return void
     */
    public function index()
    {
        $ingredients = $this->db->query('SELECT * FROM ingredients')->fetchAll();
        $claims = $this->db->query('SELECT * FROM claims')->fetchAll();
        loadView('claims/index', ['ingredients' => $ingredients, 'claims' => $claims]);
    }

    /**
     * Create new claim
     *
     * @return void
     */
    public function create()
    {
        $ingredients = $this->db->query('SELECT * FROM ingredients')->fetchAll();
        $claims = $this->db->query('SELECT * FROM claims')->fetchAll();
        loadView('claims/create', ['ingredients' => $ingredients, 'claims' => $claims]);
    }

    /**
     * Store new claim in DB
     * 
     * @return void
     */
    public function store()
    {
        $allowedFields = ['ingredient_id', 'content'];
        $newClaimData = array_intersect_key($_POST, array_flip($allowedFields));
        $newClaimData = array_map('sanitize', $newClaimData);
        $requiredFields = ['ingredient_id', 'content'];

        foreach ($requiredFields as $field) {
            if (empty($newClaimData[$field]) || !Validation::string($newClaimData[$field])) {
                $errors[$field] = ucfirst($field) . ' je obavezan podatak';
            };
        }
        if (!empty($errors)) {
            loadView('claims/create', ['errors' => $errors, 'claim' => $newClaimData]);
        } else {
            foreach ($newClaimData as $field => $value) {
                $fields[] = $field;
            }

            $fields = implode(', ', $fields);
            $values = [];

            foreach ($newClaimData as $field => $value) {
                if ($value === '') {
                    $newClaimData[$field] = null;
                }
                $values[] = ':' . $field;
            }
            $values = implode(', ', $values);

            $query = "INSERT INTO claims ({$fields}) VALUES ({$values})";

            // inspectAndDie($newClaimData);
            $this->db->query($query, $newClaimData);

            redirect('/claims');
        }
    }
}
