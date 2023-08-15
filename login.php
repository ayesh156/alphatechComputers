<!DOCTYPE html>
<html>


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Login - AlphaTech</title>

    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">

    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/myStyle.css">

</head>

<body class="main-dark">

    <?php

    include "header.php";

    ?>

    <div id="mainSearchResult">

        <!-- ...:::: Start Breadcrumb Section:::... -->
        <div class="breadcrumb-section breadcrumb-bg-color--golden">
            <div class="breadcrumb-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="breadcrumb-title">Login</h3>
                            <div class="breadcrumb-nav breadcrumb-nav-color--white breadcrumb-nav-hover-color--golden">
                                <nav aria-label="breadcrumb">
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li class="active" aria-current="page">Login</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- ...:::: End Breadcrumb Section:::... -->

        <!-- ...:::: Start Customer Login Section :::... -->
        <div class="customer-login">
            <div class="container">
                <div class="row">
                    <!--login area start-->
                    <div class="col-lg-6 col-md-6">
                        <div class="account_form" data-aos="fade-up" data-aos-delay="0">
                            <h3>login</h3>
                            <div class="form">

                                <?php

                                $email = "";
                                $password = "";

                                if (isset($_COOKIE["email"])) {
                                    $email = $_COOKIE["email"];
                                }

                                if (isset($_COOKIE["password"])) {
                                    $password = $_COOKIE["password"];
                                }

                                ?>

                                <div class="default-form-box">
                                    <label>Email <span>*</span></label>
                                    <input type="text" id="email" value="<?php echo $email; ?>">
                                </div>
                                <div class="default-form-box">
                                    <label>Passwords <span>*</span></label>
                                    <div class="input-group mb-3 login-input-flex">
                                        <div class="input">
                                            <input type="password" id="lpi" value="<?php echo $password; ?>">
                                        </div>
                                        <span class="input-group-text input-button" onclick="showPassword1();"><i class="fa fa-eye-slash" id="e1"></i></span>
                                    </div>
                                </div>
                                <div class="login_submit">
                                    <button class="btn btn-md btn-pink-default2-hover mb-4" onclick="login();">login</button>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label class="checkbox-default mb-4" for="rememberme">
                                                <input type="checkbox" id="rememberme">
                                                <span>Remember me</span>
                                            </label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <a class="lostpword" onclick="forgotPassword();">Lost your password?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--login area start-->

                    <!--register area start-->
                    <div class="col-lg-6 col-md-6">
                        <div class="account_form register" data-aos="fade-up" data-aos-delay="200">
                            <h3>Register</h3>
                            <div class="form">
                                <div class="row">
                                    <div class="default-form-box col-12 col-md-6">
                                        <label>First Name <span>*</span></label>
                                        <input type="text" id="fname">
                                    </div>
                                    <div class="default-form-box col-12 col-md-6">
                                        <label>Last Name <span>*</span></label>
                                        <input type="text" id="lname">
                                    </div>
                                </div>
                                <div class="default-form-box">
                                    <label>Email <span>*</span></label>
                                    <input type="text" id="email2">
                                </div>
                                <div class="default-form-box">
                                    <label>Passwords <span>*</span></label>
                                    <div class="input-group mb-3 login-input-flex">
                                        <div class="input">
                                            <input type="password" id="rpi">
                                        </div>
                                        <span class="input-group-text input-button" onclick="showPassword2();"><i class="fa fa-eye-slash" id="e2"></i></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="default-form-box col-12 col-md-6">
                                        <label>Mobile <span>*</span></label>
                                        <input type="text" id="mobile">
                                    </div>
                                    <div class="default-form-box col-12 col-md-6">
                                        <label>Gender <span>*</span></label>
                                        <select class="form-select" id="gender">
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="login_submit">
                                    <button class="btn btn-md btn-pink-default2-hover" onclick="register();">Register</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--register area end-->
                </div>
            </div>
        </div> <!-- ...:::: End Customer Login Section :::... -->

        <!-- Start Get Password -->
        <div class="modal fade" id="forgotPasswordModel" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <h1 class="header">Reset Password</h1>
                            <div class="row">
                                <div class="default-form-box col-12 col-md-6">
                                    <label>New Passwords <span>*</span></label>
                                    <div class="input-group login-input-flex">
                                        <div class="input">
                                            <input type="password" id="npi">
                                        </div>
                                        <span class="input-group-text input-button" onclick="showPassword3();"><i class="fa fa-eye-slash" id="e3"></i></span>
                                    </div>
                                </div>
                                <div class="default-form-box col-12 col-md-6">
                                    <label>Re-type New Passwords <span>*</span></label>
                                    <div class="input-group login-input-flex">
                                        <div class="input">
                                            <input type="password" id="rnpi">
                                        </div>
                                        <span class="input-group-text input-button" onclick="showPassword4();"><i class="fa fa-eye-slash" id="e4"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="default-form-box">
                                <label>Varification Code <span>*</span></label>
                                <input type="text" id="vc">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="container-fluid text-center">
                            <a class="btn btn-pink-default2-hover btn-width" onclick="resetpw();">Reset</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Modal Alert -->

    </div>

    <div id="quickModelView"></div>

    <div id="addModalcart"></div>

    <div id="addModalwishlist"></div>

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

    include "footer.php";

    ?>

    <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>

</body>


</html>