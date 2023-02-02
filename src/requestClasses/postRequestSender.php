<?php

namespace requestClasses;

class postRequestSender extends requestSender
{
    private array $data;
    public function __construct(string $url, array $data)
    {
        $this->data=$data;
        parent::__construct($url);
    }

    public function sendPostRequest(): string|bool
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->data));
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->accesToken
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}