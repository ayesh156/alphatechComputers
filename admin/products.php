<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Products - AlphaTech</title>

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
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-products">
            <div class="tm-product-table-container">
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">PRODUCT NAME</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">CONDITION</th>
                    <th scope="col"><pre>           </pre></th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
                <tbody id="adminProductResult">
                  <?php

                  $product_rs = Database::search("SELECT * FROM `product`");
                  $product_num = $product_rs->num_rows;

                  for ($x = 0; $x < $product_num; $x++) {

                    $product_data = $product_rs->fetch_assoc();

                  ?>
                    <tr>
                      <td><?php echo ($x + 1); ?></td>
                      <td class="tm-product-name c-pointer" onclick="window.location = 'updateProduct.php?id=<?php echo $product_data['id']; ?>';"><?php echo $product_data["title"]; ?></td>
                      <td>Rs.<?php echo $product_data["price"]; ?>.00</td>
                      <td><?php echo $product_data["qty"]; ?></td>
                      <?php

                      if ($product_data["condition_id"] == 1) {

                      ?>
                        <td>Brand new</td>
                      <?php
                      } else {

                      ?>
                        <td>Used</td>
                      <?php
                      }
                      ?>
                      <td>
                        <?php

                        if ($product_data["status_id"] == 1) {
                        ?>
                          <button class="btn-red" id="pb<?php echo $product_data["id"]; ?>" onclick="blockProduct('<?php echo $product_data['id']; ?>');">Deactive</button>
                        <?php
                        } else {
                        ?>
                          <button class="btn-blue" id="pb<?php echo $product_data["id"]; ?>" onclick="blockProduct('<?php echo $product_data['id']; ?>');">Active</button>
                        <?php
                        }
                        ?>
                      </td>
                      <td>
                        <a class="tm-product-delete-link" onclick="deleteProduct(<?php echo $product_data['id']; ?>);">
                          <i class="far fa-trash-alt tm-product-delete-icon"></i>
                        </a>
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
                <input id="productKey" type="text" class="form-control" placeholder="Enter Keyword" required />
              </div>
              <div class="col-12 col-lg-6 mb-3">
                <button class="btn btn-block text-uppercase btn-pink" onclick="adminProductSearch();">
                  Search
                </button>
              </div>

            </div>
            <a href="addProduct.php" class="btn btn-yellow btn-block text-uppercase mb-3">Add new product</a>
          </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
            <h2 class="tm-block-title">Product Categories</h2>
            <div class="tm-category-table-container">
              <table class="table tm-table-small tm-product-table">
                <tbody id="categoryResult">

                  <?php

                  $category_rs = Database::search("SELECT * FROM `category`");
                  $category_num = $category_rs->num_rows;

                  for ($x = 0; $x < $category_num; $x++) {

                    $category_data = $category_rs->fetch_assoc();

                  ?>
                    <tr>
                      <td class="tm-category-name c-pointer" style="height:65px" onclick="adminCategorySearch(<?php echo $category_data['id']; ?>)"><?php echo $category_data["name"]; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- table container -->
            <button class="btn btn-yellow btn-block text-uppercase mb-3" onclick="addCategoryModal()">
              Add new category
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Start Add Category -->
    <div class="modal fade modal-bg" id="addCategoryModel" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
        <div class="modal-content modal-cbg">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col text-right">
                  <button type="button" class="close modal-close" style="opacity: 1;"  onclick="cm.hide();">
                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                  </button>
                </div>
              </div>
              <div class="row">
                <h1 class="header">Add Category</h1>
                <div class="default-form-box">
                  <label>Category name <span>*</span></label>
                  <input type="text" id="cname">
                </div>
                <div class="container-fluid text-center mb-3">
                  <a class="btn text-white btn-pink-default-hover btn-width" onclick="addCategory();">Add Category</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- End Add Category -->

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