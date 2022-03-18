<?php

require_once('./functions/items/items.php');
saveItems();
deleteItem();
?>
<form method="POST">
    <div class="row g-2">
        <div class="col-md mb-4">
            <label for="browser">Choose a part number from the list</label>
            <input class="form-control" list="pn" name="item" id="pn2" onchange="//getValueSelected(this)" required placeholder="Choose a part number from the list">
            <datalist id="pn">
                <?php
                $query = "SELECT * FROM items GROUP BY `Routing identifier`";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_array($result)):
                ?>
                    <option><?php echo $row['0'] ?></option>
                <?php endwhile; ?>
            </datalist>
        </div>
        <div class="col-md mb-4">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" required placeholder="Description">
        </div>
    </div>
    <div class="row g-2">
        <div class="col-md mb-4">
            <label for="item">Item Family</label>
            <input type="text" class="form-control" id="item_family" name="item_family" required placeholder="Item Family">
        </div>
        <div class="col-md mb-4">
            <label for="sales_group">Sales Group</label>
            <input type="text" class="form-control" id="sales_group" name="sales_group" required placeholder="Sales Group">
        </div>
    </div>
    <div class="row g-2">
        <div class="col-md mb-4">
            <label for="sales_price">Sales Price</label>
            <input type="number" class="form-control" id="sales_price" name="sales_price" required placeholder="Sales Price">
        </div>
        <div class="col-md mb-4">
            <label for="um">UM</label>
            <select class="form-control" id="um" name="um">
                <option value="EA">EA</option>
                <option value="BX">BX</option>
            </select>
        </div>
    </div>
    <div class="row g-2">
        <div class="col-md mb-4"></div>
        <div class="col-md mb-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-outline-success" name="save_items" type="submit">
                    <span class="material-icons mx-1">
                        save
                    </span>
                    Save Item
                </button>
            </div>
        </div>
    </div>
</form>

<div class="row g-2">
        <div class="table-responsive">
            <table id="datatablesSimple" class="text-center table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Item Family</th>
                        <th scope="col">Sales Group</th>
                        <th scope="col">Sales Price</th>
                        <th scope="col">UM</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php getItemTable();  ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6 mb-4"></div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn btn-default me-md-2" type="button">Previous</button>
        <button type="submit" class="btn btn-primary" type="button">Next step</button>
    </div>

<script>
    window.onload = function(element) {
        let find_item = document.querySelector("#pn");
        let url = "http://localhost/martech/tender_request/tender_request/functions/items/get_items_select.php"
        let alert_message = document.querySelector(".alert-success");

        if (alert_message !== null) {
            setTimeout(function() {
                $(".alert").alert('close');
            }, 4000);
        }

        fetch(url, {
                method: 'GET',
            })
            .then(res => res.text())
            .then((html) => {
                find_item.innerHTML = html;
            })
            .catch((e) => {
                console.log(e);
            });

        window.addEventListener('DOMContentLoaded', event => {
            const item_table = document.getElementById('item_table');
            if (item_table) {
                new simpleDatatables.DataTable(item_table);
            }
        });
    };

    function getValueSelected(element) {
        const item_selected = document.querySelector("input[name*='item']");
        item_selected.addEventListener("keyup", event => {
            event.preventDefault();
            var response = element.value;
            item_selected.innerHTML = response;
        })
    }
</script>
