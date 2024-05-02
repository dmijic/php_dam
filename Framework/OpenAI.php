<?php

namespace Framework;

class OpenAI
{
    protected $url;
    protected $headers;

    public function __construct($openai)
    {
        $openai_api_key = $openai['key']; // Replace this with your OpenAI API key

        $this->url = 'https://api.openai.com/v1/chat/completions';

        $this->headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $openai_api_key
        ];
    }

    public function response($messages)
    {
        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages
        ];

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
