<?php

namespace models;

use PDO;

class model
{
    private $database;
    private $table;
    private $id; //id del objeto

    public function __construct()
    {
        error_log('<--- MODEL --->');

        $this->connect_to_database();
        $this->set_table();
    }

    /**
     * Creo base sqlite o me conecto a existente
     * El nombre es el mismo que se define en variable APP_NAME del archivo ./config.php
     */
    private function connect_to_database()
    {
        try {
            $this->database = new PDO("sqlite:" . MODELS . APP_NAME . ".db");
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            error_log('MODEL::connect_to_database->success');
        } catch (\Throwable $th) {
            error_log('MODEL::connect_to_database->' . $th);
            exit;
        }
    }

    

    /**
     * Grabo el nombre de la tabla
     * Si no le paso ningun atributo, se entiende que la tabla debe llamarse igual que la clase actual ej: usuarios
     */
    protected function set_table($table = NULL)
    {
        $this->table = !empty($table) ? $this->get_class_name() : $table; 
        error_log('MODEL::set_table->'.$this->table);
    }

    /**
     * Devuelvo el nombre de la instancia actual
     */
    private function get_class_name(){
        error_log('MODEL::get_class_name');
        $class = get_class($this);//devuelve el nombre completo de la instancia
        $array = explode("\\",$class);//divide el nombre y lo guarda en un array
        return end($array);//devuelve el último elemento del array que correspondería al nombre de la instancia
        
    }


    /**
     * evito tener que escribir $this->database->query en cada consulta
     */
    protected function query($query)
    {
        try {
            return $this->database->query($query);
        } catch (\Throwable $th) {
            error_log("MODEL::query->".$th);
            return $th;
        }
    }

    /**
     * devuelvo toda la info de la tabla dada
     */
    protected function get_all()
    {
        $stmt = $this->query("SELECT * FROM {$this->table}", PDO::FETCH_OBJ);
        return $stmt->fetch_all();
    }

    /**
     * devuelvo fila con la id que coincida
     */
    protected function get_by_id($id){
        $stmt = $this->query("SELECT * FROM {$this->table} WHERE id = {$id}",PDO::FETCH_OBJ);
        return $stmt->fetch_all();
    }

    /**
     * obtengo el id del objeto
     */
    protected function get_id(){
        return $this->id;
    }

    /**
     * guardo id del objeto en $this->id
     */
    protected function set_id($id){
     $this->id = $id;
    }
}
