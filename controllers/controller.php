<?php

namespace controllers;

class controller
{
    private $class_name;
    protected $models = array();
    protected $helpers = array();
    private $layout;
    protected $data = array();

    public function __contrstruct()
    {
        error_log('<--- CONTROLLER --->');

        $this->add_helper('login');
        $this->set_class_name();
        $this->add_model($this->class_name);
        $this->set_layout("default");
        $this->set_view($this->class_name);
        $this->add_js('app');
        $this->add_css('app');
        $this->set_title();
    }

    /**
     * Instancio los helpers para la clase
     */
    protected function add_helper($helper){
        $this->helpers = HELPERS . $helper .'.php' ;
        error_log('CONTROLLER::use_helpers->'.$helper);
    }

    /**
     * Obtengo el nombre de la clase instanciada
     */
    private function set_class_name()
    {
        $array = explode("\\", get_class($this)); //convierte el nombre completo de la clase en un array
        $this->class_name = end($array); //obtengo el último valor del array que corresponde al nombre de la clase

        error_log('CONTROLLER::get_class->' . $this->class_name);
    }

    /**
     * Defino el titulo de la página
     */
    protected function set_title($title = NULL)
    {
        $this->data['title'] = $title ? $title : APP_NAME . ' - ' . ucfirst($this->class_name);
        error_log('CONTROLLER::set_title->' . $this->data['title']);
    }

    /**
     * Agrego rutas de archivos javascript a array $data['js']
     */
    protected function add_js($js)
    {
        $this->data['js'][] = JAVASCRIPT . $js . ".js";
        error_log('CONTROLLER::add_js->' . $js);
    }


    /**
     *  Agrego rutas de archivos de estilo css a array $data['css']
     */
    protected function add_css($css)
    {
        $this->data['css'] = CSS . $css . ".css";
        error_log('CONTROLLER::add_css->' . $css);
    }




    /**
     * Guardo la instancia del modelo en un array
     */
    protected function add_model($model)
    {
        //si existe el archivo modelo lo instancio, sino instancio el modelo por defecto
        $this->models[$model] = $this->validate_model($model) ? $this->get_model_class($model) : $this->get_model_class(DEFAULT_MODEL);
       
        error_log('CONTROLLER::add_model->'.$model);
    }

    /**
     * Valido que el modelo exista como archivo
     */
    protected function validate_model($model)
    {

        $path = $this->get_model_path($model);

        if (!file_exists($path)) {
            return FALSE;
        }
        return TRUE;
    }


    /**
     * Devuelvo instancia del modelo
     */
    private function get_model_class($model)
    {
            require_once($this->get_model_path($model));
            $namespace = "models\\{$model}";

            error_log('ROUTER::get_model_class->' . $namespace);

            return  new $namespace;
    }


    /**
     * Devuelvo la ruta del modelo
     */
    private function get_model_path($model)
    {
        return MODELS . $model . ".php";
    }



    /**
     * Guardo la vista 
     */
    protected function set_view($view)
    {
        $this->data['view'] = $this->validate_view($view) ? $this->get_view_path($view) : $this->get_view_path(DEFAULT_VIEW);
        error_log('CONTROLLER::set_view->' . $this->data['view']);
    }


    /**
     * Valido que la vista exista como archivo
     */
    protected function validate_view($view)
    {

        $path = $this->get_view_path($view);

        if (!file_exists($path)) {
            return FALSE;
        }
        return TRUE;
    }


    /**
     * Devuelvo la ruta de la vista
     */
    private function get_view_path($view)
    {
        return VIEWS . $view . ".php";
    }


    /**
     * Guardo la plantilla
     */
    protected function set_layout($layout)
    {
        $this->layout = $this->validate_layout($layout) ? $layout : DEFAULT_LAYOUT;
        error_log('CONTROLLER::set_layout->' . $this->layout);
    }

    /**
     * Valido el layout
     */
    private function validate_layout($layout)
    {
        $path  = $this->get_layout_path($layout);

        if (!file_exists($path)) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Devuelvo la ruta del layout
     */
    private function get_layout_path($layout)
    {
        return LAYOUTS . $layout . ".php";
    }


    protected function run()
    {
        error_log('CONTROLLER::run');

        $data = $this->data;

        ob_start();

        require_once($this->get_layout_path($this->layout));


        ob_flush();
        ob_clean();
    }


    
    public function index()
    {
        error_log('CONTROLLER::index');
        $this->run();
    }
}
