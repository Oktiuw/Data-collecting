<?php

namespace requestClasses;

class requestSender
{
    protected String $accesToken;
    protected String $url;
    protected array $header;
    public function __construct(string $url)
    {
        $this->accesToken=get_object_vars(json_decode(file_get_contents(__DIR__ . "\..\jsonFiles/access_token.json")))['access_token'];
        $this->url=$url;
    }

    public function xmlToJson($xml,$fileName): void
    {
        $json = json_encode(simplexml_load_string($xml));
        file_put_contents(__DIR__ . "\jsonFiles/$fileName.json", $json);
    }
}