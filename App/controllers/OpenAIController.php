<?php

namespace App\Controllers;

use Framework\Database;
use Framework\OpenAI;

class OpenAIController
{
    protected $db;
    protected $ai;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $openai = require basePath('config/openai.php');
        $this->db = new Database($config);
        $this->ai = new OpenAI($openai);
    }

    /**
     * Show
     *
     * @return void
     */
    public function test($query)
    {

        // Example usage
        $messages = [
            [
                'role' => 'system',
                'content' => 'You are a helpful assistant.'
            ],
            [
                'role' => 'user',
                'content' => $query
            ]
        ];

        $data['query'] = $query['query'];
        $data['response'] = $this->ai->response($messages);


        loadView('openai/index', ['data' => $data]);
    }

    /**
     * Create
     *
     * @return void
     */
    public function createPost()
    {
        $posts = $this->db->query('SELECT * FROM posts')->fetchAll();
        loadView('openai/create');
    }
}
