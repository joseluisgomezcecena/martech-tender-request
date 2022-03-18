<div class="container mt-4">
    <div class="row gx-2 mb-5">
        <!-- tabla -->
        <div class="card card-raised col-lg-8">
            <div class="card-header bg-transparent px-4 gx-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="me-4">
                        <h2 class="card-title mb-0">Lost / Won Report</h2>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-lg btn-icon" type="button"><i class="material-icons">download</i></button>
                        <button class="btn btn-lg btn-icon" type="button"><i class="material-icons">print</i></button>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <input type="date" class="form-control" id="min">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <input type="date" class="form-control" id="max">
                        </div>
                    </div>
                </div>
                <table id="report_lost_won" class="text-center table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Customer</th>
                        <th class="text-center">Lost/Won</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    /*
                    SELECT * FROM request
                    LEFT JOIN delivery ON delivery.request_id = request.id
                    LEFT JOIN delivery_items ON delivery_items.delivery_id = delivery.delivery_id
                    LEFT JOIN item ON item.item_id = delivery_items.item_id;
                     */
                    $query_sql = "SELECT * FROM request
                    LEFT JOIN delivery ON delivery.request_id = request.id
                    LEFT JOIN delivery_items ON delivery_items.delivery_id = delivery.delivery_id
                    LEFT JOIN item ON item.item_id = delivery_items.item_id;";

                    $result = mysqli_query($connection, $query_sql);

                    while ($row = mysqli_fetch_array($result)) :
                        ?>
                        <tr>
                            <th scope="row"><?php echo $row['item']; ?></th>
                            <td><?php echo $row['item_family']; ?></td>
                            <td><?php echo $row['sales_group']; ?></td>
                            <td><?php echo $row['sales_price']; ?></td>
                            <td><?php echo $row['um']; ?></td>
                        </tr>
                    <?php
                    endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
