<?php
require_once "./functions/delivery/delivery.php";
saveDelivery();
?>
<form method="post">
<div class="row g-2">
    <div class="col-lg-6 mb-4">
        <?php
        $delivery_count = 0;
        $query = "SELECT * FROM delivery WHERE request_id = {$_GET['id']}";
        $run = mysqli_query($connection, $query);
        while($row_delivery = mysqli_fetch_array($run)):
            $delivery_count++;
            ?>
             <a href="index.php?page=edit_delivery&id=<?php echo $row_delivery['delivery_id'] ?>">Delivery <?php echo $delivery_count; ?></a>&nbsp;&nbsp;
        <?php endwhile; ?>
        <br>
        <label for="delivery_number">Delivery Number: </label>
        <b><?php echo $delivery_count+1 ?></b>

    </div>

    <div class="col-md mb-4">
        <div class="d-grid gap-2 d-md-flex mt-3 justify-content-md-end">
            <button class="btn btn-success" type="submit" name="add_delivery">Add Delivery</button>
            <a href="index.php?page=tender_request_form&id=<?php echo $_GET['id'] ?>#step_3" class="btn btn-primary">Reload Data</a>
        </div>
    </div>
</div>
<div class="row g-2">
    <div class="col-lg-4 mb-4">
        <label for="month_start">Delivery Date</label>
        <input type="date" class="form-control" name="delivery_date" id="month_start" placeholder="Month">
    </div>
</div>


<div class="row g-2">
    <div class="col-lg-12 mb-4">
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Family</th>
                    <th>Sales Group</th>
                    <th>UM</th>
                    <!--
                    <th>Total</th>
                    -->
                    <th>Quantity</th>
                    <th>MMW Date</th>
                    <th>ETR</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $cont = 0;
            $query = "SELECT * FROM item WHERE tender_id = {$_GET['id']}";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_array($result)):
                $cont++;
            ?>
                <tr>
                    <td><?php echo $row['item'] ?></td>
                    <td><?php echo $row['item_family'] ?></td>
                    <td><?php echo $row['sales_group'] ?></td>
                    <td><?php echo $row['um'] ?></td>
                    <!--
                    <td><input class="form-control" type="number" name="total_<?php echo $cont ?>"> </td>
                    -->
                    <td><input class="form-control" type="number" name="qty_<?php echo $cont ?>"> </td>
                    <td><input class="form-control" type="date" name="date_<?php echo $cont ?>"> </td>
                    <td><input class="form-control" type="date" name="etr_<?php echo $cont ?>"> </td>
                    <input type="hidden" name="item_<?php echo $cont ?>" value="<?php echo $row['item_id'] ?>">
                </tr>
            <?php endwhile; ?>
            </tbody>
            <input type="hidden" name="cont" value="<?php echo $cont; ?>">
        </table>
    </div>

</div>


<!--
<div class="row g-2">
    <div class="col-md mb-4">
        <label for="total">Total</label>
        <input type="text" class="form-control" id="total" placeholder="Total">
    </div>
    <div class="col-md mb-4">
        <label for="quantity">Quantity</label>
        <input type="text" class="form-control" id="quantity" placeholder="Quantity">
    </div>
</div>
<div class="row g-2">
    <div class="col-md mb-4">
        <label for="mmw_date">MMW Date</label>
        <input type="date" class="form-control" id="mmw_date" placeholder="MMW Date">
    </div>
    <div class="col-md mb-4">
        <label for="etr">ETR</label>
        <input type="text" class="form-control" id="etr" placeholder="ETR">
    </div>
</div>
<div class="col-md-6 mb-4"></div>
-->
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button class="btn btn-default me-md-2" type="button">Previous</button>
    <a href="index.php?page=tender_request_table" class="btn btn-primary" type="button">Finish</a>
</div>
</form>
