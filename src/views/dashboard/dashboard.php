<?php require_once("./functions/items/items.php") ?>
<div class="container mt-4">
    <!-- cards -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card card-raised border-start bg-primary border-4">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between text-white align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5 text-white">Total Requests</div>
                            <div class="card-text" id="get_all_request"></div>
                        </div>
                        <div class="icon-circle bg-white-50 text-white"><i class="material-icons">query_stats</i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card card-raised border-start bg-secondary border-4">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between text-white align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5 text-white">Won</div>
                            <div class="card-text" id="get_all_won"></div>
                        </div>
                        <div class="icon-circle bg-white-50 text-white"><i class="material-icons">trending_up</i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card card-raised border-start bg-info border-4">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between text-white align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5 text-white">Lost</div>
                            <div class="card-text" id="get_all_lost"></div>
                        </div>
                        <div class="icon-circle bg-white-50 text-white"><i class="material-icons">trending_down</i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row gx-2 mb-5">
        <div class="card card-raised col-lg-4 gx-5">
            <div class="card-header bg-transparent px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="me-4">
                        <h2 class="card-title mb-0">Chart</h2>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-lg btn-icon" type="button"><i class="material-icons">download</i></button>
                        <button class="btn btn-lg btn-icon" type="button"><i class="material-icons">print</i></button>
                    </div>
                </div>
            </div>
            <!-- grafica -->
            <div class="card-body p-4">
                <canvas id="requestChart"></canvas>
            </div>
        </div>
        <!-- tabla -->
        <div class="card card-raised col-lg-8">
            <div class="card-header bg-transparent px-4 gx-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="me-4">
                        <h2 class="card-title mb-0">Recent Request</h2>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-lg btn-icon" type="button"><i class="material-icons">download</i></button>
                        <button class="btn btn-lg btn-icon" type="button"><i class="material-icons">print</i></button>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <table id="datatablesSimple" class="text-center table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Request ID</th>
                            <th class="text-center">Customer</th>
                            <th class="text-center">Request Date</th>
                            <th class="text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //$query_sql = query("SELECT * FROM request");
                        //confirm($query_sql);

                        $query  = "SELECT * FROM request LEFT JOIN customers ON request.customer_number = customers.customer_id";
                        $result = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_array($result)) :
                        ?>
                            <tr>
                                <th scope="row"><?php  tenderNumber($row['id']); ?></th>
                                <td><?php echo $row['customer_name']; ?></td>
                                <td><?php echo $row['date_requested']; ?></td>
                                <td><a class="btn btn-primary" href="index.php?page=tender_request_form&id=<?php echo $row['id']; ?>">Update</a></td>
                            </tr>
                        <?php
                        endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
