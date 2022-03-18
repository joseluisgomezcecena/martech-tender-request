<div class="container mt-4">
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
                        $query_sql = query("SELECT * FROM request");
                        confirm($query_sql);

                        while ($row = fetch_array($query_sql)) :
                        ?>
                            <tr>
                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['customer']; ?></td>
                                <td class='<?php echo $row['won_lost'] == '2' ? 'table-danger' : 'table-success' ?>'><?php echo $row['won_lost'] == "2" ? 'Perdida' : 'Ganancia'; ?></td>
                                <td><?php echo $row['date_create']; ?></td>
                                <td>
                                    <a href="index.php?page=request_detail&id=<?php echo $row['id'] ?>" class="btn btn-primary"><i class="material-icons">find_in_page</i></a>
                                </td>
                            </tr>
                        <?php
                        endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
