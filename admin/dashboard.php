<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin Dashboard - AlphaTech</title>

    <link rel="shortcut icon" href="../assets/images/logo/logo.png" type="image/png">

    <link rel="stylesheet" href="../assets/css/admin/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="../assets/css/admin/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->

    <link rel="stylesheet" href="../assets/css/adminStyle.css" />
    <link rel="stylesheet" href="../assets/css/myStyle.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body id="reportsPage">

    <div id="home">

        <?php

        include "header.php";

        if (isset($_SESSION["a"])) {

        ?>

            <div class="container">
                <div class="row">
                    <div class="col">
                        <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
                    </div>
                </div>
                <!-- row -->
                <div class="row tm-content-row">
                    <div class="col-12 col-lg-6 col-xl-6 tm-block-col">
                        <div class="tm-bg-primary-dark tm-block">
                            <h2 class="tm-block-title">Selling percentage by category</h2>
                            <canvas id="lineChart"></canvas>
                            <script>
                                const width_threshold = 480;
                                
                                function drawLineChart() {
                                    if ($("#lineChart").length) {
                                        ctxLine = document.getElementById("lineChart").getContext("2d");
                                        optionsLine = {
                                            scales: {
                                                yAxes: [{
                                                    scaleLabel: {
                                                        display: true,
                                                        labelString: "Hits"
                                                    }
                                                }]
                                            }
                                        };

                                        // Set aspect ratio based on window width
                                        optionsLine.maintainAspectRatio =
                                            $(window).width() < width_threshold ? false : true;

                                        configLine = {
                                            type: "line",
                                            data: {
                                                labels: [

                                                    <?php

                                                    $category_rs = Database::search("SELECT category.name FROM `invoice`INNER JOIN `product` ON invoice.product_id = product.id INNER JOIN `category` ON product.category_id = category.id GROUP BY product.category_id ORDER BY product.category_id ASC");
                                                    $category_num = $category_rs->num_rows;

                                                    for ($z = 0; $z < $category_num; $z++) {

                                                        $category_data = $category_rs->fetch_assoc();

                                                        $cname = mb_strimwidth($category_data["name"], 0, 4, ".");

                                                    ?> "<?php echo $cname; ?>",

                                                    <?php
                                                    }
                                                    ?>
                                                ],
                                                datasets: [{
                                                    label: " ",
                                                    data: [

                                                        <?php

                                                        $category2_rs = Database::search("SELECT SUM(product.qty) AS ptqty,SUM(invoice.qty) AS itqty FROM `invoice`INNER JOIN `product` ON invoice.product_id = product.id GROUP BY product.category_id ORDER BY product.category_id ASC;");
                                                        $category2_num = $category2_rs->num_rows;

                                                        for ($o = 0; $o < $category2_num; $o++) {

                                                            $category2_data = $category2_rs->fetch_assoc();

                                                            $pt_qty = $category2_data["ptqty"];
                                                            $it_qty = $category2_data["itqty"];

                                                            $qty_pre = ($it_qty / $pt_qty) * 100

                                                        ?>

                                                            <?php echo $qty_pre; ?>,

                                                        <?php
                                                        }
                                                        ?>

                                                    ],
                                                    fill: false,
                                                    borderColor: "rgb(75, 192, 192)",
                                                    cubicInterpolationMode: "monotone",
                                                    pointRadius: 0
                                                }]
                                            },
                                            options: optionsLine
                                        };

                                        lineChart = new Chart(ctxLine, configLine);
                                    }
                                }
                            </script>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-6 tm-block-col">
                        <div class="tm-bg-primary-dark tm-block">
                            <h2 class="tm-block-title">Selling percentage by brand</h2>
                            <script>
                                function drawBarChart() {
                                    if ($("#barChart").length) {
                                        ctxBar = document.getElementById("barChart").getContext("2d");

                                        optionsBar = {
                                            responsive: true,
                                            scales: {
                                                yAxes: [{
                                                    barPercentage: 0.2,
                                                    ticks: {
                                                        beginAtZero: true
                                                    },
                                                    scaleLabel: {
                                                        display: true,
                                                        labelString: " "
                                                    }
                                                }]
                                            }
                                        };

                                        optionsBar.maintainAspectRatio =
                                            $(window).width() < width_threshold ? false : true;

                                        configBar = {
                                            type: "horizontalBar",
                                            data: {
                                                labels: [
                                                    <?php

                                                    $brand_rs = Database::search("SELECT brand.name FROM `invoice` INNER JOIN `product` ON invoice.product_id = product.id INNER JOIN `brand_has_model` ON product.brand_has_model_id = brand_has_model.id INNER JOIN `brand` ON brand_has_model.brand_id = brand.id GROUP BY brand_has_model.brand_id ORDER BY brand_has_model.brand_id ASC");
                                                    $brand_num = $brand_rs->num_rows;

                                                    for ($z = 0; $z < $brand_num; $z++) {

                                                        $brand_data = $brand_rs->fetch_assoc();

                                                        $cname = mb_strimwidth($brand_data["name"], 0, 5, ".");

                                                    ?> "<?php echo $cname; ?>",

                                                    <?php
                                                    }
                                                    ?>
                                                ],
                                                datasets: [{
                                                    label: " ",
                                                    data: [
                                                        <?php

                                                        $brand2_rs = Database::search("SELECT SUM(product.qty) AS ptqty2, SUM(invoice.qty) AS itqty2 FROM `invoice` INNER JOIN `product` ON invoice.product_id = product.id INNER JOIN `brand_has_model` ON product.brand_has_model_id = brand_has_model.id INNER JOIN `brand` ON brand_has_model.brand_id = brand.id GROUP BY brand_has_model.brand_id ORDER BY brand_has_model.brand_id ASC");
                                                        $brand2_num = $brand2_rs->num_rows;

                                                        for ($o = 0; $o < $brand2_num; $o++) {

                                                            $brand2_data = $brand2_rs->fetch_assoc();

                                                            $pt_qty2 = $brand2_data["ptqty2"];
                                                            $it_qty2 = $brand2_data["itqty2"];

                                                            $qty_pre2 = ($it_qty2 / $pt_qty2) * 100

                                                        ?>

                                                            <?php echo $qty_pre2; ?>,

                                                        <?php
                                                        }
                                                        ?>
                                                    ],
                                                    backgroundColor: [
                                                        "#F7604D",
                                                        "#4ED6B8",
                                                        "#A8D582",
                                                        "#D7D768",
                                                        "#9D66CC",
                                                        "#DB9C3F",
                                                        "#3889FC",
                                                        "#D63384"
                                                    ],
                                                    borderWidth: 0
                                                }]
                                            },
                                            options: optionsBar
                                        };

                                        barChart = new Chart(ctxBar, configBar);
                                    }
                                }
                            </script>
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-6 tm-block-col">
                        <div class="tm-bg-primary-dark tm-block tm-block-taller">
                            <div class="col-8 offset-2">
                                <h2 class="tm-block-title">Storage Information</h2>
                                <script>
                                    function drawPieChart() {
                                        if ($("#pieChart").length) {
                                            var chartHeight = 350;

                                            $("#pieChartContainer").css("height", chartHeight + "px");

                                            ctxPie = document.getElementById("pieChart").getContext("2d");

                                            optionsPie = {
                                                responsive: true,
                                                maintainAspectRatio: false,
                                                layout: {
                                                    padding: {
                                                        left: 10,
                                                        right: 10,
                                                        top: 0,
                                                        bottom: 10
                                                    }
                                                },
                                                legend: {
                                                    position: "top"
                                                }
                                            };

                                            configPie = {
                                                type: "pie",
                                                data: {
                                                    datasets: [{
                                                        data: [

                                                            <?php

                                                            $store_rs = Database::search("SELECT SUM(qty) AS sqty  FROM `product` GROUP BY category_id ORDER BY category_id ASC");
                                                            $store_num = $store_rs->num_rows;

                                                            for ($s = 0; $s < $store_num; $s++) {

                                                                $store_data = $store_rs->fetch_assoc();

                                                            ?>
                                                                <?php echo $store_data["sqty"]; ?>,
                                                            <?php
                                                            }
                                                            ?>
                                                        ],
                                                        backgroundColor: [
                                                            "#F7604D",
                                                            "#4ED6B8",
                                                            "#A8D582",
                                                            "#DB9C3F",
                                                            "#9D66CC"
                                                        ],
                                                        label: "Storage"
                                                    }],
                                                    labels: [
                                                        <?php

                                                        $store2_rs = Database::search("SELECT SUM(qty) AS sqty2, `category`.`name` FROM `product` INNER JOIN `category` ON product.category_id = category.id GROUP BY category_id ORDER BY category_id ASC");
                                                        $store2_num = $store2_rs->num_rows;

                                                        for ($s = 0; $s < $store2_num; $s++) {

                                                            $store2_data = $store2_rs->fetch_assoc();

                                                        ?> "<?php echo $store2_data["name"]; ?> (<?php echo $store2_data["sqty2"]; ?> Items)",
                                                        <?php
                                                        }
                                                        ?>
                                                    ]
                                                },
                                                options: optionsPie
                                            };

                                            pieChart = new Chart(ctxPie, configPie);
                                        }
                                    }
                                </script>
                                <div id="pieChartContainer">
                                    <canvas id="pieChart" class="chartjs-render-monitor" width="200" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                        <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                            <h2 class="tm-block-title">User reviews</h2>
                            <div class="tm-notification-items">
                                <?php

                                $review_rs = Database::search("SELECT * FROM `review` INNER JOIN `user` ON review.user_email = user.email INNER JOIN `profile_image` ON user.email = profile_image.user_email");
                                $review_num = $review_rs->num_rows;

                                for ($y = 0; $y < $review_num; $y++) {

                                    $review_data = $review_rs->fetch_assoc();

                                ?>
                                    <div class="media tm-notification-item">
                                        <div class="tm-gray-circle"><img src="<?php echo "../" . $review_data["code"]; ?>" alt="Avatar Image" class="rounded-circle" style="width:80px;"></div>
                                        <div class="media-body">
                                            <div class="row">
                                                <h6 class="text-warning"><?php echo $review_data["fname"] . " " . $review_data["lname"]; ?></h6>
                                                <span class="text-white mb-1"><?php echo $review_data["review"]; ?></span>
                                                <?php

                                                $rdatabaseDate = $review_data["date"];
                                                $rphpDate = strtotime($rdatabaseDate);
                                                $rdate = date('Y-m-d', $rphpDate)

                                                ?>
                                                <span class="tm-small tm-text-color-secondary"><?php echo $rdate; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 tm-block-col">
                        <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                            <h2 class="tm-block-title">Orders List</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ORDER ID</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">NAME</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col">PRICE</th>
                                        <th scope="col">DATE</th>
                                        <th scope="col">PRODUCT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $order_rs = Database::search("SELECT order_id,invoice.`status`, `user`.fname, `user`.lname, invoice.qty, product.price, invoice.`date`, product.title FROM `invoice` INNER JOIN `user` ON invoice.user_email = user.email INNER JOIN `product` ON invoice.product_id = product.id");
                                    $order_num = $order_rs->num_rows;

                                    for ($x = 0; $x < $order_num; $x++) {

                                        $order_data = $order_rs->fetch_assoc();

                                    ?>
                                        <tr>
                                            <th scope="row"><b><?php echo $order_data["order_id"]; ?></b></th>

                                            <?php

                                            $status = $order_data["status"];

                                            if ($status == 0) {
                                            ?>
                                                <td>
                                                    <div class="tm-status-circle confirm"></div>Confirm Order
                                                </td>
                                            <?php
                                            } else if ($status == 1) {
                                            ?>
                                                <td>
                                                    <div class="tm-status-circle packing"></div>Packing
                                                </td>
                                            <?php
                                            } else if ($status == 2) {
                                            ?>
                                                <td>
                                                    <div class="tm-status-circle dispatch"></div>Dispatch
                                                </td>
                                            <?php
                                            } else if ($status == 3) {
                                            ?>
                                                <td>
                                                    <div class="tm-status-circle shipping"></div>Shipping
                                                </td>
                                            <?php
                                            } else if ($status == 4) {
                                            ?>
                                                <td>
                                                    <div class="tm-status-circle delivered"></div>Delivered
                                                </td>
                                            <?php
                                            }

                                            ?>

                                            <td><b><?php echo $order_data["fname"] . " " . $order_data["lname"]; ?></b></td>
                                            <td><b><?php echo $order_data["qty"]; ?></b></td>
                                            <td><b><?php echo $order_data["price"]; ?></b></td>
                                            <?php

                                            $databaseDate = $order_data["date"];
                                            $phpDate = strtotime($databaseDate);
                                            $date = date('Y-m-d', $phpDate)

                                            ?>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo $order_data["title"]; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    </div>

    <!-- Start Modal Alert -->
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content modal-cbg">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" style="opacity: 1;" onclick="bm.hide();">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <h1 class="text-warning" id="alertText"></h1>
                            </div>
                            <div class="container-fluid text-center mt-2">
                                <a class="btn text-white btn-pink-default-hover btn-width" onclick="bm.hide();">OK</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Alert -->

    <script src="../assets/js/admin/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="../assets/js/admin/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="../assets/js/admin/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="../assets/js/admin/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="../assets/js/adminScripts.js"></script>

    <script src="../assets/js/script.js"></script>

    <script>
        Chart.defaults.global.defaultFontColor = 'white';
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function() {
            drawLineChart(); // Line Chart
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart

            $(window).resize(function() {
                updateLineChart();
                updateBarChart();
            });
        })
    </script>

<?php

        } else {
?>
    <span class="login-error">Please Login First</span>
<?php
        }

        include "footer.php";

?>
</body>

</html>