<?php

namespace controllers;

class router
{
    private $uri;
    private $controller;
    private $controller_class;
    private $action;
    private $params;

    public function __construct()
    {
        error_log('<--- ROUTER --->');
        $this->set_uri();
        $this->set_controller();
        $this->controller_class = $this->get_controller_class();
        $this->set_action();
        $this->set_params();
    }

    private function set_uri()
    {
        $this->uri = explode('/', $_SERVER['REQUEST_URI']);
    }

    /**
     * Guardo el nombre del controlador en $this->controller
     */
    private function set_controller()
    {
        $this->controller = $this->validate_controller() ? $this->validate_controller() : DEFAULT_CONTROLLER;
        error_log('ROUTER::set_controller->' . $this->controller);
    }

    /**
     * Devuelvo una nueva instancia del controllador
     */
    private function get_controller_class()
    {
        require_once(CONTROLLERS . $this->controller . '.php');
        $namespace = "controllers\\{$this->controller}";

        error_log('ROUTER::get_controller_class->' . $namespace);

        $controller = new $namespace;

        return $controller;
    }

    /**
     * Guardo el nombre de la acción en $this->action
     */
    private function set_action()
    {
        $this->action = $this->validate_action() ? $this->validate_action() : DEFAULT_ACTION;
        error_log('ROUTER::set_action->' . $this->action);
    }

    /**
     * Recorro todos los parametros de la url y los guardo en un array en $this->params
     */
    private function set_params()
    {
        $params = array();
        for ($i = 3; $i < count($this->uri); $i++) {
            $params[] = $this->uri[$i];
        }

        $this->params =  empty($params) ? ["vacio"] : $params;

        error_log('ROUTER::set_params->' . implode(",", $this->params));
    }

    /**
    * Devuelve el nombre del controlador en la url, si el mismo es válido, sino devuelve FALSE
    */
    private function validate_controller()
    {
        if (empty($this->uri[1])) {
            return FALSE;
        } elseif (!file_exists(CONTROLLERS . $this->uri[1] . '.php')) {
            return FALSE;
        }

        return $this->uri[1];
    }


    /**
     * Devuelve el nombre de la acción de la url, si la misma es válida, sino devuelve FALSE
     */
    private function validate_action()
    {
        if (empty($this->uri[2])) {
            return FALSE;
        } elseif (!method_exists($this->controller_class, $this->uri[2])) {
            return  FALSE;
        }

        return $this->uri[2];
    }

    /**
     * Llamo al método del controlador con sus parámetros
     */
    public function route()
    {
        error_log('ROUTER::route');

        call_user_func_array([$this->controller_class, $this->action], $this->params);
    }
}
