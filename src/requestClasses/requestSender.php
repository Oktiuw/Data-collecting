<?php

namespace requestClasses;

abstract class requestSender
{
    private string $url;
    private array $body;
    private string $accessToken;
    private array $headers;
    public function __construct(string $url,array $body,array $headers)
    {
        $this->accessToken=get_object_vars(json_decode(file_get_contents(__DIR__ . "\jsonFiles/access_token.json")))['access_token'];
        $this->url=$url;
        $this->body=$body;
        $this->headers=$headers;
    }

    public function xmlToJson(string $text)
    {
        $xml = simplexml_load_string($text);
        return json_encode($xml);
    }
    public function saveJsonFile(string $text,string $fileName)
    {
        file_put_contents(__DIR__ . "\jsonFiles/$fileName.json", $text);

    }

}