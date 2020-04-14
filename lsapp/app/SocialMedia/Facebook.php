<?php

namespace App\SocialMedia;

class Facebook{
    private $client_id;
    public $client_secret;
    private $redirectUrl;

    function __construct($stripe){
        $this->client_secret =  $stripe['secret'];
    }

    public function getSecret(){
        return $this->client_secret;
    }

}