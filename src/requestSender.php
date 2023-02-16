<?php

abstract class requestSender
{
    protected string $accessToken;
    protected string $url;
    protected array $data;
    protected array $headers;

    public function __construct(string $url, array $headers = [],bool $isInsee=false)
    {
        $this->url = $url;
        $this->headers = $headers;
        if ($isInsee)
        {
            $this->accessToken = get_object_vars(json_decode(file_get_contents(__DIR__ . "/jsonFiles/access_tokenInsee.json")))['access_token'];
        }
        else
        {
            $this->accessToken = get_object_vars(json_decode(file_get_contents(__DIR__ . "/jsonFiles/access_token.json")))['access_token'];
        }
        $this->headers[] = "Authorization: Bearer $this->accessToken";
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function xmlToJson(string $text)
    {
        $xml = simplexml_load_string($text);
        return json_encode($xml);
    }

    public function saveJson(string $json, string $fileName)
    {
        file_put_contents(__DIR__ . "/../public/jsonFiles/$fileName.json", $json);
    }
}
