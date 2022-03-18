<?php

function saveItems()
{
    global $connection;

    if (isset($_POST['save_items']))
    {

        if(isset($_GET['id']))
        {

            $tender_id = $_GET['id'];
            $item = $_POST['item'];
            $description = $_POST['description'];
            $item_family = $_POST['item_family'];
            $sales_group = $_POST['sales_group'];
            $sales_price = $_POST['sales_price'];
            $um = $_POST['um'];

            $query = "INSERT INTO item (item, item_family, sales_group, sales_price, um, tender_id) 
            VALUES ('$item', '$item_family', '$sales_group','$sales_price', '$um', $tender_id)";
            $result = mysqli_query($connection, $query);
            if($result)
            {
                $message_success = <<<DELIMETER
            <div class="mt-3 mb-3">
                <div class="alert alert-success" role="alert">New item created</div>
            </div>
            DELIMETER;
                echo $message_success;

            }
            else
            {
                $message_success = <<<DELIMETER
            <div class="mt-3 mb-3">
                <div class="alert alert-danger" role="alert">Failed adding item to tender. {$query}</div>
            </div>
            DELIMETER;
                echo $message_success;

            }

        }
        else
        {
            echo "Enter request data first";
        }


    }
}


function getItemTable()
{
    global $connection;
    $query = "SELECT * FROM item WHERE tender_id = {$_GET['id']}";
    $result = mysqli_query($connection, $query);
    while ($row = fetch_array($result)) {
        $table = <<<DELIMETER
            <tr>
                <th scope="row">{$row['item']}</th>
                <td>{$row['item_family']}</td>
                <td>{$row['sales_group']}</td>
                <td>{$row['sales_price']}</td>
                <td>{$row['um']}</td>
                <td>
                    <form method="post">
                        <input type="hidden" name="item_id" value="{$row['item_id']}">
                        <button type="submit" name="delete_item" class="btn btn-outline-danger">
                            <span class="material-icons">
                                delete
                            </span>
                        </button>
                    </form>
                    <!--
                    <a href="http://localhost/tender_request/functions/items/delete_items.php?id={$row['item_id']}" class="btn btn-outline-danger">
                        <span class="material-icons">
                            delete
                        </span>
                    </a>
                    -->
                </td>
                
        </tr>
        DELIMETER;
        echo $table;
    };
}



function deleteItem(){
    global $connection;
    if(isset($_POST['delete_item']))
    {
        $item_id = $_POST['item_id'];
        $query = "DELETE  FROM item WHERE item_id = $item_id";
        $result = mysqli_query($connection, $query);
        if(!$result)
        {
            echo "Failed to delete item $query";
        }
    }
}
