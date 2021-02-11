<?php

namespace controllers;

require_once "controller.php";

use controllers\controller;

class login extends controller
{
    public function __construct()
    {
        error_log('<--- controller_LOGIN --->');
        
        parent::__contrstruct();
    }

    

}
