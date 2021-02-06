<?php

namespace middlewares;

class session
{

    public function __construct()
    {
        error_log('<--- middle_SESSION --->');
    }

    /**
     * Si no existe niguna session, inicio una y redirijo al login
     */
    private function validate_session()
    {
        error_log('middle_SESSION::validate_session');
        
        if(empty($_SESSION)){
            session_start();
            $this->redirect();
            exit;
        }
    }

    private function validate_user()
    {
        error_log('middle_SESSION::validate_user');

        if(empty($_SESSION['user']) || empty($_SESSION['password'])){
            $this->redirect();
            exit;
        }
    }


    private function redirect(){
        header('location:/login');
    }

    public function index()
    {
        error_log('middle_SESSION::index');

        //$_SESSION['user'] = 'uriel';
        //$_SESSION['password'] = 'password';

        $this->validate_session();
        $this->validate_user();
    }
}
