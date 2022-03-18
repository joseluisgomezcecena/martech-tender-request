<?php
require_once("includes/header.php");
include_once("includes/topbar.php");
include_once("includes/sidebar.php");
include_once("views/dashboard/dashboard.php");
?>

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
            <div class="card-body p-4">
                <canvas style="" id="requestChart"></canvas>
            </div>
        </div>
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
                <!-- Simple DataTables example-->
                <table id="datatablesSimple" class="text-center table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">Request ID</th>
                        <th class="text-center">Tender Date</th>
                        <th class="text-center">Items</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>7</td>
                        <td>Moldeo</td>
                        <td>Moldeo</td>
                        <td>
                            <a href="" class="btn btn-warning">
                                <i class="material-icons icon-sm me-1 text-light">edit</i>
                            </a>
                            <a href="" class="btn btn-danger">
                                <i class="material-icons icon-sm me-1">delete</i>

                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Moldeo</td>
                        <td>Moldeo</td>
                        <td>
                            <a href="" class="btn btn-warning">
                                <i class="material-icons icon-sm me-1 text-light">edit</i>
                            </a>
                            <a href="" class="btn btn-danger">
                                <i class="material-icons icon-sm me-1">delete</i>

                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>


<?php
include_once("includes/footer.php");
?>



