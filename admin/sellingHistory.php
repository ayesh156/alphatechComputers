<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Selling History - AlphaTech</title>

  <link rel="shortcut icon" href="../assets/images/logo/logo.png" type="image/png">

  <link rel="stylesheet" href="../assets/css/admin/fontawesome.min.css" />
  <!-- https://fontawesome.com/ -->
  <link rel="stylesheet" href="../assets/css/admin/bootstrap.min.css" />
  <!-- https://getbootstrap.com/ -->
  <link rel="stylesheet" href="../assets/jquery-ui-datepicker/jquery-ui.min.css" type="text/css" />
  <!-- http://api.jqueryui.com/datepicker/ -->

  <link rel="stylesheet" href="../assets/css/adminStyle.css" />
  <link rel="stylesheet" href="../assets/css/myStyle.css">

  <!-- Main CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body id="reportsPage">

  <?php

  include "header.php";

  if (isset($_SESSION["a"])) {

  ?>

    <div class="container col-xl-10 offset-xl-1 mt-5">
      <div class="row tm-content-row">
        <div class="col-12 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-order">
            <div class="tm-product-table-container">
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">INVOICE ID</th>
                    <th scope="col">PRODUCT</th>
                    <th scope="col">BUYER</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">AMOUNT</th>
                    <th scope="col"><pre>                 </pre></th>
                  </tr>
                </thead>
                <tbody id="sellngHistoryResult">
                  <?php

                  $order_rs = Database::search("SELECT `invoice`.`id`,`invoice`.`invoice_id`,`product`.`title`,`user`.`fname`,`user`.`lname`,`invoice`.`qty`,`invoice`.`total`,`invoice`.`status` FROM `invoice` INNER JOIN `user` ON `invoice`.`user_email` = `user`.`email` INNER JOIN `product` ON `invoice`.`product_id` = `product`.`id` ORDER BY `invoice`.`status` ASC");
                  $order_num = $order_rs->num_rows;

                  for ($x = 0; $x < $order_num; $x++) {

                    $order_data = $order_rs->fetch_assoc();

                  ?>
                    <tr>
                      <td><?php echo $order_data["id"]; ?></td>
                      <td><?php echo $order_data["invoice_id"]; ?></td>
                      <td class="tm-product-name"><?php echo $order_data["title"]; ?></td>
                      <td><?php echo $order_data["fname"] . " " . $order_data["lname"]; ?></td>
                      <td class="text-center"><?php echo $order_data["qty"]; ?></td>
                      <td>Rs.<?php echo $order_data["total"]; ?>.00</td>
                      <td>
                        <?php
                        if ($order_data["status"] == 0) {
                        ?>
                          <button class="confirm-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Confirm Order</button>
                        <?php
                        } else if ($order_data["status"] == 1) {
                        ?>
                          <button class="packing-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Packing</button>
                        <?php
                        } else if ($order_data["status"] == 2) {
                        ?>
                          <button class="dispatch-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Dispatch</button>
                        <?php
                        } else if ($order_data["status"] == 3) {
                        ?>
                          <button class="shipping-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Shipping</button>
                        <?php
                        } else if ($order_data["status"] == 4) {
                        ?>
                          <button class="delivered-btn disabled" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Delivered</button>
                        <?php
                        }

                        ?>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- table container -->
            <div class="row">
              <div class="col-12 col-lg-6 mb-3">
                <input id="invoiceKey" type="text" class="form-control" placeholder="Enter Keyword" required />
              </div>
              <div class="col-12 col-lg-6 mb-3">
                <button class="btn btn-block text-uppercase btn-pink" onclick="adminInvoiceSearch();">
                  Search
                </button>
              </div>
            </div>
            <div class="row">
            <div class="col-12 col-lg-6 mb-3">
              <input id="from_date" name="from_date" type="text" placeholder="Form Date" class="form-control" />
            </div>
            <div class="col-12 col-lg-6 mb-3">
              <input id="to_date" name="to_date" type="text" placeholder="To Date" class="form-control" />
            </div>
            </div>
            <button class="btn btn-block text-uppercase btn-pink mb-3" onclick="findSellings();">
                  Search By Date
                </button>
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
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="../assets/js/admin/bootstrap.min.js"></script>
    <script src="../assets/jquery-ui-datepicker/jquery-ui.min.js"></script>
  <!-- https://jqueryui.com/download/ -->
    <!-- https://getbootstrap.com/ -->
    <script src="../assets/js/adminScripts.js"></script>

    <script src="../assets/js/script.js"></script>

    <script src="../assets/js/admin/"></script>

    <script>
    $(function () {
      $("#from_date").datepicker();
      $("#to_date").datepicker();
    });
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