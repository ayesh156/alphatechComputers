<!DOCTYPE html>
<html>


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Frequently Asked questions - AlphaTech</title>

    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">

    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/myStyle.css">

</head>

<body class="main-dark">

    <?php include "header.php"; ?>

    <div id="mainSearchResult">

        <!-- ...:::: Start Breadcrumb Section:::... -->
        <div class="breadcrumb-section breadcrumb-bg-color--golden">
            <div class="breadcrumb-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="breadcrumb-title">Frequently Askd Questions</h3>
                            <div class="breadcrumb-nav breadcrumb-nav-color--white breadcrumb-nav-hover-color--golden">
                                <nav aria-label="breadcrumb">
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li class="active" aria-current="page">Frequently Asked Questions</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- ...:::: End Breadcrumb Section:::... -->

        <!-- ...::::Start About Us Center Section:::... -->
        <div class="faq-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="faq-content" data-aos="fade-up" data-aos-delay="0">
                            <h5 class="title">Below are frequently asked questions, you may find the answer for yourself
                            </h5>
                            <p>Find all the answers you need. For some frequently asked questions for alphaTech Computer's customer service.
                                This will save you time and money on making phone calls. If this does not resolve the issue, please <a href="contact-us.php">contact us</a>.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <div class="faq-accordian">
                                <div class="faq-accordian-single-item" data-aos="fade-up" data-aos-delay="0">
                                    <input id="item-1" name="accordian-item" type="radio" checked="">
                                    <label for="item-1">1. Is my personal information safe?</label>
                                    <div class="item-content">
                                        <p>We care about your privacy. You can read our <a href="privacy-policy.php">Privacy Policy</a> for more. The Privacy Policy is part of our Terms of Service.</p>
                                    </div>
                                </div>
                                <div class="faq-accordian-single-item" data-aos="fade-up" data-aos-delay="100">
                                    <input id="item-2" name="accordian-item" type="radio">
                                    <label for="item-2">2. How do I change/reset my password?</label>
                                    <div class="item-content">
                                        <p>To change your password:<br/>
                                            1. Go to My Account Settings <a href="my-account.php">here</a>.<br/>
                                            2. In the “Dashboard” section, enter your new password.<br/>
                                            3. Click Update my profile. </p>
                                    </div>
                                </div>
                                <div class="faq-accordian-single-item" data-aos="fade-up" data-aos-delay="100">
                                    <input id="item-3" name="accordian-item" type="radio">
                                    <label for="item-3">3. How do I close my account?</label>
                                    <div class="item-content">
                                        <p>We hate to see you go, but if you insist, you can <a href="contact-us.php">contact us</a>.</p>
                                    </div>
                                </div>
                                <div class="faq-accordian-single-item" data-aos="fade-up" data-aos-delay="100">
                                    <input id="item-4" name="accordian-item" type="radio">
                                    <label for="item-4">4. How do I change my address?</label>
                                    <div class="item-content">
                                        <p>To change your Address:<br/>
                                            1. Go to My Account Settings <a href="my-account.php">here</a>.<br/>
                                            2. In the “Address” section, enter your new address.<br/>
                                            3. Click Update address.</p>
                                    </div>
                                </div>
                                <div class="faq-accordian-single-item" data-aos="fade-up" data-aos-delay="100">
                                    <input id="item-5" name="accordian-item" type="radio">
                                    <label for="item-5">5. How can I see the details of my previous order?</label>
                                    <div class="item-content">
                                        <p>1. Go to My Account Settings <a href="my-account.php">here</a>.<br/>
                                           2. In the “Orders” section, you can see the details of your previous order.<br/></p>
                                    </div>
                                </div>
                                <div class="faq-accordian-single-item" data-aos="fade-up" data-aos-delay="100">
                                    <input id="item-6" name="accordian-item" type="radio">
                                    <label for="item-6">6. How do I log out of my account?</label>
                                    <div class="item-content">
                                        <p>1. Go to My Account Settings <a href="my-account.php">here</a>.<br/>
                                           2. Click the logout button.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- ...::::End  About Us Center Section:::... -->

    </div>

    <?php include "footer.php"; ?>

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
                        <a class="btn btn-pink-default-hover btn-width" id="alertBtn">OK</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Alert -->

    <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>

</body>


</html>