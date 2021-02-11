<?php

namespace models;
require_once MODELS."model.php";
use models\model;

class login extends model
{

    private $user;
    private $password;

    public function __construct()
    {
        error_log('<--- model_LOGIN --->');
        parent::__construct();
    }

    
}