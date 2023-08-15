<!DOCTYPE html>
<html>


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Admin Login - AlphaTech</title>

    <link rel="shortcut icon" href="../assets/images/logo/logo.png" type="image/png">

    <link rel="stylesheet" href="../assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="../assets/css/plugins/plugins.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/myStyle.css">

</head>

<body class="admin-body">

    <div class="container-fluid vh-100 admin-container">

        <div class="admin-image">
            <div class="logoimage2"></div>
        </div>

        <div class="row">
            <div class="d2 col-10 col-lg-6">
                <div class="row">
                    <h1 class="txt2 mt-2 mb-4 text-center">Admin Sign In</h1>

                    <div class="col-12">
                        <input type="email" class="form-control input txt3" id="aemail" placeholder="Email">
                    </div>

                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-pink2" onclick="adminVerification();">Send Verification Code</button>
                            </div>
                            <div class="col-12 mt-2 mt-lg-0 col-lg-6 d-grid">
                                <button class="btn btn-success" onclick="window.location='../login.php'">Back To User's Log In</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Footer Bottom -->
        <div class="admin-footer col-12">
            <div class="container">
                <div class="footer-copyright text-center">
                    <p class="footer-text">Copyright &copy; 2022 All Rights Reserved by <a href="index.php" class="text-pink2" target="_blank">AlphaTech Computers</a> </p>
                </div>
            </div>
        </div>
        <!-- Start Footer Bottom -->

    </div>

    <!-- Start Admin Verification modal -->
    <div class="modal fade modal-bg" id="adminVerificationModel" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <h1 class="header">Admin Verification</h1>
                        <div class="default-form-box">
                            <label>Varification Code <span>*</span></label>
                            <input type="text" id="vcode">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid text-center mb-3">
                        <a class="btn btn-pink-default2-hover btn-width" onclick="verify();">Verfify</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Admin Verification modal -->

    <!-- Start Modal Alert -->
    <div class="modal fade modal-bg" id="alertModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <a class="btn btn-pink-default-hover btn-width" id="alertBtn">OK</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Alert -->

    <script src="../assets/js/vendor/vendor.min.js"></script>
    <script src="../assets/js/plugins/plugins.min.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/script.js"></script>

</body>

</html>