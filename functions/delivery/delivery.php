<?php

function saveDelivery(){
    global $connection;
    if(isset($_POST['add_delivery']))
    {
        $error = 0;
        $cont = $_POST['cont'];
        $request_id = $_GET['id'];
        $delivery_date = $_POST['delivery_date'];

        $insert_delivery = "INSERT INTO delivery (delivery_date, total, request_id) 
        VALUES ('".$delivery_date."', $cont, $request_id)";
        $run_insert = mysqli_query($connection, $insert_delivery);
        if($run_insert)
        {
            $delivery_id = mysqli_insert_id($connection);

            for($x=1; $x <= $cont; $x++)
            {
                $total = ${'total'.$x} = $_POST['total_'.$x];
                $qty = ${'qty'.$x} = $_POST['qty_'.$x];
                $date = ${'date'.$x} = $_POST['date_'.$x];
                $etr = ${'etr'.$x} = $_POST['etr_'.$x];
                $item_id = ${'item'.$x} = $_POST['item_'.$x];


                $total = mysqli_real_escape_string($connection, $total);
                $qty = mysqli_real_escape_string($connection, $qty);
                $date = mysqli_real_escape_string($connection, $date);
                $etr = mysqli_real_escape_string($connection, $etr);

                $query = "INSERT INTO delivery_items (delivery_id, item_id, qty, mmw_date, etr) 
                VALUES ($delivery_id, $item_id, $qty, '$date', '$etr')";

                $result = mysqli_query($connection, $query);

                if(!$result)
                {
                    $error++;
                }
            }

            if($error > 0)
            {
                echo "$error Errors found.";
            }
            else
            {
                //echo "Delivery saved!";
                header("Location: index.php?page=tender_request_form&id=$request_id#step_3");
            }
        }




    }
}
