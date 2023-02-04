<?php

require_once 'requestSender.php';
class postRequestSender extends requestSender
{
    public function __construct(string $url, array $data = [], array $headers = [])
    {
        parent::__construct($url, $data, $headers);
    }

    public function sendPostRequest()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}