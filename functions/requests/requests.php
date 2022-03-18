<?php
 $query = query("SELECT * FROM request");
 confirm($query);

 while ($row = fetch_array($query)) {
     $table = <<<DELIMETER
         <tr>
             <th scope="row">{$row['item']}</th>
             <td>{$row['description']}</td>
             <td>{$row['item_family']}</td>
             <td>{$row['sales_group']}</td>
             <td>{$row['sales_price']}</td>
             <td>{$row['um']}</td>
             <td>
                 <a href="http://localhost/tender_request/functions/items/delete_items.php?id={$row['item_id']}" class="btn btn-outline-danger">
                     <span class="material-icons">
                         delete
                     </span>
                 </a>
             </td>
     </tr>
     DELIMETER;
     echo $table;
 };
?>