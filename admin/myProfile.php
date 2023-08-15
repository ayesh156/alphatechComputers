<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>My Profile - AlphaTech</title>

  <link rel="shortcut icon" href="../assets/images/logo/logo.png" type="image/png">

  <link rel="stylesheet" href="../assets/css/admin/fontawesome.min.css" />
  <!-- https://fontawesome.com/ -->
  <link rel="stylesheet" href="../assets/css/admin/bootstrap.min.css" />
  <!-- https://getbootstrap.com/ -->

  <link rel="stylesheet" href="../assets/css/adminStyle.css" />
  <link rel="stylesheet" href="../assets/css/myStyle.css" />

  <!-- Main CSS -->
  <link rel="stylesheet" href="../assets/css/style.css" />


</head>

<body id="reportsPage">

  <div class="" id="home">

    <?php

    include "header.php";

    if (isset($_SESSION["a"])) {

      $aemail = $_SESSION["a"]["email"];

      $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`= '" . $aemail . "'");
      $admin_data = $admin_rs->fetch_assoc();

    ?>

      <div class="container col-xl-10 offset-xl-1 mt-5">
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-avatar">
            <div class="tm-bg-primary-dark tm-block tm-block-avatar">
              <h2 class="tm-block-title fz2">Upload Profile Image</h2>
              <div class="tm-avatar-container">

                <input id="profileimg2" type="file" style="display:none;" multiple />

                <?php

                $image_rs = Database::search("SELECT * FROM `admin_image` WHERE `admin_email`='" . $aemail . "' ");
                $image_num = $image_rs->num_rows;

                if ($image_num != 0) {
                  $image_data = $image_rs->fetch_assoc();
                ?>
                  <img src="../<?php echo $image_data["path"]; ?>" id="viewImg2" alt="Avatar" class="tm-avatar img-fluid mb-4" />
                <?php

                } else {
                ?>
                  <img src="../assets/images/empty/new_admin.svg" id="viewImg2" alt="Avatar" class="tm-avatar img-fluid mb-4" />
                <?php
                }

                ?>



              </div>
              <label for="profileimg2" class="btn btn-yellow btn-block fz text-uppercase" onclick="changeAdminImage();">
                Upload New Photo
              </label>
            </div>
          </div>
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Account Settings</h2>
              <div class="tm-signup-form row">
                <div class="form-group col-lg-6">
                  <label for="fname3">First Name</label>
                  <input id="fname3" name="fname" type="text" class="form-control" value="<?php echo $admin_data["fname"]; ?>" />
                </div>
                <div class="form-group col-lg-6">
                  <label for="lname3">Last Name</label>
                  <input id="lname3" name="lname" type="text" class="form-control"  value="<?php echo $admin_data["lname"]; ?>" />
                </div>
                <div class="form-group col-12">
                  <label for="email3">Email</label>
                  <input id="email3" name="email" type="email" class="form-control"  value="<?php echo $admin_data["email"]; ?>" />
                </div>
                <div class="form-group col-lg-6">
                  <label for="mobile3">Mobile</label>
                  <input id="mobile3" name="mobile" type="text" class="form-control"  value="<?php echo $admin_data["mobile"]; ?>" />
                </div>
                <div class="form-group mb-3 col-12 col-md-6">
                  <label for="gender3">Gender</label>
                  <select class="custom-select tm-select-accounts" id="gender3" onchange="load_model();">
                    <?php

                    $agender_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $aemail . "'");
                    $agender_data = $agender_rs->fetch_assoc();

                    $gender_rs = Database::search("SELECT * FROM `gender`");
                    $gender_num = $gender_rs->num_rows;

                    for ($x = 0; $x < $gender_num; $x++) {
                      $gender_data = $gender_rs->fetch_assoc();
                    ?>
                      <option value="<?php echo $gender_data["id"]; ?>" <?php if (!empty($agender_data["gender_id"])) {
                                                                          if ($gender_data["id"] == $agender_data["gender_id"]) {
                                                                        ?>selected<?php
                                                                                }
                                                                              } ?>><?php echo $gender_data["gender_name"];  ?></option>
                    <?php
                    }

                    ?>
                  </select>
                </div>
                <div class="col-12">
                  <button onclick="updateAdminProfile();" class="btn btn-yellow btn-block text-uppercase">
                    Update my Profile
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
                    <a class="btn text-white btn-pink-default-hover btn-width" id="alertBtn" onclick="bm.hide();">OK</a>
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