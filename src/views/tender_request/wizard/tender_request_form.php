<div class="container mt-4">
    <div class="row">
        <div class="bg-white shadow p-3">
            <h1 class="display-5 mb-4">Tender request form</h1>
            <ul class="nav nav-pills nav-justified" id="myTab">
                <li class="nav-item active" role="presentation">
                    <a class="nav-link active btn" href="#step_1">Step 1</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link btn" href="#step_2">Step 2</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link btn" href="#step_3">Step 3</a>
                </li>
            </ul>

            <div class="tab-content mt-4">
                <div class="tab-pane active" id="step_1">
                    <?php require_once('tender_form.php'); ?>
                </div>
                <div class="tab-pane" id="step_2">
                    <?php require_once('item_form.php'); ?>
                </div>
                <div class="tab-pane" id="step_3">
                    <?php require_once('delivery_form.php'); ?>

                </div>
            </div>
        </div>
    </div>
</div>