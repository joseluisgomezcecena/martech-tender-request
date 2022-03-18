    <?php
    require_once('./functions/requests/save_request.php');
    saveRequest();
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $query = "SELECT id, date_requested, customer, customer_service_rep, customer_number, 
        sales_rep, tender_number, bid_date, penalty, award_date, penalty_descr, won_lost, 
        delivery_specs, site, notes 
        FROM request WHERE id = {$_GET['id']}";

        $run = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($run);
        $date_requested = $row['date_requested'];
        $customer = $row['customer'];
        $customer_service_rep = $row['customer_service_rep'];
        $customer_number = $row['customer_number'];
        $sales_rep = $row['sales_rep'];
        $tender_number = $row['tender_number'];
        $bid_date = $row['bid_date'];
        $penalty = $row['penalty'];
        $award_date = $row['award_date'];
        $penalty_descr = $row['penalty_descr'];
        $won_lost = $row['won_lost'];
        $delivery_specs = $row['delivery_specs'];
        $notes = $row['notes'];
    }
    else{
        $date_requested = '';
        $customer = '';
        $customer_service_rep = '';
        $customer_number = '';
        $sales_rep = '';
        $tender_number = '';
        $bid_date = '';
        $penalty = '';
        $award_date = '';
        $penalty_descr = '';
        $won_lost = '';
        $delivery_specs = '';
        $notes = '';
    }
    ?>
    <form method="post">
        <div class="row g-2">
            <div class="col-md mb-4">
                <label for="date_requested">Date requested</label>
                <input type="date" class="form-control" name="date_requested" id="date_requested" value="<?php echo $date_requested ?>">
            </div>
            <div class="col-md mb-4">
                <label for="customer_name">Customer Name</label>
                <input list="customers" class="form-control" name="customer" value="<?php echo $customer ?>" id="customersid">

                <datalist id="customers">
                    <?php
                    $query = "SELECT * FROM customers";
                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_array($result)):
                    ?>
                    <option value="<?php echo $row['customer_id'] ?>" <?php if($customer == $row['customer_id']){echo "selected";}else{echo "";} ?>><?php echo $row['customer_name'] ?> | <?php echo $row['customer_number'] ?></option>
                    <?php endwhile; ?>
                </datalist>
            </div>
        </div>
        <div class="row g-2">
            <div class="col-md mb-4">
                <label for="customer_service_rep">Customer Service Rep</label>
                <input type="text" class="form-control" id="customer_service_rep" name="customer_service_rep" placeholder="Customer Service Rep" value="<?php echo $customer_service_rep ?>">
            </div>
            <div class="col-md mb-4">
                <label for="sales_rep">Sales Rep</label>
                <input type="text" class="form-control" id="sales_rep" name="sales_rep" placeholder="Sales Rep" value="<?php echo $sales_rep ?>">
            </div>
        </div>
        <div class="row g-2">

            <!--
            <div class="col-md mb-4">
                <label for="tender_number">Tender Number</label>
                <input type="text" class="form-control" id="tender_number" name="tender_number" placeholder="Tender Number" value="<?php echo $tender_number ?>">
            </div>

            <div class="col-md mb-4">
                <label for="customer_number">Customer Number</label>
                <input type="text" class="form-control" id="customer_number" name="customer_number" placeholder="Customer Number" value="<?php echo $customer_number ?>">
            </div>
            -->
        </div>
        <div class="row g-2">
            <div class="col-md mb-4">
                <label for="bid_due_date">Bid Due Date</label>
                <input type="date" class="form-control" id="bid_due_date" name="bid_due_date" value="<?php echo $bid_date ?>">
            </div>
            <div class="col-md mb-4">
                <label for="award_date">Award Date</label>
                <input type="date" class="form-control" id="award_date" name="award_date" value="<?php echo $award_date ?>">
            </div>
        </div>
        <div class="row g-2">
            <div class="col-md mb-4">
                <label for="penalties">Penalties</label>
                <select  class="form-control" id="penalties" name="penalty" required >
                    <option>Select Value</option>
                    <option>No</option>
                    <option>Yes</option>
                </select>
            </div>
            <div class="col-md mb-4">
                <label for="is_penalty">If yes, What is penalty?</label>
                <input type="text" class="form-control" id="is_penalty" name="penalty_descr" placeholder="If yes, What is penalty?" value="<?php echo $penalty_descr ?>">
            </div>
        </div>
        <div class="row g-2">
            <div class="col-md mb-4">
                <label for="won_lost">Won/Lost</label>
                <select  class="form-control" id="won_lost" name="won_lost" required>
                    <option value="">TBD</option>
                    <option <?php if($won_lost == 2){echo "selected";}else{echo "";} ?> value="2">Lost</option>
                    <option <?php if($won_lost == 1){echo "selected";}else{echo "";} ?> value="1">Won</option>
                </select>
            </div>
            <div class="col-md mb-4">
                <label for="delivery_specifications">Delivery Specifications</label>
                <input type="text" class="form-control" id="delivery_specifications" name="delivery_specifications" placeholder="Delivery Specifications" value="<?php echo $delivery_specs ?>">
            </div>
        </div>
        <div class="row g-2">
            <div class="col-md mb-4">
                <label for="pertinent_notes">Pertinent Notes</label>
                <textarea class="form-control" rows="3" id="pertinent_notes" name="notes" placeholder="Pertinent Notes"><?php echo $notes ?></textarea>
            </div>
            <div class="col-md mb-4"></div>
        </div>
        <div class="col-md-6 mb-4"></div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary" type="submit" name="submit">Next step</button>
        </div>
    </form>
