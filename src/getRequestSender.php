<?php

require_once 'requestSender.php';
class getRequestSender extends requestSender
{
    public function __construct(string $url, array $headers = [],bool $isInsee = False)
    {
        parent::__construct($url, $headers, $isInsee);
    }

    public function sendGetRequest()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
        $response = curl_exec($ch);
        var_dump(curl_getinfo($ch, CURLINFO_HTTP_CODE));
        curl_close($ch);
        return $response;
    }
}
