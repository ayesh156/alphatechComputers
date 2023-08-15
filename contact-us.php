<!DOCTYPE html>
<html>


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Contact Us - AlphaTech</title>

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
                            <h3 class="breadcrumb-title">Contact Us</h3>
                            <div class="breadcrumb-nav breadcrumb-nav-color--white breadcrumb-nav-hover-color--golden">
                                <nav aria-label="breadcrumb">
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li class="active" aria-current="page">Contact Us</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- ...:::: End Breadcrumb Section:::... -->

        <!-- ...::::Start Map Section:::... -->
        <div class="map-section" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15244.449302548304!2d79.85381569999997!3d6.930128900000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259097a27717b%3A0xe8f74aefc50b71d7!2sColombo%2010%2C%20Colombo!5e1!3m2!1sen!2slk!4v1676228641740!5m2!1sen!2slk"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- ...::::End  Map Section:::... -->

        <!-- ...::::Start Contact Section:::... -->
        <div class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <!-- Start Contact Details -->
                        <div class="contact-details-wrapper section-top-gap-100 bg-dark" data-aos="fade-up" data-aos-delay="0">
                            <div class="contact-details">
                                <!-- Start Contact Details Single Item -->
                                <div class="contact-details-single-item">
                                    <div class="contact-details-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="contact-details-content contact-phone">
                                        <a href="#">0112 445557</a>
                                    </div>
                                </div> <!-- End Contact Details Single Item -->
                                <!-- Start Contact Details Single Item -->
                                <div class="contact-details-single-item">
                                    <div class="contact-details-icon">
                                        <i class="fa fa-globe"></i>
                                    </div>
                                    <div class="contact-details-content contact-phone">
                                        <a href="#">alphaTech@gmail.com</a>
                                    </div>
                                </div> <!-- End Contact Details Single Item -->
                                <!-- Start Contact Details Single Item -->
                                <div class="contact-details-single-item">
                                    <div class="contact-details-icon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="contact-details-content contact-phone">
                                        <span>Maradana, Colombo 10.</span>
                                    </div>
                                </div> <!-- End Contact Details Single Item -->
                            </div>
                            <!-- Start Contact Social Link -->
                            <div class="contact-social">
                                <h4>Follow Us</h4>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                                    <li><a href="#"><i class="fa fa-telegram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div> <!-- End Contact Social Link -->
                        </div> <!-- End Contact Details -->
                    </div>
                    <div class="col-lg-8">
                        <div class="contact-form section-top-gap-100 bg-dark" data-aos="fade-up" data-aos-delay="200">
                            <h3>Get In Touch</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="default-form-box mb-20">
                                        <label for="name">Name</label>
                                        <input name="name" type="text" id="name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="default-form-box mb-20">
                                        <label for="email4">Email</label>
                                        <input name="email" type="email" id="email4">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="default-form-box mb-20">
                                        <label for="subject">Subject</label>
                                        <input name="subject" type="text" id="subject">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="default-form-box mb-20">
                                        <label for="message">Your Message</label>
                                        <textarea name="message" id="message" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-lg btn-pink-default-hover" onclick="updateAdminProfile();">SEND</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ...::::ENd Contact Section:::... -->

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