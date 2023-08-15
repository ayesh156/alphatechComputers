<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Add product - AlphaTech</title>

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

<body>

  <?php

  include "header.php";

  if (isset($_SESSION["a"])) {

  ?>

    <div class="container col-xl-10 offset-xl-1 tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h2 class="tm-block-title d-inline-block">Add Product</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="tm-edit-product-form">
                  <div class="form-group mb-3">
                    <label for="title">Product Name
                    </label>
                    <input id="title" name="title" type="text" class="form-control validate" required />
                  </div>
                  <div class="row">
                    <div class="form-group mb-3 col-12 col-md-6">
                      <label for="category">Category</label>
                      <select class="custom-select tm-select-accounts" id="category">
                        <option selected>Select category</option>
                        <?php

                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;

                        for ($x = 0; $x < $category_num; $x++) {
                          $category_data = $category_rs->fetch_assoc();
                        ?>
                          <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                        <?php
                        }

                        ?>
                      </select>
                    </div>
                    <div class="form-group mb-3 col-12 col-md-6">
                      <label for="brand">Brand</label>
                      <select class="custom-select tm-select-accounts" id="brand" onchange="load_model();">
                        <option selected>Select brand</option>
                        <?php

                        $brand_rs = Database::search("SELECT * FROM `brand`");
                        $brand_num = $brand_rs->num_rows;

                        for ($x = 0; $x < $brand_num; $x++) {
                          $brand_data = $brand_rs->fetch_assoc();
                        ?>
                          <option value="<?php echo $brand_data["id"];  ?>"><?php echo $brand_data["name"];  ?></option>
                        <?php
                        }

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group mb-3 col-12 col-md-6">
                      <label for="model">Model</label>
                      <select class="custom-select tm-select-accounts" id="model">
                        <option selected>Select model</option>
                        <?php

                        $model_rs = Database::search("SELECT * FROM `model`");
                        $model_num = $model_rs->num_rows;

                        for ($x = 0; $x < $model_num; $x++) {
                          $model_data = $model_rs->fetch_assoc();
                        ?>
                          <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group mb-3 col-12 col-md-6">
                      <label for="clr">Colour</label>
                      <select class="custom-select tm-select-accounts" id="clr">
                        <option selected>Select colour</option>
                        <?php

                        $clr_rs = Database::search("SELECT * FROM `colour`");
                        $clr_num = $clr_rs->num_rows;

                        for ($a = 0; $a < $clr_num; $a++) {
                          $clr_data = $clr_rs->fetch_assoc();
                        ?>

                          <option value="<?php echo $clr_data["id"]; ?>"><?php echo $clr_data["name"]; ?></option>

                        <?php
                        }

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-md-6 mb-3 mb-3 form-group">
                      <div class="row">
                        <label class="col-12">Condition</label>
                        <div class="col-12">
                          <div class="form-check mr-2">
                            <input class="form-check-input" type="radio" name="c" id="b" checked>
                            <label class="form-check-label text-white" for="b">
                              Brandnew
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="c" id="u">
                            <label class="form-check-label text-white" for="u">
                              Used
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-12 col-md-6 mb-3 mb-3">
                      <label for="qty">Quantity
                      </label>
                      <input id="qty" name="qty" type="number" class="form-control" value="0" min="0" />
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <label for="price">Price(Rs.)
                    </label>
                    <input id="price" name="price" type="text" class="form-control" required />
                  </div>
                  <div class="row">
                    <div class="form-group mb-3 col-xs-12 col-sm-6">
                      <label for="dwc">Delivery Cost Within Colombo(Rs.)
                      </label>
                      <input id="dwc" name="dwc" type="text" class="form-control" required />
                    </div>
                    <div class="form-group mb-3 col-xs-12 col-sm-6">
                      <label for="doc">Delivery Cost out of Colombo(Rs.)
                      </label>
                      <input id="doc" name="doc" type="text" class="form-control" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                <div class="form-group mb-3">
                  <label for="desc">Description</label>
                  <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                </div>
                <div class="row">
                  <div class="tm-product-img-dummy mx-auto col-10 col-sm-4 mt-3">
                    <img src="../assets/images/empty/empty-product.png" class="img-fluid" style="width: 100%" id="pi0" />
                  </div>
                  <div class="tm-product-img-dummy mx-auto col-10 col-sm-4 mt-3">
                    <img src="../assets/images/empty/empty-product.png" class=" img-fluid" style="width: 100%;" id="pi1" />
                  </div>
                </div>
                <div class="row">
                  <div class="tm-product-img-dummy mx-auto col-10 col-sm-4 mt-3">
                    <img src="../assets/images/empty/empty-product.png" class="img-fluid" style="width: 100%" id="pi2" />
                  </div>
                  <div class="tm-product-img-dummy mx-auto col-10 col-sm-4 mt-3">
                    <img src="../assets/images/empty/empty-product.png" class=" img-fluid" style="width: 100%;" id="pi3" />
                  </div>
                </div>
                <div class="custom-file mt-3 mb-3">
                  <input id="pImageuploader" type="file" style="display:none;" multiple />
                  <label class="btn btn-yellow btn-block mx-auto" for="pImageuploader" onclick="addProductImage();">UPLOAD PRODUCT IMAGE</label>
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-yellow btn-block text-uppercase" onclick="addProduct();">Add Product Now</button>
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
                                <a class="btn text-white btn-pink-default-hover btn-width" id="alertBtn">OK</a>
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