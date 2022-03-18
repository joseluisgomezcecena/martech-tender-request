<?php

class Plan
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

    /**
     * @var array $asset asset
     */
    public $assets = array();

    /**
     * @var array site site
     */
    public $sites = array();


    /**
     * @var array $action action to go back to update or insert
     */
    public $action = array();



    public function __construct()
    {
        if (isset($_POST["register_plan"])) {
            $this->registerPlan();
        }
        if (isset($_POST["update_plan"])) {
            $this->updatePlan();
        }
        if (isset($_POST["delete_plan"])) {
            $this->deletePlan();
        }
    }


    private function registerPlan()
    {
        $hc_op = 1;
        $partno_op = 1;


        if (empty($_POST['plant_id']))
        {
            $this->errors[] = "Planta no reconocida";
        }
        elseif(empty($_POST['site_id'])){
            $this->errors[] = "Celda o linea no reconocidos";
        }
        elseif(empty($_POST['asset_id'])){
            $this->errors[] = "Punto de captura no reconocido";
        }
        elseif(empty($_POST['date_id'])){
            $this->errors[] = "El plan debe tener una fecha";
        }
        elseif (empty($_POST['hc_6']) && empty($_POST['hc_7']) && empty($_POST['hc_8']) && empty($_POST['hc_9'])
            && empty($_POST['hc_10']) && empty($_POST['hc_11']) && empty($_POST['hc_12']) && empty($_POST['hc_13'])
            && empty($_POST['hc_14']) && empty($_POST['hc_15']) )
        {
            $hc_op = 0;
            $this->errors[] = "Debe llenar al menos un campo de headcount";
        }
        elseif (empty($_POST['partno_6']) && empty($_POST['partno_7']) && empty($_POST['partno_8']) && empty($_POST['partno_9'])
            && empty($_POST['partno_10']) && empty($_POST['partno_11']) && empty($_POST['partno_12']) && empty($_POST['partno_13'])
            && empty($_POST['partno_14']) && empty($_POST['partno_15']) )
        {
            $partno_op = 0;
            $this->errors[] = "Debe llenar al menos un campo de numero de parte";
        }
        elseif (!empty($_POST['plant_id'])
            && !empty($_POST['site_id'])
            && !empty($_POST['asset_id'])
            && !empty($_POST['date_id'])
            && $hc_op == 1
            && $partno_op == 1
        )
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {

                $plant_id      = $this->db_connection->real_escape_string(strip_tags($_POST['plant_id'], ENT_QUOTES));
                $site_id       = $this->db_connection->real_escape_string(strip_tags($_POST['site_id'], ENT_QUOTES));
                $asset_id      = $this->db_connection->real_escape_string(strip_tags($_POST['asset_id'], ENT_QUOTES));
                $date          = $this->db_connection->real_escape_string(strip_tags($_POST['date_id'], ENT_QUOTES));
                $now           = date("Y-m-d H:i:s");
                $supervisor_id =  $this->db_connection->real_escape_string(strip_tags($_POST['supervisor_id'], ENT_QUOTES));

                /***************HEADCOUNT********************/
                if(isset($_POST['hc_6'])&& $_POST['hc_6'] != 0) { $hc_6=$_POST['hc_6']; } else { $hc_6 = 0; }
                if(isset($_POST['hc_7'])&& $_POST['hc_7'] != 0) { $hc_7=$_POST['hc_7']; } else { $hc_7 = 0; }
                if(isset($_POST['hc_8'])&& $_POST['hc_8'] != 0) { $hc_8=$_POST['hc_8']; } else { $hc_8 = 0; }
                if(isset($_POST['hc_9'])&& $_POST['hc_9'] != 0) { $hc_9=$_POST['hc_9']; } else { $hc_9 = 0; }
                if(isset($_POST['hc_10'])&& $_POST['hc_10'] != 0) { $hc_10=$_POST['hc_10']; } else { $hc_10 = 0; }
                if(isset($_POST['hc_11'])&& $_POST['hc_11'] != 0) { $hc_11=$_POST['hc_11']; } else { $hc_11 = 0; }
                if(isset($_POST['hc_12'])&& $_POST['hc_12'] != 0) { $hc_12=$_POST['hc_12']; } else { $hc_12 = 0; }
                if(isset($_POST['hc_13'])&& $_POST['hc_13'] != 0) { $hc_13=$_POST['hc_13']; } else { $hc_13 = 0; }
                if(isset($_POST['hc_14'])&& $_POST['hc_14'] != 0) { $hc_14=$_POST['hc_14']; } else { $hc_14 = 0; }
                if(isset($_POST['hc_15'])&& $_POST['hc_15'] != 0) { $hc_15=$_POST['hc_15']; } else { $hc_15 = 0; }


                if(isset($_POST['hc_16'])&& $_POST['hc_16'] != 0) { $hc_16=$_POST['hc_16']; } else { $hc_16 = 0; }
                if(isset($_POST['hc_17'])&& $_POST['hc_17'] != 0) { $hc_17=$_POST['hc_17']; } else { $hc_17 = 0; }
                if(isset($_POST['hc_18'])&& $_POST['hc_18'] != 0) { $hc_18=$_POST['hc_18']; } else { $hc_18 = 0; }
                if(isset($_POST['hc_19'])&& $_POST['hc_19'] != 0) { $hc_19=$_POST['hc_19']; } else { $hc_19 = 0; }
                if(isset($_POST['hc_20'])&& $_POST['hc_20'] != 0) { $hc_20=$_POST['hc_20']; } else { $hc_20 = 0; }
                if(isset($_POST['hc_21'])&& $_POST['hc_21'] != 0) { $hc_21=$_POST['hc_21']; } else { $hc_21 = 0; }
                if(isset($_POST['hc_22'])&& $_POST['hc_22'] != 0) { $hc_22=$_POST['hc_22']; } else { $hc_22 = 0; }
                if(isset($_POST['hc_23'])&& $_POST['hc_23'] != 0) { $hc_23=$_POST['hc_23']; } else { $hc_23 = 0; }


                if(isset($_POST['hc_24'])&& $_POST['hc_24'] != 0) { $hc_24=$_POST['hc_24']; } else { $hc_24 = 0; }
                if(isset($_POST['hc_1'])&& $_POST['hc_1'] != 0) { $hc_1=$_POST['hc_1']; } else { $hc_1 = 0; }
                if(isset($_POST['hc_2'])&& $_POST['hc_2'] != 0) { $hc_2=$_POST['hc_2']; } else { $hc_2 = 0; }
                if(isset($_POST['hc_3'])&& $_POST['hc_3'] != 0) { $hc_3=$_POST['hc_3']; } else { $hc_3 = 0; }
                if(isset($_POST['hc_4'])&& $_POST['hc_4'] != 0) { $hc_4=$_POST['hc_4']; } else { $hc_4 = 0; }
                if(isset($_POST['hc_5'])&& $_POST['hc_5'] != 0) { $hc_5=$_POST['hc_5']; } else { $hc_5 = 0; }

                /***************HEADCOUNT********************/


                /**************PART NUMBERS******************/

                if(isset($_POST['partno_6'])&& $_POST['partno_6'] != "") { $partno_6= $_POST['partno_6']; } else { $partno_6 = "N/A";}
                if(isset($_POST['partno_7'])&& $_POST['partno_7'] != "") { $partno_7=$_POST['partno_7']; } else { $partno_7 = "N/A"; }
                if(isset($_POST['partno_8'])&& $_POST['partno_8'] != "") { $partno_8=$_POST['partno_8']; } else { $partno_8 = "N/A"; }
                if(isset($_POST['partno_9'])&& $_POST['partno_9'] != "") { $partno_9=$_POST['partno_9']; } else { $partno_9 = "N/A"; }
                if(isset($_POST['partno_10'])&& $_POST['partno_10'] != "") { $partno_10=$_POST['partno_10']; } else { $partno_10 = "N/A"; }
                if(isset($_POST['partno_11'])&& $_POST['partno_11'] != "") { $partno_11=$_POST['partno_11']; } else { $partno_11 = "N/A"; }
                if(isset($_POST['partno_12'])&& $_POST['partno_12'] != "") { $partno_12=$_POST['partno_12']; } else { $partno_12 = "N/A"; }
                if(isset($_POST['partno_13'])&& $_POST['partno_13'] != "") { $partno_13=$_POST['partno_13']; } else { $partno_13 = "N/A"; }
                if(isset($_POST['partno_14'])&& $_POST['partno_14'] != "") { $partno_14=$_POST['partno_14']; } else { $partno_14 = "N/A"; }
                if(isset($_POST['partno_15'])&& $_POST['partno_15'] != "") { $partno_15=$_POST['partno_15']; } else { $partno_15 = "N/A"; }

                if(isset($_POST['partno_16'])&& $_POST['partno_16'] != "") { $partno_16= $_POST['partno_16']; } else { $partno_16 = "N/A";}
                if(isset($_POST['partno_17'])&& $_POST['partno_17'] != "") { $partno_17=$_POST['partno_17']; } else { $partno_17 = "N/A"; }
                if(isset($_POST['partno_18'])&& $_POST['partno_18'] != "") { $partno_18=$_POST['partno_18']; } else { $partno_18 = "N/A"; }
                if(isset($_POST['partno_19'])&& $_POST['partno_19'] != "") { $partno_19=$_POST['partno_19']; } else { $partno_19 = "N/A"; }
                if(isset($_POST['partno_20'])&& $_POST['partno_20'] != "") { $partno_20=$_POST['partno_20']; } else { $partno_20 = "N/A"; }
                if(isset($_POST['partno_21'])&& $_POST['partno_21'] != "") { $partno_21=$_POST['partno_21']; } else { $partno_21 = "N/A"; }
                if(isset($_POST['partno_22'])&& $_POST['partno_22'] != "") { $partno_22=$_POST['partno_22']; } else { $partno_22 = "N/A"; }
                if(isset($_POST['partno_23'])&& $_POST['partno_23'] != "") { $partno_23=$_POST['partno_23']; } else { $partno_23 = "N/A"; }

                if(isset($_POST['partno_24'])&& $_POST['partno_24'] != "") { $partno_24= $_POST['partno_24']; } else { $partno_24 = "N/A";}
                if(isset($_POST['partno_1'])&& $_POST['partno_1'] != "") { $partno_1=$_POST['partno_1']; } else { $partno_1 = "N/A"; }
                if(isset($_POST['partno_2'])&& $_POST['partno_2'] != "") { $partno_2=$_POST['partno_2']; } else { $partno_2 = "N/A"; }
                if(isset($_POST['partno_3'])&& $_POST['partno_3'] != "") { $partno_3=$_POST['partno_3']; } else { $partno_3 = "N/A"; }
                if(isset($_POST['partno_4'])&& $_POST['partno_4'] != "") { $partno_4=$_POST['partno_4']; } else { $partno_4 = "N/A"; }
                if(isset($_POST['partno_5'])&& $_POST['partno_5'] != "") { $partno_5=$_POST['partno_5']; } else { $partno_5 = "N/A"; }


                /**************PART NUMBERS******************/


                
                /***************WORK ORDERS*******************/
                
                if(isset($_POST['wo_number_6'])&& $_POST['wo_number_6'] != "") { $wo_number_6=$_POST['wo_number_6']; } else { $wo_number_6 = "N/A"; }
                if(isset($_POST['wo_number_7'])&& $_POST['wo_number_7'] != "") { $wo_number_7=$_POST['wo_number_7']; } else { $wo_number_7 = "N/A"; }
                if(isset($_POST['wo_number_8'])&& $_POST['wo_number_8'] != "") { $wo_number_8=$_POST['wo_number_8']; } else { $wo_number_8 = "N/A"; }
                if(isset($_POST['wo_number_9'])&& $_POST['wo_number_9'] != "") { $wo_number_9=$_POST['wo_number_9']; } else { $wo_number_9 = "N/A"; }
                if(isset($_POST['wo_number_10'])&& $_POST['wo_number_10'] != "") { $wo_number_10=$_POST['wo_number_10']; } else { $wo_number_10 = "N/A"; }
                if(isset($_POST['wo_number_11'])&& $_POST['wo_number_11'] != "") { $wo_number_11=$_POST['wo_number_11']; } else { $wo_number_11 = "N/A"; }
                if(isset($_POST['wo_number_12'])&& $_POST['wo_number_12'] != "") { $wo_number_12=$_POST['wo_number_12']; } else { $wo_number_12 = "N/A"; }
                if(isset($_POST['wo_number_13'])&& $_POST['wo_number_13'] != "") { $wo_number_13=$_POST['wo_number_13']; } else { $wo_number_13 = "N/A"; }
                if(isset($_POST['wo_number_14'])&& $_POST['wo_number_14'] != "") { $wo_number_14=$_POST['wo_number_14']; } else { $wo_number_14 = "N/A"; }
                if(isset($_POST['wo_number_15'])&& $_POST['wo_number_15'] != "") { $wo_number_15=$_POST['wo_number_15']; } else { $wo_number_15 = "N/A"; }


                if(isset($_POST['wo_number_16'])&& $_POST['wo_number_16'] != "") { $wo_number_16=$_POST['wo_number_16']; } else { $wo_number_16 = "N/A"; }
                if(isset($_POST['wo_number_17'])&& $_POST['wo_number_17'] != "") { $wo_number_17=$_POST['wo_number_17']; } else { $wo_number_17 = "N/A"; }
                if(isset($_POST['wo_number_18'])&& $_POST['wo_number_18'] != "") { $wo_number_18=$_POST['wo_number_18']; } else { $wo_number_18 = "N/A"; }
                if(isset($_POST['wo_number_19'])&& $_POST['wo_number_19'] != "") { $wo_number_19=$_POST['wo_number_19']; } else { $wo_number_19 = "N/A"; }
                if(isset($_POST['wo_number_20'])&& $_POST['wo_number_20'] != "") { $wo_number_20=$_POST['wo_number_20']; } else { $wo_number_20 = "N/A"; }
                if(isset($_POST['wo_number_21'])&& $_POST['wo_number_21'] != "") { $wo_number_21=$_POST['wo_number_21']; } else { $wo_number_21 = "N/A"; }
                if(isset($_POST['wo_number_22'])&& $_POST['wo_number_22'] != "") { $wo_number_22=$_POST['wo_number_22']; } else { $wo_number_22 = "N/A"; }
                if(isset($_POST['wo_number_23'])&& $_POST['wo_number_23'] != "") { $wo_number_23=$_POST['wo_number_23']; } else { $wo_number_23 = "N/A"; }
              

                if(isset($_POST['wo_number_24'])&& $_POST['wo_number_24'] != "") { $wo_number_24=$_POST['wo_number_24']; } else { $wo_number_24 = "N/A"; }
                if(isset($_POST['wo_number_1'])&& $_POST['wo_number_1'] != "") { $wo_number_1=$_POST['wo_number_1']; } else { $wo_number_1 = "N/A"; }
                if(isset($_POST['wo_number_2'])&& $_POST['wo_number_2'] != "") { $wo_number_2=$_POST['wo_number_2']; } else { $wo_number_2 = "N/A"; }
                if(isset($_POST['wo_number_3'])&& $_POST['wo_number_3'] != "") { $wo_number_3=$_POST['wo_number_3']; } else { $wo_number_3 = "N/A"; }
                if(isset($_POST['wo_number_4'])&& $_POST['wo_number_4'] != "") { $wo_number_4=$_POST['wo_number_4']; } else { $wo_number_4 = "N/A"; }
                if(isset($_POST['wo_number_5'])&& $_POST['wo_number_5'] != "") { $wo_number_5=$_POST['wo_number_5']; } else { $wo_number_5 = "N/A"; }



                /***************WORK ORDERS*******************/


                /**************PLAN BY HOUR******************/

                if(isset($_POST['plan_by_hr_6'])&& $_POST['plan_by_hr_6'] != 0) { $plan_by_hr_6 = $_POST['plan_by_hr_6']; } else { $plan_by_hr_6 = 0; }
                if(isset($_POST['plan_by_hr_7'])&& $_POST['plan_by_hr_7'] != 0) { $plan_by_hr_7=$_POST['plan_by_hr_7']; } else { $plan_by_hr_7 = 0; }
                if(isset($_POST['plan_by_hr_8'])&& $_POST['plan_by_hr_8'] != 0) { $plan_by_hr_8=$_POST['plan_by_hr_8']; } else { $plan_by_hr_8 = 0; }
                if(isset($_POST['plan_by_hr_9'])&& $_POST['plan_by_hr_9'] != 0) { $plan_by_hr_9=$_POST['plan_by_hr_9']; } else { $plan_by_hr_9 = 0; }
                if(isset($_POST['plan_by_hr_10'])&& $_POST['plan_by_hr_10'] != 0) { $plan_by_hr_10=$_POST['plan_by_hr_10']; } else { $plan_by_hr_10 = 0; }
                if(isset($_POST['plan_by_hr_11'])&& $_POST['plan_by_hr_11'] != 0) { $plan_by_hr_11=$_POST['plan_by_hr_11']; } else { $plan_by_hr_11 = 0; }
                if(isset($_POST['plan_by_hr_12'])&& $_POST['plan_by_hr_12'] != 0) { $plan_by_hr_12=$_POST['plan_by_hr_12']; } else { $plan_by_hr_12 = 0; }
                if(isset($_POST['plan_by_hr_13'])&& $_POST['plan_by_hr_13'] != 0) { $plan_by_hr_13=$_POST['plan_by_hr_13']; } else { $plan_by_hr_13 = 0; }
                if(isset($_POST['plan_by_hr_14'])&& $_POST['plan_by_hr_14'] != 0) { $plan_by_hr_14=$_POST['plan_by_hr_14']; } else { $plan_by_hr_14 = 0; }
                if(isset($_POST['plan_by_hr_15'])&& $_POST['plan_by_hr_15'] != 0) { $plan_by_hr_15=$_POST['plan_by_hr_15']; } else { $plan_by_hr_15 = 0; }

                if(isset($_POST['plan_by_hr_16'])&& $_POST['plan_by_hr_16'] != 0) { $plan_by_hr_16 = $_POST['plan_by_hr_16']; } else { $plan_by_hr_16 = 0; }
                if(isset($_POST['plan_by_hr_17'])&& $_POST['plan_by_hr_17'] != 0) { $plan_by_hr_17=$_POST['plan_by_hr_17']; } else { $plan_by_hr_17 = 0; }
                if(isset($_POST['plan_by_hr_18'])&& $_POST['plan_by_hr_18'] != 0) { $plan_by_hr_18=$_POST['plan_by_hr_18']; } else { $plan_by_hr_18 = 0; }
                if(isset($_POST['plan_by_hr_19'])&& $_POST['plan_by_hr_19'] != 0) { $plan_by_hr_19=$_POST['plan_by_hr_19']; } else { $plan_by_hr_19 = 0; }
                if(isset($_POST['plan_by_hr_20'])&& $_POST['plan_by_hr_20'] != 0) { $plan_by_hr_20=$_POST['plan_by_hr_20']; } else { $plan_by_hr_20 = 0; }
                if(isset($_POST['plan_by_hr_21'])&& $_POST['plan_by_hr_21'] != 0) { $plan_by_hr_21=$_POST['plan_by_hr_21']; } else { $plan_by_hr_21 = 0; }
                if(isset($_POST['plan_by_hr_22'])&& $_POST['plan_by_hr_22'] != 0) { $plan_by_hr_22=$_POST['plan_by_hr_22']; } else { $plan_by_hr_22 = 0; }
                if(isset($_POST['plan_by_hr_23'])&& $_POST['plan_by_hr_23'] != 0) { $plan_by_hr_23=$_POST['plan_by_hr_23']; } else { $plan_by_hr_23 = 0; }

                if(isset($_POST['plan_by_hr_24'])&& $_POST['plan_by_hr_24'] != 0) { $plan_by_hr_24 = $_POST['plan_by_hr_24']; } else { $plan_by_hr_24 = 0; }
                if(isset($_POST['plan_by_hr_1'])&& $_POST['plan_by_hr_1'] != 0) { $plan_by_hr_1=$_POST['plan_by_hr_1']; } else { $plan_by_hr_1 = 0; }
                if(isset($_POST['plan_by_hr_2'])&& $_POST['plan_by_hr_2'] != 0) { $plan_by_hr_2=$_POST['plan_by_hr_2']; } else { $plan_by_hr_2 = 0; }
                if(isset($_POST['plan_by_hr_3'])&& $_POST['plan_by_hr_3'] != 0) { $plan_by_hr_3=$_POST['plan_by_hr_3']; } else { $plan_by_hr_3 = 0; }
                if(isset($_POST['plan_by_hr_4'])&& $_POST['plan_by_hr_4'] != 0) { $plan_by_hr_4=$_POST['plan_by_hr_4']; } else { $plan_by_hr_4 = 0; }
                if(isset($_POST['plan_by_hr_5'])&& $_POST['plan_by_hr_5'] != 0) { $plan_by_hr_5=$_POST['plan_by_hr_5']; } else { $plan_by_hr_5 = 0; }

                $get_shift = getShift();

                $sql = "SELECT * FROM plan_hrxhr WHERE date = '$date' AND shift = $get_shift AND plan_asset = $asset_id;";
                $query_check_date = $this->db_connection->query($sql);

                if ($query_check_date->num_rows == 1)
                {
                    $this->errors[] = "Ya existe un plan con esta fecha debe editarlo.";
                    $this->assets[] = $asset_id;
                    $this->action[] = "update";
                    $this->sites[]  = $site_id;
                }
                else
                {

                    if($get_shift == 1)
                    {

                        $sql = "INSERT INTO plan_hrxhr (plant_id, site_id, plan_asset, date, 
                        `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, 
                        `6h`, `7h`, `8h`, `9h`, `10h`, `11h`, `12h`, `13h`, `14h`, `15h`, 
                        wo_6, wo_7, wo_8, wo_9, wo_10, wo_11, wo_12, wo_13, wo_14, wo_15,  
                        pn_6, pn_7, pn_8, pn_9, pn_10, pn_11, pn_12, pn_13, pn_14, pn_15, 
                        date_create, turno, status, shift, supervisor) 
                        VALUES('" . $plant_id . "', '" . $site_id . "', '" . $asset_id . "', '".$date."', 
                        '".$plan_by_hr_6."', '".$plan_by_hr_7."', '".$plan_by_hr_8."', '".$plan_by_hr_9."', '".$plan_by_hr_10."',
                         '".$plan_by_hr_11."', '".$plan_by_hr_12."', '".$plan_by_hr_13."', '".$plan_by_hr_14."', '".$plan_by_hr_15."', 
                        '".$hc_6."','".$hc_7."','".$hc_8."','".$hc_9."','".$hc_10."','".$hc_11."','".$hc_12."','".$hc_13."','".$hc_14."','".$hc_15."', 
                        '".$wo_number_6."','".$wo_number_7."','".$wo_number_8."','".$wo_number_9."','".$wo_number_10."','".$wo_number_11."','".$wo_number_12."','".$wo_number_13."','".$wo_number_14."','".$wo_number_15."',
                        '".$partno_6."','".$partno_7."','".$partno_8."','".$partno_9."','".$partno_10."','".$partno_11."','".$partno_12."','".$partno_13."','".$partno_14."','".$partno_15."',
                        '".$now."', $get_shift,'0', $get_shift,'$supervisor_id');";



                    }
                    elseif ($get_shift==2)
                    {
                        $sql = "INSERT INTO plan_hrxhr (plant_id, site_id, plan_asset, date, 
                        `16`, `17`, `18`, `19`, `20`, `21`, `22`, `23`, 
                        `16h`, `17h`, `18h`, `19h`, `20h`, `21h`, `22h`, `23h`, 
                        wo_16, wo_17, wo_18, wo_19, wo_20, wo_21, wo_22, wo_23,  
                        pn_16, pn_17, pn_18, pn_19, pn_20, pn_21, pn_22, pn_23,  
                        date_create, turno, status, shift, supervisor) 
                        VALUES('" . $plant_id . "', '" . $site_id . "', '" . $asset_id . "', '".$date."', 
                        '".$plan_by_hr_16."', '".$plan_by_hr_17."', '".$plan_by_hr_18."', '".$plan_by_hr_19."', '".$plan_by_hr_20."',
                         '".$plan_by_hr_21."', '".$plan_by_hr_22."', '".$plan_by_hr_23."', 
                        '".$hc_16."','".$hc_17."','".$hc_18."','".$hc_19."','".$hc_20."','".$hc_21."','".$hc_22."','".$hc_23."', 
                        '".$wo_number_16."','".$wo_number_17."','".$wo_number_18."','".$wo_number_19."','".$wo_number_20."','".$wo_number_21."','".$wo_number_22."','".$wo_number_23."',
                        '".$partno_16."','".$partno_17."','".$partno_18."','".$partno_19."','".$partno_20."','".$partno_21."','".$partno_22."','".$partno_23."',
                        '".$now."', $get_shift,'0', $get_shift,'$supervisor_id');";
                    }
                    elseif ($get_shift == 3)
                    {
                        $sql = "INSERT INTO plan_hrxhr (plant_id, site_id, plan_asset, date, 
                        `24`, `1`, `2`, `3`, `4`, `5`,  
                        `24h`, `1h`, `2h`, `3h`, `4h`, `5h`, 
                        wo_24, wo_1, wo_2, wo_3, wo_4, wo_5,  
                        pn_24, pn_1, pn_2, pn_3, pn_4, pn_5,  
                        date_create, turno, status, shift, supervisor) 
                        VALUES('" . $plant_id . "', '" . $site_id . "', '" . $asset_id . "', '".$date."', 
                        '".$plan_by_hr_24."', '".$plan_by_hr_1."', '".$plan_by_hr_2."', '".$plan_by_hr_3."', '".$plan_by_hr_4."',
                         '".$plan_by_hr_5."', 
                        '".$hc_24."','".$hc_1."','".$hc_2."','".$hc_3."','".$hc_4."','".$hc_5."',
                        '".$wo_number_24."','".$wo_number_1."','".$wo_number_2."','".$wo_number_3."','".$wo_number_4."','".$wo_number_5."',
                        '".$partno_24."','".$partno_1."','".$partno_2."','".$partno_3."','".$partno_4."','".$partno_5."',
                        '".$now."', $get_shift,'0', $get_shift,'$supervisor_id');";
                    }
                    else
                    {
                        $this->errors[] = "No se pudo obtener el turno.";
                    }

                    $query_new_plan_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_plan_insert)
                    {
                        $this->messages[] = "Se ha creado un plan para este punto de captura.";
                    }
                    else
                    {
                        $this->errors[] = "Lo sentimos , el registro fallo $sql.";
                    }
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




    private function updatePlan()
    {
        echo "<h1 style='font-size: 65px'>Works1</h1>";
        $hc_op = 1;
        $partno_op = 1;
        echo "POST: <h2>{$_POST['partno_6']}</h2>";

        if (empty($_POST['plant_id']))
        {
            $this->errors[] = "Planta no reconocida";
        }
        elseif(empty($_POST['site_id'])){
            $this->errors[] = "Celda o linea no reconocidos";
        }
        elseif(empty($_POST['asset_id'])){
            $this->errors[] = "Punto de captura no reconocido";
        }
        elseif(empty($_POST['date_id'])){
            $this->errors[] = "El plan debe tener una fecha";
        }
        elseif (empty($_POST['hc_6']) && empty($_POST['hc_7']) && empty($_POST['hc_8']) && empty($_POST['hc_9'])
            && empty($_POST['hc_10']) && empty($_POST['hc_11']) && empty($_POST['hc_12']) && empty($_POST['hc_13'])
            && empty($_POST['hc_14']) && empty($_POST['hc_15']) )
        {
            $hc_op = 0;
            $this->errors[] = "Debe llenar al menos un campo de headcount";
        }
        elseif (empty($_POST['partno_6']) && empty($_POST['partno_7']) && empty($_POST['partno_8']) && empty($_POST['partno_9'])
            && empty($_POST['partno_10']) && empty($_POST['partno_11']) && empty($_POST['partno_12']) && empty($_POST['partno_13'])
            && empty($_POST['partno_14']) && empty($_POST['partno_15']) )
        {
            $partno_op = 0;
            $this->errors[] = "Debe llenar al menos un campo de numero de parte";
        }
        elseif (!empty($_POST['plant_id'])
            && !empty($_POST['site_id'])
            && !empty($_POST['asset_id'])
            && !empty($_POST['date_id'])
            && $hc_op == 1
            && $partno_op == 1
        )
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {

                $plant_id = $this->db_connection->real_escape_string(strip_tags($_POST['plant_id'], ENT_QUOTES));
                $site_id  = $this->db_connection->real_escape_string(strip_tags($_POST['site_id'], ENT_QUOTES));
                $asset_id = $this->db_connection->real_escape_string(strip_tags($_POST['asset_id'], ENT_QUOTES));
                $date     = $this->db_connection->real_escape_string(strip_tags($_POST['date_id'], ENT_QUOTES));
                $now = date("Y-m-d H:i:s");

                if(isset($_POST['hc_6'])&& $_POST['hc_6'] != 0) { $hc_6=$_POST['hc_6']; } else { $hc_6 = 0; }
                if(isset($_POST['hc_7'])&& $_POST['hc_7'] != 0) { $hc_7=$_POST['hc_7']; } else { $hc_7 = 0; }
                if(isset($_POST['hc_8'])&& $_POST['hc_8'] != 0) { $hc_8=$_POST['hc_8']; } else { $hc_8 = 0; }
                if(isset($_POST['hc_9'])&& $_POST['hc_9'] != 0) { $hc_9=$_POST['hc_9']; } else { $hc_9 = 0; }
                if(isset($_POST['hc_10'])&& $_POST['hc_10'] != 0) { $hc_10=$_POST['hc_10']; } else { $hc_10 = 0; }
                if(isset($_POST['hc_11'])&& $_POST['hc_11'] != 0) { $hc_11=$_POST['hc_11']; } else { $hc_11 = 0; }
                if(isset($_POST['hc_12'])&& $_POST['hc_12'] != 0) { $hc_12=$_POST['hc_12']; } else { $hc_12 = 0; }
                if(isset($_POST['hc_13'])&& $_POST['hc_13'] != 0) { $hc_13=$_POST['hc_13']; } else { $hc_13 = 0; }
                if(isset($_POST['hc_14'])&& $_POST['hc_14'] != 0) { $hc_14=$_POST['hc_14']; } else { $hc_14 = 0; }
                if(isset($_POST['hc_15'])&& $_POST['hc_15'] != 0) { $hc_15=$_POST['hc_15']; } else { $hc_15 = 0; }



                if(isset($_POST['partno_6'])) { $partno_6 = $_POST['partno_6']; } else { $partno_6 = 0; }
                if(isset($_POST['partno_7'])&& $_POST['partno_7'] != "") { $partno_7=$_POST['partno_7']; } else { $partno_7 = 0; }
                if(isset($_POST['partno_8'])&& $_POST['partno_8'] != 0) { $partno_8=$_POST['partno_8']; } else { $partno_8 = 0; }
                if(isset($_POST['partno_9'])&& $_POST['partno_9'] != 0) { $partno_9=$_POST['partno_9']; } else { $partno_9 = 0; }
                if(isset($_POST['partno_10'])&& $_POST['partno_10'] != 0) { $partno_10=$_POST['partno_10']; } else { $partno_10 = 0; }
                if(isset($_POST['partno_11'])&& $_POST['partno_11'] != 0) { $partno_11=$_POST['partno_11']; } else { $partno_11 = 0; }
                if(isset($_POST['partno_12'])&& $_POST['partno_12'] != 0) { $partno_12=$_POST['partno_12']; } else { $partno_12 = 0; }
                if(isset($_POST['partno_13'])&& $_POST['partno_13'] != 0) { $partno_13=$_POST['partno_13']; } else { $partno_13 = 0; }
                if(isset($_POST['partno_14'])&& $_POST['partno_14'] != 0) { $partno_14=$_POST['partno_14']; } else { $partno_14 = 0; }
                if(isset($_POST['partno_15'])&& $_POST['partno_15'] != 0) { $partno_15=$_POST['partno_15']; } else { $partno_15 = 0; }



                if(isset($_POST['wo_number_6'])&& $_POST['wo_number_6'] != 0) { $wo_number_6=$_POST['wo_number_6']; } else { $wo_number_6 = 0; }
                if(isset($_POST['wo_number_7'])&& $_POST['wo_number_7'] != 0) { $wo_number_7=$_POST['wo_number_7']; } else { $wo_number_7 = 0; }
                if(isset($_POST['wo_number_8'])&& $_POST['wo_number_8'] != 0) { $wo_number_8=$_POST['wo_number_8']; } else { $wo_number_8 = 0; }
                if(isset($_POST['wo_number_9'])&& $_POST['wo_number_9'] != 0) { $wo_number_9=$_POST['wo_number_9']; } else { $wo_number_9 = 0; }
                if(isset($_POST['wo_number_10'])&& $_POST['wo_number_10'] != 0) { $wo_number_10=$_POST['wo_number_10']; } else { $wo_number_10 = 0; }
                if(isset($_POST['wo_number_11'])&& $_POST['wo_number_11'] != 0) { $wo_number_11=$_POST['wo_number_11']; } else { $wo_number_11 = 0; }
                if(isset($_POST['wo_number_12'])&& $_POST['wo_number_12'] != 0) { $wo_number_12=$_POST['wo_number_12']; } else { $wo_number_12 = 0; }
                if(isset($_POST['wo_number_13'])&& $_POST['wo_number_13'] != 0) { $wo_number_13=$_POST['wo_number_13']; } else { $wo_number_13 = 0; }
                if(isset($_POST['wo_number_14'])&& $_POST['wo_number_14'] != 0) { $wo_number_14=$_POST['wo_number_14']; } else { $wo_number_14 = 0; }
                if(isset($_POST['wo_number_15'])&& $_POST['wo_number_15'] != 0) { $wo_number_15=$_POST['wo_number_15']; } else { $wo_number_15 = 0; }


                if(isset($_POST['plan_by_hr_6'])&& $_POST['plan_by_hr_6'] != 0) { $plan_by_hr_6 = $_POST['plan_by_hr_6']; } else { $plan_by_hr_6 = 0; }
                if(isset($_POST['plan_by_hr_7'])&& $_POST['plan_by_hr_7'] != 0) { $plan_by_hr_7=$_POST['plan_by_hr_7']; } else { $plan_by_hr_7 = 0; }
                if(isset($_POST['plan_by_hr_8'])&& $_POST['plan_by_hr_8'] != 0) { $plan_by_hr_8=$_POST['plan_by_hr_8']; } else { $plan_by_hr_8 = 0; }
                if(isset($_POST['plan_by_hr_9'])&& $_POST['plan_by_hr_9'] != 0) { $plan_by_hr_9=$_POST['plan_by_hr_9']; } else { $plan_by_hr_9 = 0; }
                if(isset($_POST['plan_by_hr_10'])&& $_POST['plan_by_hr_10'] != 0) { $plan_by_hr_10=$_POST['plan_by_hr_10']; } else { $plan_by_hr_10 = 0; }
                if(isset($_POST['plan_by_hr_11'])&& $_POST['plan_by_hr_11'] != 0) { $plan_by_hr_11=$_POST['plan_by_hr_11']; } else { $plan_by_hr_11 = 0; }
                if(isset($_POST['plan_by_hr_12'])&& $_POST['plan_by_hr_12'] != 0) { $plan_by_hr_12=$_POST['plan_by_hr_12']; } else { $plan_by_hr_12 = 0; }
                if(isset($_POST['plan_by_hr_13'])&& $_POST['plan_by_hr_13'] != 0) { $plan_by_hr_13=$_POST['plan_by_hr_13']; } else { $plan_by_hr_13 = 0; }
                if(isset($_POST['plan_by_hr_14'])&& $_POST['plan_by_hr_14'] != 0) { $plan_by_hr_14=$_POST['plan_by_hr_14']; } else { $plan_by_hr_14 = 0; }
                if(isset($_POST['plan_by_hr_15'])&& $_POST['plan_by_hr_15'] != 0) { $plan_by_hr_15=$_POST['plan_by_hr_15']; } else { $plan_by_hr_15 = 0; }



                $sql = "SELECT * FROM plan_hrxhr WHERE date = '$date';";
                $query_check_date = $this->db_connection->query($sql);

                if ($query_check_date->num_rows == 1) {
                    $this->errors[] = "Ya existe un plan con esta fecha debe editarlo.";
                } else {

                    $sql = "INSERT INTO plan_hrxhr (plant_id, site_id, plan_asset, date, 
                        `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, 
                        `6h`, `7h`, `8h`, `9h`, `10h`, `11h`, `12h`, `13h`, `14h`, `15h`, 
                        wo_6, wo_7, wo_8, wo_9, wo_10, wo_11, wo_12, wo_13, wo_14, wo_15,  
                        pn_6, pn_7, pn_8, pn_9, pn_10, pn_11, pn_12, pn_13, pn_14, pn_15, 
                        date_create, turno, status, shift, supervisor) 
                    VALUES('" . $plant_id . "', '" . $site_id . "', '" . $asset_id . "', '".$date."', 
                    '".$plan_by_hr_6."', '".$plan_by_hr_7."', '".$plan_by_hr_8."', '".$plan_by_hr_9."', '".$plan_by_hr_10."',
                     '".$plan_by_hr_11."', '".$plan_by_hr_12."', '".$plan_by_hr_13."', '".$plan_by_hr_14."', '".$plan_by_hr_15."', 
                    '".$hc_6."','".$hc_7."','".$hc_8."','".$hc_9."','".$hc_10."','".$hc_11."','".$hc_12."','".$hc_13."','".$hc_14."','".$hc_15."', 
                    '".$wo_number_6."','".$wo_number_7."','".$wo_number_8."','".$wo_number_9."','".$wo_number_10."','".$wo_number_11."','".$wo_number_12."','".$wo_number_13."','".$wo_number_14."','".$wo_number_15."',
                    '".$partno_6."','".$partno_7."','".$partno_8."','".$partno_9."','".$partno_10."','".$partno_11."','".$partno_12."','".$partno_13."','".$partno_14."','".$partno_15."',
                    '".$now."', '1','0', '1','1');";
                    $query_new_plan_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_plan_insert) {
                        $this->messages[] = "Se ha creado un plan para este punto de captura.";
                    } else {
                        $this->errors[] = "Lo sentimos , el registro fallo $sql.";
                    }
                }
            } else {
                $this->errors[] = "Lo sentimos, no hay conexion con la base de datos.";
            }
        } else {
            $this->errors[] = "Ocurrio un error de validacion.";
        }
    }



    private function deletePlan()
    {
        echo "<h1 style='font-size: 65px'>Works1</h1>";
        $hc_op = 1;
        $partno_op = 1;

        if (empty($_POST['plant_id']))
        {
            $this->errors[] = "Planta no reconocida";
        }
        elseif(empty($_POST['site_id'])){
            $this->errors[] = "Celda o linea no reconocidos";
        }
        elseif(empty($_POST['asset_id'])){
            $this->errors[] = "Punto de captura no reconocido";
        }
        elseif(empty($_POST['date_id'])){
            $this->errors[] = "El plan debe tener una fecha";
        }
        elseif (empty($_POST['hc_6']) && empty($_POST['hc_7']) && empty($_POST['hc_8']) && empty($_POST['hc_9'])
            && empty($_POST['hc_10']) && empty($_POST['hc_11']) && empty($_POST['hc_12']) && empty($_POST['hc_13'])
            && empty($_POST['hc_14']) && empty($_POST['hc_15']) )
        {
            $hc_op = 0;
            $this->errors[] = "Debe llenar al menos un campo de headcount";
        }
        elseif (empty($_POST['partno_6']) && empty($_POST['partno_7']) && empty($_POST['partno_8']) && empty($_POST['partno_9'])
            && empty($_POST['partno_10']) && empty($_POST['partno_11']) && empty($_POST['partno_12']) && empty($_POST['partno_13'])
            && empty($_POST['partno_14']) && empty($_POST['partno_15']) )
        {
            $partno_op = 0;
            $this->errors[] = "Debe llenar al menos un campo de numero de parte";
        }
        elseif (!empty($_POST['plant_id'])
            && !empty($_POST['site_id'])
            && !empty($_POST['asset_id'])
            && !empty($_POST['date_id'])
            && $hc_op == 1
            && $partno_op == 1
        )
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {

                $plant_id = $this->db_connection->real_escape_string(strip_tags($_POST['plant_id'], ENT_QUOTES));
                $site_id  = $this->db_connection->real_escape_string(strip_tags($_POST['site_id'], ENT_QUOTES));
                $asset_id = $this->db_connection->real_escape_string(strip_tags($_POST['asset_id'], ENT_QUOTES));
                $date     = $this->db_connection->real_escape_string(strip_tags($_POST['date_id'], ENT_QUOTES));
                $now = date("Y-m-d H:i:s");

                if(isset($_POST['hc_6'])&& $_POST['hc_6'] != 0) { $hc_6=$_POST['hc_6']; } else { $hc_6 = 0; }
                if(isset($_POST['hc_7'])&& $_POST['hc_7'] != 0) { $hc_7=$_POST['hc_7']; } else { $hc_7 = 0; }
                if(isset($_POST['hc_8'])&& $_POST['hc_8'] != 0) { $hc_8=$_POST['hc_8']; } else { $hc_8 = 0; }
                if(isset($_POST['hc_9'])&& $_POST['hc_9'] != 0) { $hc_9=$_POST['hc_9']; } else { $hc_9 = 0; }
                if(isset($_POST['hc_10'])&& $_POST['hc_10'] != 0) { $hc_10=$_POST['hc_10']; } else { $hc_10 = 0; }
                if(isset($_POST['hc_11'])&& $_POST['hc_11'] != 0) { $hc_11=$_POST['hc_11']; } else { $hc_11 = 0; }
                if(isset($_POST['hc_12'])&& $_POST['hc_12'] != 0) { $hc_12=$_POST['hc_12']; } else { $hc_12 = 0; }
                if(isset($_POST['hc_13'])&& $_POST['hc_13'] != 0) { $hc_13=$_POST['hc_13']; } else { $hc_13 = 0; }
                if(isset($_POST['hc_14'])&& $_POST['hc_14'] != 0) { $hc_14=$_POST['hc_14']; } else { $hc_14 = 0; }
                if(isset($_POST['hc_15'])&& $_POST['hc_15'] != 0) { $hc_15=$_POST['hc_15']; } else { $hc_15 = 0; }



                if(isset($_POST['partno_6'])&& $_POST['partno_6'] != 0) { $partno_6=$_POST['partno_6']; } else { $partno_6 = 0; }
                if(isset($_POST['partno_7'])&& $_POST['partno_7'] != 0) { $partno_7=$_POST['partno_7']; } else { $partno_7 = 0; }
                if(isset($_POST['partno_8'])&& $_POST['partno_8'] != 0) { $partno_8=$_POST['partno_8']; } else { $partno_8 = 0; }
                if(isset($_POST['partno_9'])&& $_POST['partno_9'] != 0) { $partno_9=$_POST['partno_9']; } else { $partno_9 = 0; }
                if(isset($_POST['partno_10'])&& $_POST['partno_10'] != 0) { $partno_10=$_POST['partno_10']; } else { $partno_10 = 0; }
                if(isset($_POST['partno_11'])&& $_POST['partno_11'] != 0) { $partno_11=$_POST['partno_11']; } else { $partno_11 = 0; }
                if(isset($_POST['partno_12'])&& $_POST['partno_12'] != 0) { $partno_12=$_POST['partno_12']; } else { $partno_12 = 0; }
                if(isset($_POST['partno_13'])&& $_POST['partno_13'] != 0) { $partno_13=$_POST['partno_13']; } else { $partno_13 = 0; }
                if(isset($_POST['partno_14'])&& $_POST['partno_14'] != 0) { $partno_14=$_POST['partno_14']; } else { $partno_14 = 0; }
                if(isset($_POST['partno_15'])&& $_POST['partno_15'] != 0) { $partno_15=$_POST['partno_15']; } else { $partno_15 = 0; }



                if(isset($_POST['wo_number_6'])&& $_POST['wo_number_6'] != 0) { $wo_number_6=$_POST['wo_number_6']; } else { $wo_number_6 = 0; }
                if(isset($_POST['wo_number_7'])&& $_POST['wo_number_7'] != 0) { $wo_number_7=$_POST['wo_number_7']; } else { $wo_number_7 = 0; }
                if(isset($_POST['wo_number_8'])&& $_POST['wo_number_8'] != 0) { $wo_number_8=$_POST['wo_number_8']; } else { $wo_number_8 = 0; }
                if(isset($_POST['wo_number_9'])&& $_POST['wo_number_9'] != 0) { $wo_number_9=$_POST['wo_number_9']; } else { $wo_number_9 = 0; }
                if(isset($_POST['wo_number_10'])&& $_POST['wo_number_10'] != 0) { $wo_number_10=$_POST['wo_number_10']; } else { $wo_number_10 = 0; }
                if(isset($_POST['wo_number_11'])&& $_POST['wo_number_11'] != 0) { $wo_number_11=$_POST['wo_number_11']; } else { $wo_number_11 = 0; }
                if(isset($_POST['wo_number_12'])&& $_POST['wo_number_12'] != 0) { $wo_number_12=$_POST['wo_number_12']; } else { $wo_number_12 = 0; }
                if(isset($_POST['wo_number_13'])&& $_POST['wo_number_13'] != 0) { $wo_number_13=$_POST['wo_number_13']; } else { $wo_number_13 = 0; }
                if(isset($_POST['wo_number_14'])&& $_POST['wo_number_14'] != 0) { $wo_number_14=$_POST['wo_number_14']; } else { $wo_number_14 = 0; }
                if(isset($_POST['wo_number_15'])&& $_POST['wo_number_15'] != 0) { $wo_number_15=$_POST['wo_number_15']; } else { $wo_number_15 = 0; }


                if(isset($_POST['plan_by_hr_6'])&& $_POST['plan_by_hr_6'] != 0) { $plan_by_hr_6 = $_POST['plan_by_hr_6']; } else { $plan_by_hr_6 = 0; }
                if(isset($_POST['plan_by_hr_7'])&& $_POST['plan_by_hr_7'] != 0) { $plan_by_hr_7=$_POST['plan_by_hr_7']; } else { $plan_by_hr_7 = 0; }
                if(isset($_POST['plan_by_hr_8'])&& $_POST['plan_by_hr_8'] != 0) { $plan_by_hr_8=$_POST['plan_by_hr_8']; } else { $plan_by_hr_8 = 0; }
                if(isset($_POST['plan_by_hr_9'])&& $_POST['plan_by_hr_9'] != 0) { $plan_by_hr_9=$_POST['plan_by_hr_9']; } else { $plan_by_hr_9 = 0; }
                if(isset($_POST['plan_by_hr_10'])&& $_POST['plan_by_hr_10'] != 0) { $plan_by_hr_10=$_POST['plan_by_hr_10']; } else { $plan_by_hr_10 = 0; }
                if(isset($_POST['plan_by_hr_11'])&& $_POST['plan_by_hr_11'] != 0) { $plan_by_hr_11=$_POST['plan_by_hr_11']; } else { $plan_by_hr_11 = 0; }
                if(isset($_POST['plan_by_hr_12'])&& $_POST['plan_by_hr_12'] != 0) { $plan_by_hr_12=$_POST['plan_by_hr_12']; } else { $plan_by_hr_12 = 0; }
                if(isset($_POST['plan_by_hr_13'])&& $_POST['plan_by_hr_13'] != 0) { $plan_by_hr_13=$_POST['plan_by_hr_13']; } else { $plan_by_hr_13 = 0; }
                if(isset($_POST['plan_by_hr_14'])&& $_POST['plan_by_hr_14'] != 0) { $plan_by_hr_14=$_POST['plan_by_hr_14']; } else { $plan_by_hr_14 = 0; }
                if(isset($_POST['plan_by_hr_15'])&& $_POST['plan_by_hr_15'] != 0) { $plan_by_hr_15=$_POST['plan_by_hr_15']; } else { $plan_by_hr_15 = 0; }



                $sql = "SELECT * FROM plan_hrxhr WHERE date = '$date';";
                $query_check_date = $this->db_connection->query($sql);

                if ($query_check_date->num_rows == 1) {
                    $this->errors[] = "Ya existe un plan con esta fecha debe editarlo.";
                } else {

                    $sql = "INSERT INTO plan_hrxhr (plant_id, site_id, plan_asset, date, 
                        `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, 
                        `6h`, `7h`, `8h`, `9h`, `10h`, `11h`, `12h`, `13h`, `14h`, `15h`, 
                        wo_6, wo_7, wo_8, wo_9, wo_10, wo_11, wo_12, wo_13, wo_14, wo_15,  
                        pn_6, pn_7, pn_8, pn_9, pn_10, pn_11, pn_12, pn_13, pn_14, pn_15, 
                        date_create, turno, status, shift, supervisor) 
                    VALUES('" . $plant_id . "', '" . $site_id . "', '" . $asset_id . "', '".$date."', 
                    '".$plan_by_hr_6."', '".$plan_by_hr_7."', '".$plan_by_hr_8."', '".$plan_by_hr_9."', '".$plan_by_hr_10."',
                     '".$plan_by_hr_11."', '".$plan_by_hr_12."', '".$plan_by_hr_13."', '".$plan_by_hr_14."', '".$plan_by_hr_15."', 
                    '".$hc_6."','".$hc_7."','".$hc_8."','".$hc_9."','".$hc_10."','".$hc_11."','".$hc_12."','".$hc_13."','".$hc_14."','".$hc_15."', 
                    '".$wo_number_6."','".$wo_number_7."','".$wo_number_8."','".$wo_number_9."','".$wo_number_10."','".$wo_number_11."','".$wo_number_12."','".$wo_number_13."','".$wo_number_14."','".$wo_number_15."',
                    '".$partno_6."','".$partno_7."','".$partno_8."','".$partno_9."','".$partno_10."','".$partno_11."','".$partno_12."','".$partno_13."','".$partno_14."','".$partno_15."',
                    '".$now."', '1','0', '1','1');";
                    $query_new_plan_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_plan_insert) {
                        $this->messages[] = "Se ha creado un plan para este punto de captura.";
                    } else {
                        $this->errors[] = "Lo sentimos , el registro fallo $sql.";
                    }
                }
            } else {
                $this->errors[] = "Lo sentimos, no hay conexion con la base de datos.";
            }
        } else {
            $this->errors[] = "Ocurrio un error de validacion.";
        }
    }



}
