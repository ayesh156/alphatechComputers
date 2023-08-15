<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="../assets/images/logo/logo.png" type="image/png">

    <link rel="stylesheet" href="../assets/css/admin/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="../assets/css/admin/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="../assets/css/adminStyle.css" />

    <link rel="stylesheet" href="../assets/css/myStyle.css">

</head>

<body>

    <?php

    session_start();

    require "../connection.php";
    ?>

    <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
            <a class="navbar-brand" href="dashboard.php">
                <h1 class="tm-site-title mb-0">Product Admin</h1>
            </a>
            <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars tm-nav-icon"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto h-100">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">

                        <a class="nav-link" href="sellingHistory.php">
                            <i class="far fa-file-alt"></i>
                            Selling History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">
                            <i class="fas fa-shopping-cart"></i>
                            Products
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="users.php">
                            <i class="far fa-user"></i>
                            Users
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                            <span>
                                Settings <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="myProfile.php">My Profile</a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php

                        if (isset($_SESSION["a"])) {


                        ?>
                            <a class="nav-link d-block text-white"> <?php echo $_SESSION["a"]["fname"]; ?>, <b onclick="adminSignout();">Logout</b> </a>
                        <?php

                        } else {
                        ?>
                            <a class="nav-link d-block text-white">Admin, <b onclick="window.location = 'index.php'; ">Login</b> </a>
                        <?php

                        }
                        ?>

                    </li>
                </ul>
            </div>
        </div>

    </nav>

    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="../assets/js/admin/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="../assets/js/adminScripts.js"></script>

    <script src="../assets/js/script.js"></script>

</body>

</html>