<?php

class requestSender
{
    protected string $url;
    public function __construct(string $url){
        $this->url=$url;
    }
}