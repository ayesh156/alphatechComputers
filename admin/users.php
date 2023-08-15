<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Users - AlphaTech</title>

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

  <?php

  include "header.php";

  if (isset($_SESSION["a"])) {

  ?>

    <div class="container col-xl-10 offset-xl-1 mt-5">
      <div class="row tm-content-row">
        <div class="col-12 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-products">
            <div class="tm-product-table-container">
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">USER NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">MOBILE</th>
                    <th scope="col">REGISTERED DATE</th>
                    <th scope="col"><pre>           </pre></th>
                  </tr>
                </thead>
                <tbody id="adminUserResult">

                  <?php

                  $user_rs = Database::search("SELECT * FROM `user`");
                  $user_num = $user_rs->num_rows;

                  for ($x = 0; $x < $user_num; $x++) {

                    $user_data = $user_rs->fetch_assoc();

                  ?>
                    <tr>
                      <td><?php echo ($x + 1); ?></td>
                      <td class="tm-user-name"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></td>
                      <td><?php echo $user_data["email"]; ?></td>
                      <td><?php echo $user_data["mobile"]; ?></td>
                      <?php
                      $phpDateObject = strtotime($user_data["joined_date"]);
                      $strDate = date('Y-m-d', $phpDateObject);
                      ?>
                      <td><?php echo $strDate; ?></td>
                      <td>
                        <?php

                        if ($user_data["status"] == 1) {
                        ?>
                          <button class="btn-red" id="ub<?php echo $user_data["email"]; ?>" onclick="blockUser('<?php echo $user_data['email']; ?>');">Block</button>
                        <?php
                        } else {
                        ?>
                          <button class="btn-blue" id="ub<?php echo $user_data["email"]; ?>" onclick="blockUser('<?php echo $user_data['email']; ?>');">Unblock</button>
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
                <input id="userKey" type="text" class="form-control" placeholder="Enter Keyword" required />
              </div>
              <div class="col-12 col-lg-6 mb-3">
                <button class="btn btn-block text-uppercase btn-pink" onclick="adminUserSearch();">
                  Search
                </button>
              </div>
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
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="../assets/js/admin/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="../assets/js/adminScripts.js"></script>

    <script src="../assets/js/script.js"></script>

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