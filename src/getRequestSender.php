<?php

require_once 'requestSender.php';
class getRequestSender extends requestSender
{
    public function __construct(string $url, array $headers = [])
    {
        parent::__construct($url, $headers);
    }

    public function sendGetRequest()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET ');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
