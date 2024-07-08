<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Invoice - AlphaTech</title>

    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <link rel="stylesheet" href="assets/css/invoiceStyle.css" />

</head>

<body>



    <div class="my-5 page" size="A4">
        <div class="position-absolute ml-1 mt-1">
            <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i>
                print</button>
            <button class="btn btn-danger me-2" onclick="generatePDF();"><i class="bi bi-filetype-pdf"></i> Export as
                PDF</button>
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
                        <p>Invoice No. 0<span>1</span></p>
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

                            <h2>Ayesh Chathuranga</h2>

                            <p class="address">Makandura, <br> Mulatiyana, <br>Sri Lanka. </p>
                            <div class="txn mt-2">ayesh@gmail.com</div>
                        </div>
                    </div>
                    <div class="row extra-info pt-3">
                        <div class="col-7">


                            <p>Invoice ID: <br><span>0012</span></p>
                        </div>
                        <div class="col-5">
                            <p>Date of Payment: <br><span>2024-05-15</span></p>
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
                        <tr>
                            <td>
                                <div class="media">

                                    <div class="media-body">
                                        <p class="mt-0 title">Speaker</p>
                                        Kazai Speaker
                                    </div>
                                </div>
                            </td>
                            <td>001</td>
                            <td>Rs.2000.00</td>
                            <td>10</td>
                            <td>Rs.20000.00</td>
                        </tr>
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
                            <tr>
                                <td>Sub Total:</td>
                                <td>Rs.20000.00</td>
                            </tr>
                            <tr>
                                <td>Delivery Fee:</td>
                                <td>Rs.0.00</td>
                            </tr>
                            <tfoot>
                                <tr>
                                    <td>GRAND TOTAL</td>
                                    <td>Rs.20000.00</td>
                                </tr>
                            </tfoot>
                        </table>


                    </div>
                </div>
            </section>

        </div>
    </div>

    <div style="width: 100%; background-color: #F6F6F6; padding: 30px 0 50px 0;">
        <div
            style="width: 600px; background-color: #fff; margin: auto; padding: 20px; text-align: center; border: 1px solid #E9E9E9; text-align: left;">
            <div>Hi,</div>
            <div style="margin-top: 10px;">Please see the attached Invoice - #134. The due amount is LKR500 The invoice
                is due by 2023-10-22. Please
                don't hesitate to get in touch if you have any questions or need clarifications.</div>
            <div style="margin-top: 10px;">Best regards,</div>
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