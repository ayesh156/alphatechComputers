<?php

session_start();

if (isset($_SESSION["u"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Invoice - AlphaTech</title>

        <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

        <link rel="stylesheet" href="assets/css/invoiceStyle.css" />

    </head>

    <body>

        <?php

        require "connection.php";

        $umail = $_SESSION["u"]["email"];
        $oid = $_GET["oid"];
        $discount = $_GET["disc"];
        $details = $_GET["deta"];

        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `invoice_id`='" . $oid . "'");
        $invoice_data = $invoice_rs->fetch_assoc();

        ?>

        <div class="my-5 page" size="A4">
            <div class="position-absolute ml-1 mt-1">
                <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> print</button>
                <button class="btn btn-danger me-2" onclick="generatePDF();"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
            </div>
            <div class="p-5" id="page">
                <section class="top-content bb d-flex justify-content-between">
                    <div class="logo">
                        <img src="assets/images/invoice/logo.png" class="img-fluid" alt="">
                    </div>
                    <div class="top-left">
                        <div class="graphic-path">
                            <p>Invoice</p>
                        </div>
                        <div class="position-relative">
                            <p>Invoice No. 0<span><?php echo $invoice_data["id"]; ?></span></p>
                        </div>
                    </div>
                </section>

                <section class="store-user mt-2">
                    <div class="col-11">
                        <div class="row bb pb-2">
                            <div class="col-7">
                                <h2>AlphaTech <br> Computers</h2>
                                <p class="address">Maradana, <br>Colombo 10, <br>Sri Lanka. </p>
                                <div class="txn mt-2">alphaTech@gmail.com</div>
                            </div>
                            <div class="col-5">
                                <p>Client,</p>
                                <?php
                                $stu_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $umail . "' ");
                                $stu_data = $stu_rs->fetch_assoc();
                                ?>
                                <h2><?php echo $_SESSION["u"]["fname"] . " " .  $_SESSION["u"]["lname"];
                                    ?></h2>
                                <?php

                                $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "' ");
                                $address_data = $address_rs->fetch_assoc();

                                ?>
                                <p class="address"><?php echo $address_data["line1"];
                                                    ?>, <br> <?php echo $address_data["line2"];
                                                                ?>, <br>Sri Lanka. </p>
                                <div class="txn mt-2"><?php echo $umail;
                                                        ?></div>
                            </div>
                        </div>
                        <div class="row extra-info pt-3">
                            <div class="col-7">

                                <?php

                                $iDate = $invoice_data["date"];
                                $invoiceDateTime = explode(" ", $iDate);
                                $inviceDate = $invoiceDateTime[0];

                                ?>
                                <p>Invoice ID: <br><span><?php echo $oid; ?></span></p>
                            </div>
                            <div class="col-5">
                                <p>Date of Payment: <br><span><?php echo $inviceDate;
                                                                ?></span></p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="product-area mt-4 mb-5">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Product</td>
                                <td>Order_id</td>
                                <td>Price</td>
                                <td>Qty</td>
                                <td>Amount</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $obj = json_decode($details);

                            $title_array = $obj->title_array;
                            $price_array = $obj->price_array;
                            $qty_array = $obj->qty_array;

                            $invoice_rs2 = Database::search("SELECT * FROM `invoice` WHERE `invoice_id`='" . $oid . "'");
                            $invoice_num2 = $invoice_rs2->num_rows;

                            for ($x = 0; $x < $invoice_num2; $x++) {

                                $invoice_data2 = $invoice_rs2->fetch_assoc();

                                $title = $title_array[$x];
                                $price = $price_array[$x];
                                $qty = $qty_array[$x];

                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data2["product_id"] . "'");
                                $product_data = $product_rs->fetch_assoc();

                                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $invoice_data2["product_id"] . "'");
                                $image_data = $image_rs->fetch_assoc();

                                $string = $product_data["description"];

                                $limitText = mb_strimwidth($string, 0, 20, "...");

                            ?>
                                <tr>
                                    <td>
                                        <div class="media">
                                            <img class="mr-3 img-fluid" src="<?php echo $image_data["code"]; ?>" alt="Product 01">
                                            <div class="media-body">
                                                <p class="mt-0 title"><?php echo $product_data["title"]; ?></p>
                                                <?php echo $limitText; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo $invoice_data2["order_id"];
                                        ?></td>
                                    <td>Rs.<?php echo $price;
                                            ?>.00</td>
                                    <td><?php echo $qty;
                                        ?></td>
                                    <?php
                                    $p_total = ($price * $qty);
                                    ?>
                                    <td>Rs.<?php echo $p_total;
                                            ?>.00</td>
                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </section>

                <section class="balance-info">
                    <div class="row">
                        <div class="col-8">
                            <p class="m-0 font-weight-bold"> Note: </p>
                            <p>Invoice was created on a computer and is valid without the Signature and Seal.</p>
                        </div>
                        <div class="col-4">
                            <table class="table border-0 table-hover">
                                <?php

                                $subtotal = $obj->subtotal;
                                $shipping = $obj->shipping;

                                $amount = (intval($subtotal) + intval($shipping)) - intval($discount);

                                ?>
                                <tr>
                                    <td>Sub Total:</td>
                                    <td>Rs.<?php echo $subtotal;
                                            ?>.00</td>
                                </tr>
                                <tr>
                                    <td>Delivery Fee:</td>
                                    <td>Rs.<?php echo $shipping;
                                            ?>.00</td>
                                </tr>
                                <tr>
                                    <td>Discount ( - ):</td>
                                    <td>Rs.<?php echo $discount;
                                            ?>.00</td>
                                </tr>
                                <tfoot>
                                    <tr>
                                        <td>GRAND TOTAL</td>
                                        <td>Rs.<?php echo $amount;
                                                ?>.00</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <!-- Signature -->
                            <div class="col-12">
                                <img src="assets/images/invoice/signature.png" class="img-fluid" alt="">
                                <p class="text-center m-0"> Director Signature </p>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>


        ?>

        <script>
            function generatePDF() {
                const element = document.getElementById('page');
                html2pdf()
                    .from(element)
                    .save();

            }
        </script>

        <script src="assets/js/script.js"></script>
        <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    </body>

    </html>

<?php
} else {
    header("Location:index.php");
}
