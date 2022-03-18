<?php

class Input
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    public function __construct()
    {
        if (isset($_POST["submit"])) {
            $this->inputItemButton();
        }
        if (isset($_POST["save_correction"])) {
            $this->inputItemCorrection();
        }
        if (isset($_POST["finish"])) {
            $this->finishOrder();
        }
    }


    private function inputItemButton()
    {

        if (empty($_GET['asset_id']))
        {
            $this->errors[] = "Punto de captura no reconocido";
        }
        /*
        elseif(empty($_POST['input_hr'])){
            $this->errors[] = "Capture al menos una unidad";
        }
        */
        elseif(empty($_POST['plan_id'])){
            $this->errors[] = "No hay un plan";
        }
        elseif (!empty($_GET['asset_id']) &&  !empty($_POST['plan_id']))
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {


                $asset_id   = $this->db_connection->real_escape_string(strip_tags($_GET['asset_id'], ENT_QUOTES));
                //$qty        = $this->db_connection->real_escape_string(strip_tags($_POST['input_hr'], ENT_QUOTES));
                $plan_id    = $this->db_connection->real_escape_string(strip_tags($_POST['plan_id'], ENT_QUOTES));
                $time_block = date("H");
                $now        = date("Y-m-d H:i:s");
                if(isset($_POST['factor'])){$factor = $_POST['factor'];}else{$factor =1;}
                $qty = 1*$factor;

                $sql = "INSERT INTO hour_registry(reg_qty, reg_time_block, reg_real_time, reg_order_id, source) 
                VALUES ($qty,'$time_block','$now',$plan_id,'btn')";
                $query_new_input = $this->db_connection->query($sql);

                // if user has been added successfully
                if ($query_new_input)
                {
                    $this->messages[] = "Se registraron $qty piezas.";
                }
                else
                {
                    $this->errors[] = "Lo sentimos , el registro fallo $sql.";
                }
            }
            else
            {
                $this->errors[] = "Lo sentimos, no hay conexion con la base de datos.";
            }
        }
        else
        {
            $this->errors[] = "Ocurrio un error de validacion.";
        }
    }



    private function inputItemCorrection()
    {

        if (empty($_GET['asset_id']))
        {
            $this->errors[] = "Punto de captura no reconocido";
        }

        elseif(empty($_POST['input_hr'])){
            $this->errors[] = "Capture un numero en el campo";
        }

        elseif(empty($_POST['plan_id'])){
            $this->errors[] = "No hay un plan";
        }
        elseif (!empty($_GET['asset_id']) &&  !empty($_POST['plan_id']) &&  !empty($_POST['input_hr']))
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {


                $asset_id   = $this->db_connection->real_escape_string(strip_tags($_GET['asset_id'], ENT_QUOTES));
                $qty        = $this->db_connection->real_escape_string(strip_tags($_POST['input_hr'], ENT_QUOTES));
                $plan_id    = $this->db_connection->real_escape_string(strip_tags($_POST['plan_id'], ENT_QUOTES));
                $time_block = date("H");
                $now        = date("Y-m-d H:i:s");

                $delete_previous = "DELETE FROM hour_registry WHERE reg_order_id = $plan_id";
                $run_delete = $this->db_connection->query($delete_previous);

                $sql = "INSERT INTO hour_registry(reg_qty, reg_time_block, reg_real_time, reg_order_id, source) 
                VALUES ($qty,'$time_block','$now',$plan_id,'btn')";
                $query_new_input = $this->db_connection->query($sql);

                // if user has been added successfully
                if ($query_new_input)
                {
                    $this->messages[] = "Se registraron $qty piezas.";
                }
                else
                {
                    $this->errors[] = "Lo sentimos , el registro fallo $sql.";
                }
            }
            else
            {
                $this->errors[] = "Lo sentimos, no hay conexion con la base de datos.";
            }
        }
        else
        {
            $this->errors[] = "Ocurrio un error de validacion.";
        }
    }




    private function finishOrder()
    {

        if (empty($_GET['asset_id']))
        {
            $this->errors[] = "Punto de captura no reconocido";
        }

        elseif(empty($_POST['plan_id'])){
            $this->errors[] = "No hay un plan";
        }
        elseif (!empty($_GET['asset_id']) &&  !empty($_POST['plan_id']))
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {

                $plan_id    = $this->db_connection->real_escape_string(strip_tags($_POST['plan_id'], ENT_QUOTES));
                $time_block = date("H");
                $now        = date("Y-m-d H:i:s");


                $sql = "UPDATE plan_hrxhr SET status = 2 WHERE plant_id = $plan_id";
                $query_new_input = $this->db_connection->query($sql);

                // if user has been added successfully
                if ($query_new_input)
                {
                    $this->messages[] = "Se ha terminado la captura de este numero de parte.";
                }
                else
                {
                    $this->errors[] = "Lo sentimos , el registro fallo $sql.";
                }
            }
            else
            {
                $this->errors[] = "Lo sentimos, no hay conexion con la base de datos.";
            }
        }
        else
        {
            $this->errors[] = "Ocurrio un error de validacion.";
        }
    }

}
