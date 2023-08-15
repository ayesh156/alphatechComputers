<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Update product - AlphaTech</title>

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

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
    $product_data = $product_rs->fetch_assoc();

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
                    <label for="title2">Product name
                    </label>
                    <input id="title2" name="title" type="text" value="<?php echo $product_data["title"]; ?>" class="form-control validate" required />
                  </div>
                  <div class="row">
                    <?php

                    $category_rs = Database::search("SELECT * FROM `category` WHERE `id` = '" . $product_data["category_id"] . "'");
                    $category_data = $category_rs->fetch_assoc();

                    ?>
                    <div class="form-group col-12 col-md-6 mb-3 mb-3">
                      <label for="category">Category
                      </label>
                      <input id="category" name="category" type="text" class="form-control" value="<?php echo $category_data["name"]; ?>" disabled />
                    </div>
                    <?php

                    $brand_rs = Database::search("SELECT * FROM  `brand_has_model` INNER JOIN `brand` ON brand_has_model.brand_id= brand.id WHERE `brand_has_model`.`id`='" . $product_data["brand_has_model_id"] . "' ");
                    $brand_data = $brand_rs->fetch_assoc();

                    ?>
                    <div class="form-group col-12 col-md-6 mb-3 mb-3">
                      <label for="brand">Brand
                      </label>
                      <input id="brand" name="brand" type="text" class="form-control" value="<?php echo $brand_data["name"]; ?>" disabled />
                    </div>
                  </div>
                  <div class="row">
                    <?php

                    $model_rs = Database::search("SELECT * FROM  `brand_has_model` INNER JOIN `model` ON brand_has_model.model_id= model.id WHERE `brand_has_model`.`id`='" . $product_data["brand_has_model_id"] . "' ");
                    $model_data = $model_rs->fetch_assoc();

                    ?>
                    <div class="form-group col-12 col-md-6 mb-3 mb-3">
                      <label for="model">Model
                      </label>
                      <input id="model" name="model" type="text" class="form-control" value="<?php echo $model_data["name"]; ?>" disabled />
                    </div>
                    <div class="form-group mb-3 col-12 col-md-6">
                      <label for="clr2">Colour</label>
                      <select class="custom-select tm-select-accounts" id="clr2">
                        <option selected>Select colour</option>
                        <?php

                        $clr_rs = Database::search("SELECT * FROM `colour`");
                        $clr_num = $clr_rs->num_rows;

                        for ($a = 0; $a < $clr_num; $a++) {
                          $clr_data = $clr_rs->fetch_assoc();
                        ?>

                          <option value="<?php echo $clr_data["id"]; ?>" <?php if (!empty($product_data["colour_id"])) {
                                                                            if ($clr_data["id"] == $product_data["colour_id"]) {
                                                                          ?>selected<?php
                                                                                  }
                                                                                } ?>><?php echo $clr_data["name"]; ?></option>

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
                            <input class="form-check-input" type="radio" name="c" id="b" <?php if ($product_data["condition_id"] == '1') { ?> checked <?php } ?> disabled>
                            <label class="form-check-label text-white" for="b">
                              Brandnew
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="c" id="u" <?php if ($product_data["condition_id"] == '2') { ?> checked <?php } ?> disabled>
                            <label class="form-check-label text-white" for="u">
                              Used
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-12 col-md-6 mb-3 mb-3">
                      <label for="qty2">Quantity
                      </label>
                      <input id="qty2" name="qty" type="number" class="form-control" value="<?php echo $product_data["qty"]; ?>" min="0" />
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <label for="price2">Price(Rs.)
                    </label>
                    <input id="price2" name="price" type="text" value="<?php echo $product_data["price"]; ?>" class="form-control" required />
                  </div>
                  <div class="row">
                    <div class="form-group mb-3 col-xs-12 col-sm-6">
                      <label for="dwc2">Delivery Cost Within Colombo(Rs.)
                      </label>
                      <input id="dwc2" name="dwc" type="text" class="form-control" value="<?php echo $product_data["delivery_fee_colombo"]; ?>" required />
                    </div>
                    <div class="form-group mb-3 col-xs-12 col-sm-6">
                      <label for="doc2">Delivery Cost out of Colombo(Rs.)
                      </label>
                      <input id="doc2" name="doc" type="text" class="form-control" value="<?php echo $product_data["delivery_fee_other"]; ?>" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                <div class="form-group mb-3">
                  <label for="desc2">Description</label>
                  <textarea class="form-control" id="desc2" name="desc" rows="3" required><?php echo $product_data["description"]; ?></textarea>
                </div>
                <?php

                $img = array();
                $img[0] = "assets/images/empty/empty-product.png";
                $img[1] = "assets/images/empty/empty-product.png";
                $img[2] = "assets/images/empty/empty-product.png";
                $img[3] = "assets/images/empty/empty-product.png";

                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "' ");
                $image_num = $image_rs->num_rows;

                for ($x = 0; $x < $image_num; $x++) {
                  $image_data = $image_rs->fetch_assoc();
                  $img[$x] = $image_data["code"];
                }

                ?>
                <div class="row">
                  <div class="tm-product-img-dummy mx-auto col-10 col-sm-4 mt-3">
                    <img src="../<?php echo $img[0]; ?>" class="img-fluid" style="width: 100%" id="pi0" />
                  </div>
                  <div class="tm-product-img-dummy mx-auto col-10 col-sm-4 mt-3">
                    <img src="../<?php echo $img[1]; ?>" class=" img-fluid" style="width: 100%;" id="pi1" />
                  </div>
                </div>
                <div class="row">
                  <div class="tm-product-img-dummy mx-auto col-10 col-sm-4 mt-3">
                    <img src="../<?php echo $img[2]; ?>" class="img-fluid" style="width: 100%" id="pi2" />
                  </div>
                  <div class="tm-product-img-dummy mx-auto col-10 col-sm-4 mt-3">
                    <img src="../<?php echo $img[3]; ?>" class=" img-fluid" style="width: 100%;" id="pi3" />
                  </div>
                </div>
                <div class="custom-file mt-3 mb-3">
                  <input id="pImageuploader" type="file" style="display:none;" multiple />
                  <label class="btn btn-yellow btn-block mx-auto" for="pImageuploader" onclick="addProductImage();">UPLOAD PRODUCT IMAGE</label>
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-yellow btn-block text-uppercase" onclick="updateProduct(<?php echo $pid; ?>);">Update Product Now</button>
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