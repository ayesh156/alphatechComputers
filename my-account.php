<!DOCTYPE html>
<html>


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>My Account - AlphaTech</title>

    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">

    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/myStyle.css">

</head>

<body class="main-dark">

    <?php include "header.php"; ?>

    <?php

    if (isset($_SESSION["u"])) {

        $email = $_SESSION["u"]["email"];

        $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON gender.id = user.gender_id WHERE `email`='" . $email . "'");

        $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");

        $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_id=city.id INNER JOIN `district` ON city.district_id=district.id INNER JOIN `province` ON district.province_id=province.id WHERE `user_email`='" . $email . "' ");

        $data = $details_rs->fetch_assoc();
        $image_data = $image_rs->fetch_assoc();
        $address_data = $address_rs->fetch_assoc();

    ?>

        <div id="mainSearchResult">

            <!-- ...:::: Start Breadcrumb Section:::... -->
            <div class="breadcrumb-section breadcrumb-bg-color--golden">
                <div class="breadcrumb-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="breadcrumb-title">My Account</h3>
                                <div class="breadcrumb-nav breadcrumb-nav-color--white breadcrumb-nav-hover-color--golden">
                                    <nav aria-label="breadcrumb">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <li class="active" aria-current="page">My Account</li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- ...:::: End Breadcrumb Section:::... -->

            <!-- ...:::: Start Account Dashboard Section:::... -->
            <div class="account-dashboard">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <!-- Nav tabs -->
                            <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                                <ul role="tablist" class="nav flex-column dashboard-list">
                                    <li><a href="#dashboard" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-pink-gold-hover active">Dashboard</a>
                                    </li>
                                    <li> <a href="#orders" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-pink-gold-hover">Orders</a></li>
                                    <li><a href="#address" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-pink-gold-hover">Address</a></li>
                                    <li><a class="nav-link btn btn-block btn-md btn-pink-gold-hover" onclick="signout();">logout</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-9">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                                <div class="tab-pane fade show active" id="dashboard">
                                    <h4>My Proile</h4>
                                    <div class="login">
                                        <div class="login_form_container">
                                            <div class="account_login_form">
                                                <div class="account_img_container">
                                                    <div class="login-image p-3 py-4">

                                                        <?php

                                                        if (empty($image_data["code"])) {

                                                        ?>

                                                            <img src="assets/images/empty/new_user.svg" class="rounded-circle" style="width: 150px;" id="viewImg" />

                                                        <?php

                                                        } else {

                                                        ?>

                                                            <img src="<?php echo ($image_data["code"]); ?>" class="mt-5 rounded-circle" style="width: 150px;" id="viewImg" />

                                                        <?php
                                                        }


                                                        ?>

                                                        <input type="file" class="d-none" id="profileimg" accept="image/*" />
                                                        <label for="profileimg" class="btn btn-md btn-pink-gold-hover mt-5" onclick="changeImage()">Update Profile Image</label>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="default-form-box col-12 col-md-6 mb-20">
                                                        <label>First Name</label>
                                                        <input type="text" name="first-name" value="<?php echo ($data["fname"]); ?>" id="fname2" />
                                                    </div>
                                                    <div class="default-form-box col mb-20">
                                                        <label>Last Name</label>
                                                        <input type="text" name="last-name" value="<?php echo ($data["lname"]); ?>" id="lname2" />
                                                    </div>
                                                </div>
                                                <div class="default-form-box mb-20">
                                                    <label>Email</label>
                                                    <input type="text" name="email" readonly value="<?php echo ($data["email"]); ?>" />
                                                </div>
                                                <div class="default-form-box">
                                                    <label>Passwords <span>*</span></label>
                                                    <div class="input-group mb-3 login-input-flex">
                                                        <div class="input">
                                                            <input type="password" name="password" id="ppi" value="<?php echo ($data["password"]); ?>" />
                                                        </div>
                                                        <span class="input-group-text input-button" onclick="showPassword5();"><i class="fa fa-eye-slash" id="e5"></i></span>
                                                    </div>
                                                </div>
                                                <div class="default-form-box mb-20">
                                                    <label>Registered Date</label>
                                                    <input type="text" name="Registered_date" readonly value="<?php echo ($data["joined_date"]); ?>" />
                                                </div>
                                                <div class="row">
                                                    <div class="default-form-box col-12 col-md-6 mb-20">
                                                        <label>Mobile <span>*</span></label>
                                                        <input type="text" name="mobile" id="mobile2" value="<?php echo ($data["mobile"]); ?>" />
                                                    </div>
                                                    <?php

                                                    $gender_rs = Database::search("SELECT * FROM `gender`");

                                                    ?>
                                                    <div class="default-form-box col-12 col-md-6 mb-20">
                                                        <label>Gender <span>*</span></label>
                                                        <select class="form-select" id="gender2">
                                                            <?php
                                                            $gender_num =  $gender_rs->num_rows;
                                                            for ($x = 0; $x <  $gender_num; $x++) {
                                                                $gender_data =  $gender_rs->fetch_assoc();
                                                            ?>

                                                                <option value="<?php echo  $gender_data["id"]; ?>" <?php if (!empty($data["id"])) {
                                                                                                                        if ($gender_data["id"] == $data["id"]) {
                                                                                                                    ?>selected<?php
                                                                                                                            }
                                                                                                                        } ?>><?php echo  $gender_data["gender_name"]; ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="save_button mt-3">
                                                    <button class="btn btn-md btn-pink-default2-hover" onclick="updateProfile();">Update my Profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders">
                                    <h4>Orders</h4>
                                    <div class="table_page table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Product</th>
                                                    <th>Date</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $pageno = 0;

                                                if (isset($_GET["page"])) {
                                                    $pageno = $_GET["page"];
                                                } else {
                                                    $pageno = 1;
                                                }

                                                $query = "SELECT `invoice`.`invoice_id`, `product`.`title`, `product`.`id` AS ipid, `invoice`.`status`, `invoice`.`total`, `invoice`.`date`  FROM `invoice` INNER JOIN `product` ON invoice.product_id = product.id WHERE `user_email`= '" . $email . "' ORDER BY `invoice`.`date` DESC";

                                                $order_rs = Database::search($query);
                                                $order_num = $order_rs->num_rows;

                                                $results_per_page = 9;
                                                $number_of_pages = ceil($order_num / $results_per_page);

                                                $page_results = ($pageno - 1) * $results_per_page;
                                                $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                                $selected_num = $selected_rs->num_rows;

                                                for ($x = 0; $x < $selected_num; $x++) {

                                                    $selected_data = $selected_rs->fetch_assoc();

                                                    $selectedDate = $selected_data["date"];
                                                    $oDateTime = explode(' ', $selectedDate);
                                                    $oDate = $oDateTime[0];

                                                    $status = $selected_data["status"];

                                                ?>
                                                    <tr>
                                                        <td><?php echo $selected_data["invoice_id"]; ?></td>
                                                        <td><?php echo $selected_data["title"]; ?></td>
                                                        <td><?php echo $oDate; ?></td>
                                                        <td>Rs.<?php echo $selected_data["total"]; ?>.00</td>

                                                        <?php
                                                        if ($status == 0) {
                                                        ?>
                                                            <td><span class="status">Confirm Order</span></td>
                                                        <?php
                                                        } else if ($status == 1) {
                                                        ?>
                                                            <td><span class="status">Packing</span></td>
                                                        <?php
                                                        } else if ($status == 2) {
                                                        ?>
                                                            <td><span class="status">Dispatch</span></td>
                                                        <?php
                                                        } else if ($status == 3) {
                                                        ?>
                                                            <td><span class="status">Shipping</span></td>
                                                            <?php
                                                        } else if ($status == 4) {

                                                            $review_rs = Database::search("SELECT * FROM `review` WHERE `user_email`= '" . $email . "' AND `product_id` = '" . $selected_data["ipid"] . "'");
                                                            $review_num = $review_rs->num_rows;

                                                            if ($review_num == 0) {
                                                            ?>

                                                                <td><a class="reviewBtn" id="reviewText<?php echo $selected_data['ipid'] ?>" onclick="addReview(<?php echo $selected_data['ipid'] ?>);">Review</a></td>

                                                            <?php
                                                            } else {

                                                            ?>
                                                                <td><a class="text-white">Reviewed</a></td>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </tr>

                                                <?php
                                                }
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                    <!-- Start Pagination -->
                                    <div class="page-pagination text-center">
                                        <ul>
                                            <li>
                                                <a <?php if ($pageno <= 1) {
                                                        echo "#";
                                                    } else {
                                                    ?> onclick="myOrderResult('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                                                    <i class="ion-ios-skipbackward"></i>
                                                </a>
                                            </li>
                                            <?php

                                            for ($x = 1; $x <= $number_of_pages; $x++) {
                                                if ($x == $pageno) {
                                            ?>

                                                    <li>
                                                        <a class="active" onclick="myOrderResult('<?php echo ($x); ?>');"><?php echo $x; ?></a>
                                                    </li>

                                                <?php
                                                } else {
                                                ?>

                                                    <li>
                                                        <a onclick="myOrderResult('<?php echo ($x); ?>');"><?php echo $x; ?></a>
                                                    </li>

                                            <?php
                                                }
                                            }

                                            ?>

                                            <li>
                                                <a <?php if ($pageno >= $number_of_pages) {
                                                        echo "#";
                                                    } else {
                                                    ?> onclick="myOrderResult('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                                                    <i class="ion-ios-skipforward"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div> <!-- End Pagination -->

                                </div>

                                <div class="tab-pane" id="address">
                                    <h4>Edit Address</h4>
                                    <div class="login">
                                        <div class="login_form_container">
                                            <div class="account_login_form">
                                                <?php

                                                if (!empty($address_data["line1"])) {

                                                ?>
                                                    <div class="default-form-box mb-20">
                                                        <label>Address Line 1</label>
                                                        <input type="text" name="line1" value="<?php echo ($address_data["line1"]); ?>" id="line1" />
                                                    </div>
                                                <?php

                                                } else {

                                                ?>

                                                    <div class="default-form-box mb-20">
                                                        <label>Address Line 1</label>
                                                        <input type="text" name="line1" id="line1" />
                                                    </div>

                                                <?php

                                                }

                                                if (!empty($address_data["line2"])) {

                                                ?>
                                                    <div class="default-form-box mb-20">
                                                        <label>Address Line 2</label>
                                                        <input type="text" name="line2" value="<?php echo ($address_data["line2"]); ?>" id="line2" />
                                                    </div>
                                                <?php

                                                } else {

                                                ?>

                                                    <div class="default-form-box mb-20">
                                                        <label>Address Line 2</label>
                                                        <input type="text" name="line2" id="line2" />
                                                    </div>

                                                <?php

                                                }

                                                $province_rs = Database::search("SELECT * FROM `province`");
                                                $district_rs = Database::search("SELECT * FROM `district`");
                                                $city_rs = Database::search("SELECT * FROM `city`");

                                                ?>
                                                <div class="row">
                                                    <div class="default-form-box col-12 col-md-6 mb-20">
                                                        <label>Province <span>*</span></label>
                                                        <select class="form-select" id="province">
                                                            <?php
                                                            $province_num = $province_rs->num_rows;
                                                            for ($y = 0; $y <  $province_num; $y++) {
                                                                $province_data =  $province_rs->fetch_assoc();
                                                            ?>

                                                                <option value="<?php echo $province_data["id"]; ?>" <?php if (!empty($address_data["province_id"])) {
                                                                                                                        if ($province_data["id"] == $address_data["province_id"]) {
                                                                                                                    ?>selected<?php
                                                                                                                            }
                                                                                                                        } ?>><?php echo  $province_data["province_name"]; ?></option>

                                                            <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>

                                                    <div class="default-form-box col-12 col-md-6 mb-20">
                                                        <label>District <span>*</span></label>
                                                        <select class="form-select" id="district">
                                                            <?php
                                                            $district_num =  $district_rs->num_rows;
                                                            for ($x = 0; $x <  $district_num; $x++) {
                                                                $district_data =  $district_rs->fetch_assoc();
                                                            ?>

                                                                <option value="<?php echo  $district_data["id"]; ?>" <?php if (!empty($address_data["district_id"])) {
                                                                                                                            if ($district_data["id"] == $address_data["district_id"]) {
                                                                                                                        ?>selected<?php
                                                                                                                                }
                                                                                                                            } ?>><?php echo $district_data["district_name"]; ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="default-form-box col-12 col-md-6 mb-20">
                                                        <label>City <span>*</span></label>
                                                        <select class="form-select" id="city">
                                                            <?php
                                                            $city_num =  $city_rs->num_rows;
                                                            for ($z = 0; $z <  $city_num; $z++) {
                                                                $city_data =  $city_rs->fetch_assoc();
                                                            ?>

                                                                <option value="<?php echo  $city_data["id"]; ?>" <?php if (!empty($address_data["city_id"])) {
                                                                                                                        if ($city_data["id"] == $address_data["city_id"]) {
                                                                                                                    ?>selected<?php
                                                                                                                            }
                                                                                                                        } ?>><?php echo $city_data["city_name"]; ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <?php

                                                    if (!empty($address_data["postal_code"])) {

                                                    ?>
                                                        <div class="default-form-box col-12 col-md-6 mb-20">
                                                            <label>Postal Code</label>
                                                            <input type="text" name="postal-code" value="<?php echo ($address_data["postal_code"]); ?>" id="pcode" />
                                                        </div>

                                                    <?php
                                                    } else {
                                                    ?>

                                                        <div class="default-form-box col-12 col-md-6 mb-20">
                                                            <label>Postal Code</label>
                                                            <input type="text" name="postal-code" id="pcode" />
                                                        </div>

                                                    <?php
                                                    }
                                                    ?>

                                                </div>

                                                <div class="save_button mt-3">
                                                    <button class="btn btn-md btn-pink-default2-hover" onclick="updateAddress();">Update Address</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- ...:::: End Account Dashboard Section:::... -->

        </div>

        <div id="quickModelView"></div>

        <div id="addModalcart"></div>

        <div id="addModalwishlist"></div>

        <!-- Start Review Model -->
        <div class="modal fade" id="reviewModel" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col text-right">
                                    <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                    </button>
                                </div>
                            </div>
                            <h1 class="header">Add a review</h1>
                            <div class="review-form">
                                <div class="col-12">
                                    <div class="default-form-box">
                                        <label for="review-text">Your review
                                            <span>*</span></label>
                                        <textarea id="review-text" placeholder="Write a review" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid text-center">
                                <a class="btn btn-pink-default2-hover btn-width" onclick="saveReview();">Submit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Review Model -->

        <!-- Start Modal Alert -->
        <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col text-right">
                                    <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <h1 class="text-warning" id="alertText"></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="container-fluid text-center">
                            <a class="btn btn-pink-default2-hover btn-width" id="alertBtn">OK</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Modal Alert -->

    <?php

    } else {
    ?>
        <span class="login-error">Please Login First</span>
    <?php
    }

    ?>

    <?php include "footer.php"; ?>

    <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>