<?php

function saveRequest(){

    global $connection;

    if(isset($_POST["submit"]))
    {

        $date_requested =  mysqli_real_escape_string($connection, $_POST['date_requested']);
        $customer = mysqli_real_escape_string($connection, $_POST['customer']);
        $customer_service_rep = mysqli_real_escape_string($connection, $_POST['customer_service_rep']);
        //$customer_number = mysqli_real_escape_string($connection, $_POST['customer_number']);
        $sales_rep = mysqli_real_escape_string($connection, $_POST['sales_rep']);
        $bid_date = mysqli_real_escape_string($connection, $_POST['bid_due_date']);
        $penalty = mysqli_real_escape_string($connection, $_POST['penalty']);
        $award_date = mysqli_real_escape_string($connection, $_POST['award_date']);
        $penalty_descr = mysqli_real_escape_string($connection, $_POST['penalty_descr']);
        $won_lost = mysqli_real_escape_string($connection, $_POST['won_lost']);
        $delivery_specs = mysqli_real_escape_string($connection, $_POST['delivery_specifications']);
        //$tender_number = mysqli_real_escape_string($connection, $_POST['tender_number']);
        //$site = mysqli_real_escape_string($connection, $_POST['site']);
        $site = 1;
        $notes = mysqli_real_escape_string($connection, $_POST['notes']);

        $query = "INSERT INTO request (date_requested, customer, customer_service_rep, sales_rep, 
                     bid_date, penalty, 
                     award_date, penalty_descr, won_lost, delivery_specs, site, notes, ) 
                     VALUES ('".$date_requested."','".$customer."', '".$customer_service_rep."', '".$sales_rep."', 
                     '".$bid_date."',  '".$penalty."',  '".$award_date."', '".$penalty_descr."',  '".$won_lost."', 
                     '".$delivery_specs."', '".$site."', '".$notes."')";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            echo "Query Error: " . $query;
        }
        else
        {
            $id = mysqli_insert_id($connection);
            header("Location: index.php?page=tender_request_form&id=$id#step_2");
        }

    }

}
