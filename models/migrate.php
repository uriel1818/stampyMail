<?php

namespace models;
require_once MODELS."model.php";
use models\model;

class migrate extends model
{
    public function __construct()
    {
        error_log('<--- model_MIGRATE --->');
        parent::__construct();
    }

    public function create_tables()
    {
        $sql = 
        "
            CREATE TABLE IF NOT EXISTS users(
                ID INTEGER PRIMARY KEY,
                EMAIL VARCHAR(50),
                PASSWORD VARCHAR(100)
            );   
        ";

        error_log('model_MIGRATE::create_tables->'.$sql);
        return $this->query($sql);
    }
    public function delete_tables(){
        $sql = 
        "
            DROP TABLE IF EXISTS users;
        ";
        error_log('model_MIGRATE::delete_tables->'.$sql);
       return $this->query($sql);
    }


}
