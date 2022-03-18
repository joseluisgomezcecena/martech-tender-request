</main>
<!-- Footer-->
<footer class="py-4 mt-auto border-top" style="min-height: 74px">
    <div class="container-xl px-5">
        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between small">
            <div class="me-sm-2">Copyright &copy; MARTECH 2022</div>
            <div class="d-flex ms-sm-2">
                <a class="text-decoration-none" href="#!">Privacy Policy</a>
                <div class="mx-1">&middot;</div>
                <a class="text-decoration-none" href="#!">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<!-- Load Bootstrap JS bundle-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<!-- Load global scripts-->
<script type="module" src="assets/js/material.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Load Chart.js via CDN-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0-beta.10/chart.min.js" crossorigin="anonymous"></script>
<!-- Load Simple DataTables Scripts-->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
</body>

<script>
    // get dashboard cards
    window.onload = function() {

        //let url_won = "http://localhost/tender_request/functions/dashboard/get_won.php";
        //let url_lost = "http://localhost/tender_request/functions/dashboard/get_lost.php";
        //let url_request = "http://localhost/tender_request/functions/dashboard/get_requests.php";


        let get_won = document.querySelector("#get_all_won");
        let get_lost = document.querySelector("#get_all_lost");
        let get_request = document.querySelector("#get_all_request");
        let url_won = "http://localhost/martech/tender_request/tender_request/functions/dashboard/get_won.php";
        let url_lost = "http://localhost/martech/tender_request/tender_request/functions/dashboard/get_lost.php";
        let url_request = "http://localhost/martech/tender_request/tender_request/functions/dashboard/get_requests.php";

        fetch(url_request, {
                method: 'GET',
            })
            .then(res => res.text())
            .then((html) => {
                get_request.innerHTML = html;
            })
            .catch((e) => {
                console.log(e);
            });

        fetch(url_won, {
                method: 'GET',
            })
            .then(res => res.text())
            .then((html) => {
                get_won.innerHTML = html;
            })
            .catch((e) => {
                console.log(e);
            });

        fetch(url_lost, {
                method: 'GET',
            })
            .then(res => res.text())
            .then((html) => {
                get_lost.innerHTML = html;
            })
            .catch((e) => {
                console.log(e);
            });
    }
</script>
<script>
    var ctx = document.getElementById('requestChart');
    //const url = "http://localhost/tender_request/functions/dashboard/graph_dashboard.php";
    const url = "http://localhost/martech/tender_request/tender_request/functions/dashboard/graph_dashboard.php";
    const get_graph = async () => {
        $.ajax({
            type: 'GET',
            url: url,
            success: function(html) {
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Lost', 'Won'],
                        datasets: [{
                            data: html,
                            backgroundColor: ['#26A69A', '#6200EA'],
                        }],
                    },
                });
            }
        });
    }

    get_graph();
</script>
<script>
    $(document).ready(function() {
        if (location.hash) {
            $("a[href='" + location.hash + "']").tab("show");
        }
        $(document.body).on("click", "a[data-toggle='tab']", function(event) {
            location.hash = this.getAttribute("href");
        });
    });
    $(window).on("popstate", function() {
        var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
        $("a[href='" + anchor + "']").tab("show");
    });
</script>
<script>
    window.addEventListener('DOMContentLoaded', event => {
        // Simple-DataTables
        // https://github.com/fiduswriter/Simple-DataTables/wiki

        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });


    window.addEventListener('DOMContentLoaded', event => {
        const report_lost_won = document.getElementById('report_lost_won');

        if (report_lost_won) {
            new simpleDatatables.DataTable(report_lost_won);
            const input_min = document.querySelector('#min');
            const input_max = document.querySelector('#max'); 
            const           
        }
    });
</script>
<script src="./assets/js/range_date.js"></script>
</htm
