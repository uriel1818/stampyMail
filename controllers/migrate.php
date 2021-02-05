<?php

namespace controllers;

require_once "controller.php";

use controllers\controller;

class migrate extends controller
{
    private $model;

    public function __construct()
    {
        error_log('<--- controller_MIGRATE --->');
        parent::__contrstruct();
        $this->model = $this->models['migrate'];
    }
    public function index()
    {
        error_log('controller_MIGRATE::index->');
        var_dump($this->model->delete_tables());
        var_dump($this->model->create_tables());
    }
}
