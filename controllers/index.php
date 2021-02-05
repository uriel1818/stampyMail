<?php

namespace controllers;

require_once "controller.php";

use controllers\controller;

class index extends controller
{
    public function __construct()
    {
        error_log('<--- INDEX --->');
        parent::__contrstruct();
    }
}
