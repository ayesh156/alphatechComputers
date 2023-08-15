var bm;
function login() {

    var email = document.getElementById("email");
    var password = document.getElementById("lpi");
    var rememberme = document.getElementById("rememberme");

    var form = new FormData();
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("r", rememberme.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Success") {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = "Logged in successfully";
                document.getElementById("alertBtn").setAttribute("href", "index.php");
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = text;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    request.open("POST", "loginProcess.php", true);
    request.send(form);

}

var fpm;
function forgotPassword() {

    var email = document.getElementById("email");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var m = document.getElementById("forgotPasswordModel");
                fpm = new bootstrap.Modal(m);
                fpm.show();
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function showPassword1() {

    var i = document.getElementById("lpi");
    var eye = document.getElementById("e1");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "fa fa-eye";
    } else {
        i.type = "password";
        eye.className = "fa fa-eye-slash";
    }
}

function showPassword2() {

    var i = document.getElementById("rpi");
    var eye = document.getElementById("e2");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "fa fa-eye";
    } else {
        i.type = "password";
        eye.className = "fa fa-eye-slash";
    }
}

function showPassword3() {

    var i = document.getElementById("npi");
    var eye = document.getElementById("e3");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "fa fa-eye";
    } else {
        i.type = "password";
        eye.className = "fa fa-eye-slash";
    }
}

function showPassword4() {

    var i = document.getElementById("rnpi");
    var eye = document.getElementById("e4");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "fa fa-eye";
    } else {
        i.type = "password";
        eye.className = "fa fa-eye-slash";
    }
}

function resetpw() {

    var email = document.getElementById("email");
    var np = document.getElementById("npi");
    var rnp = document.getElementById("rnpi");
    var vcode = document.getElementById("vc");

    var form = new FormData();
    form.append("e", email.value);
    form.append("n", np.value);
    form.append("r", rnp.value);
    form.append("v", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                fpm.hide();
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = "Your password has been reset successfully";
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }

        }
    }

    r.open("POST", "resetPassword.php", true);
    r.send(form);

}

function register() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email2");
    var password = document.getElementById("rpi");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("m", mobile.value);
    form.append("g", gender.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var t = request.responseText;
            if (t == "Success") {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = "Registered successfully";
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
                fname.value = null;
                lname.value = null;
                email.value = null;
                password.value = null;
                mobile.value = null;
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    request.open("POST", "registerProcess.php", true);
    request.send(form);
}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "index.php";
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = text;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("GET", "signoutProcess.php", true)
    r.send();

}

var qvm;
function quickModelView(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("quickModelView").innerHTML = t;
            var m = document.getElementById("modalQuickview");
            qvm = new bootstrap.Modal(m);
            qvm.show();
        }
    }

    r.open("GET", "quickModelView.php?id=" + id, true)
    r.send();
}

function loadMainImg(id) {
    var img = document.getElementById("productImg" + id).src;
    var main = document.getElementById("main_img");
    main.src = img;
}

function checkValue(qty) {
    var input = document.getElementById("qty_input");

    if (input.value <= 0) {
        var m = document.getElementById("alertModal");
        bm = new bootstrap.Modal(m);
        bm.show();
        document.getElementById("alertText").innerHTML = "Quantity must be 1 or more";
        document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
        document.getElementById("alertBtn").setAttribute("aria-label", "Close");
        input.value = 1;
    } else if (input.value > qty) {
        var m = document.getElementById("alertModal");
        bm = new bootstrap.Modal(m);
        bm.show();
        document.getElementById("alertText").innerHTML = "Maximum quantity achieved";
        document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
        document.getElementById("alertBtn").setAttribute("aria-label", "Close");
        input.value = qty;
    }
}

function qty_inc(qty) {
    var input = document.getElementById("qty_input");
    if (input.value < (qty - 1)) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue.toString();
        document.getElementById("minusBtn").style.backgroundColor = "#6C757D";
    } else if (input.value < qty) {
        document.getElementById("plusBtn").style.backgroundColor = "#343A40";
        input.value = qty;
    }
}

function qty_dec() {
    var input = document.getElementById("qty_input");
    if (input.value > 2) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue.toString();
        document.getElementById("plusBtn").style.backgroundColor = "#6C757D";
    } else if (input.value > 1) {

        document.getElementById("minusBtn").style.backgroundColor = "#343A40";
        input.value = 1;

    }
}

var acm;
function addModalcart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("addModalcart").innerHTML = t;
            var n = document.getElementById("modalAddcart");
            acm = new bootstrap.Modal(n);
            acm.show();
        }
    }

    r.open("GET", "addModalcart.php?id=" + id, true)
    r.send();
}

var awm;
function addModalwishlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("addModalwishlist").innerHTML = t;
            var n = document.getElementById("modalAddWishlist");
            awm = new bootstrap.Modal(n);
            awm.show();
        }
    }

    r.open("GET", "addModalwishlist.php?id=" + id, true)
    r.send();
}

function headerCart() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("headerCart").innerHTML = t;
        }
    }

    r.open("GET", "headerCart.php", true)
    r.send();
}

function deleteCartItem(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deleted1") {
                headerCart();
            } else if (t == "Deleted2") {
                headerCart();
                var cartCount = document.getElementById("cartCount1").innerHTML;
                var newCount = parseInt(cartCount) - 1;
                document.getElementById("cartCount1").innerHTML = newCount;
                document.getElementById("cartCount2").innerHTML = newCount;
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");;
            }
        }

    }

    r.open("GET", "deleteHeaderCartProcess.php?id=" + id, true);
    r.send();
}

function headerWishlist() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("headerWishlist").innerHTML = t;
        }
    }

    r.open("GET", "headerWishlist.php", true)
    r.send();
}

function deleteWishlistItem(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deleted") {
                headerWishlist();
                var wishlistCount = document.getElementById("wishlistCount1").innerHTML;
                var newCount = parseInt(wishlistCount) - 1;
                document.getElementById("wishlistCount1").innerHTML = newCount;
                document.getElementById("wishlistCount2").innerHTML = newCount;
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");;
            }
        }

    }

    r.open("GET", "deleteHeaderWishlistProcess.php?id=" + id, true);
    r.send();
}

function addToCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var cartCount = document.getElementById("cartCount1").innerHTML;
                var newCount = parseInt(cartCount) + 1;
                document.getElementById("cartCount1").innerHTML = newCount;
                document.getElementById("cartCount2").innerHTML = newCount;
                addModalcart(id);
                headerCart();
            } else if (t == "Updated") {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = "Product Updated";
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
                headerCart();
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();

}

function addToWishlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "removed") {
                var wishlistCount = document.getElementById("wishlistCount1").innerHTML;
                var newCount = parseInt(wishlistCount) - 1;
                document.getElementById("wishlistCount1").innerHTML = newCount;
                document.getElementById("wishlistCount2").innerHTML = newCount;
                headerWishlist();
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = "Product removed";
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            } else if (t == "added") {
                var wishlistCount = document.getElementById("wishlistCount1").innerHTML;
                var newCount = parseInt(wishlistCount) + 1;
                document.getElementById("wishlistCount1").innerHTML = newCount;
                document.getElementById("wishlistCount2").innerHTML = newCount;
                addModalwishlist(id);
                headerWishlist();
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");;
            }
        }

    }

    r.open("GET", "addToWishlistProcess.php?id=" + id, true);
    r.send();
}

function productGridView(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productGridView").innerHTML = t;
        }
    }

    r.open("GET", "productGridView.php?page=" + p, true);
    r.send();

}

function productListView(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productListView").innerHTML = t;
        }
    }

    r.open("GET", "productListView.php?page=" + p, true);
    r.send();

}

var category = 0;
function sortGridCategory(s, x) {

    var sort = document.getElementById("speed").value;
    category = s;

    var category_num = document.getElementById("categoryCount").innerHTML;

    for (var y = 1; y <= category_num; y++) {

        if (y != s) {
            document.getElementById("categoryId" + y).style.color = "#fff";
        }

        if (y == s) {
            document.getElementById("categoryId" + y).style.color = "#ff365d";
        }

    }

    var f = new FormData();
    f.append("s", s);
    f.append("st", sort);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productGridView").innerHTML = t;
        }
    }

    r.open("POST", "sortGridCategory.php", true);
    r.send(f);
}


function sortListCategory(s, x) {

    var sort = document.getElementById("speed").value;

    var f = new FormData();
    f.append("s", s);
    f.append("st", sort);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productListView").innerHTML = t;
        }
    }

    r.open("POST", "sortListCategory.php", true);
    r.send(f);
}

var brand = 0;
function sortGridBrand(s, x) {

    var sort = document.getElementById("speed").value;
    brand = s;

    var f = new FormData();
    f.append("s", s);
    f.append("st", sort);
    f.append("c", category);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productGridView").innerHTML = t;
        }
    }

    r.open("POST", "sortGridBrand.php", true);
    r.send(f);

}


function sortListBrand(s, x) {

    var sort = document.getElementById("speed").value;

    var f = new FormData();
    f.append("s", s);
    f.append("st", sort);
    f.append("c", category);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productListView").innerHTML = t;
        }
    }

    r.open("POST", "sortListBrand.php", true);
    r.send(f);
}

var condition = 0;
function sortGridCondition(s, x) {

    var sort = document.getElementById("speed").value;
    condition = s;

    var f = new FormData();
    f.append("s", s);
    f.append("st", sort);
    f.append("c", category);
    f.append("b", brand);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productGridView").innerHTML = t;
        }
    }

    r.open("POST", "sortGridCondition.php", true);
    r.send(f);

}


function sortListCondition(s, x) {

    var sort = document.getElementById("speed").value;

    var f = new FormData();
    f.append("s", s);
    f.append("st", sort);
    f.append("c", category);
    f.append("b", brand);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productListView").innerHTML = t;
        }
    }

    r.open("POST", "sortListCondition.php", true);
    r.send(f);
}

function sortGridColour(s, x) {

    var sort = document.getElementById("speed").value;

    var f = new FormData();
    f.append("s", s);
    f.append("st", sort);
    f.append("c", category);
    f.append("b", brand);
    f.append("con", condition);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productGridView").innerHTML = t;
        }
    }

    r.open("POST", "sortGridColour.php", true);
    r.send(f);

}


function sortListColour(s, x) {

    var sort = document.getElementById("speed").value;

    var f = new FormData();
    f.append("s", s);
    f.append("st", sort);
    f.append("c", category);
    f.append("b", brand);
    f.append("con", condition);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productListView").innerHTML = t;
        }
    }

    r.open("POST", "sortListColour.php", true);
    r.send(f);
}

function showPassword5() {

    var i = document.getElementById("ppi");
    var eye = document.getElementById("e5");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "fa fa-eye";
    } else {
        i.type = "password";
        eye.className = "fa fa-eye-slash";
    }
}

function changeImage() {
    var view = document.getElementById("viewImg");
    var file = document.getElementById("profileimg");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function updateProfile() {
    var fname = document.getElementById("fname2");
    var lname = document.getElementById("lname2");
    var mobile = document.getElementById("mobile2");
    var password = document.getElementById("ppi");
    var gender = document.getElementById("gender2");
    var image = document.getElementById("profileimg");

    var f = new FormData();
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("m", mobile.value);
    f.append("p", password.value);
    f.append("g", gender.value);
    f.append("image", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = "Profile updated successfully";
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);

}

function updateAddress() {
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");

    var f = new FormData();
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = "Address updated successfully";
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("POST", "updateAddressProcess.php", true);
    r.send(f);

}

function printInvoice() {
    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;

    document.body.innerHTML = "<html><head><title></title></head><body>" +
        page + "</body>";
    window.print();
    document.body.innerHTML = body;

}

function payNow(id) {
    var qty = document.getElementById("qty_input").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["mail"];
            var amount = obj["amount"];

            if (t == "1") {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = "Please log in or sign up";
                document.getElementById("alertBtn").setAttribute("href", "login.php");
            } else if (t == "2") {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = "Please update your profile first";
                document.getElementById("alertBtn").setAttribute("href", "my-account.php");
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, id, mail, amount, qty);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221178",    // Replace your Merchant ID
                    "return_url": "http://localhost/alphatechComputers/product-details.php?id=" + id,     // Important
                    "cancel_url": "http://localhost/alphatechComputers/product-details.php?id=" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"],
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }

        }
    }

    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    r.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("POST", "saveInvoice.php", true);
    r.send(f);
}

function cartSearchResult(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("cartSearchResult").innerHTML = t;
        }
    }

    r.open("GET", "cartSearchResult.php?page=" + p, true);
    r.send();

}

function deleteCart(id, p) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deleted1") {
                headerCart();
                cartSearchResult(p);
            } else if (t == "Deleted2") {
                headerCart();
                cartSearchResult(p);
                var cartCount = document.getElementById("cartCount1").innerHTML;
                var newCount = parseInt(cartCount) - 1;
                document.getElementById("cartCount1").innerHTML = newCount;
                document.getElementById("cartCount2").innerHTML = newCount;
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");;
            }
        }

    }

    r.open("GET", "deleteCartProcess.php?id=" + id, true);
    r.send();
}

function addToCart2(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                headerCart();
            } else if (t == "Updated") {
                headerCart();
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();

}

function addQtyToCart(qty, id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Updated") {
                headerCart();
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("GET", "addQtyToCartProcess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}

function checkCartValue(qty, id, p) {
    var input = document.getElementById("qty_input" + id);
    if (input.value > 0 && input.value < qty) {
        addQtyToCart(input.value, id);
        cartSearchResult(p);
    } else if (input.value <= 0) {
        var m = document.getElementById("alertModal");
        bm = new bootstrap.Modal(m);
        bm.show();
        document.getElementById("alertText").innerHTML = "Quantity must be 1 or more";
        document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
        document.getElementById("alertBtn").setAttribute("aria-label", "Close");
        input.value = 1;
    } else if (input.value > qty) {
        var m = document.getElementById("alertModal");
        bm = new bootstrap.Modal(m);
        bm.show();
        document.getElementById("alertText").innerHTML = "Maximum quantity achieved";
        document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
        document.getElementById("alertBtn").setAttribute("aria-label", "Close");
        input.value = qty;
    }
}

function cartQty_inc(qty, id, p) {
    var input = document.getElementById("qty_input" + id);
    if (input.value < (qty - 1)) {
        addToCart2(id);
        cartSearchResult(p);
        var newValue = parseInt(input.value) + 1;
        input.value = newValue.toString();
        document.getElementById("minusBtn" + id).style.backgroundColor = "#6C757D";
    } else if (input.value < qty) {
        document.getElementById("plusBtn" + id).style.backgroundColor = "#343A40";
        input.value = qty;
    }
}

function cartQty_dec(id, p) {
    var input = document.getElementById("qty_input" + id);

    if (input.value > 1) {
        deleteCartItem(id);
        cartSearchResult(p);
        var newValue = parseInt(input.value) - 1;
        input.value = newValue.toString();
        document.getElementById("plusBtn" + id).style.backgroundColor = "#6C757D";
    } else if (input.value > 2) {

        document.getElementById("minusBtn" + id).style.backgroundColor = "#343A40";
        input.value = 1;

    } else if (input.value == 1) {

        document.getElementById("minusBtn" + id).style.backgroundColor = "#343A40";
        input.value = 1;

    }
}

function applyCoupon() {

    var couponCode = document.getElementById("couponCode").value;
    var couponMsg = document.getElementById("couponMsg");

    var f = new FormData();
    f.append("cc", couponCode);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "notSet") {
                couponMsg.innerHTML = "Please Enter Coupon Code";
                couponMsg.style.color = "red";
            } else if (t == "invalid") {
                couponMsg.innerHTML = "Invalid Coupon Code";
                couponMsg.style.color = "red";
            } else if (t == "expire") {
                couponMsg.innerHTML = "This coupon code has expired";
                couponMsg.style.color = "red";
            } else if (t == "notActive") {
                couponMsg.innerHTML = "This coupon code has not been activated";
                couponMsg.style.color = "red";
            } else if (t == "used") {
                couponMsg.innerHTML = "This coupon code has already been used";
                couponMsg.style.color = "red";
            } else {
                var subTotal = document.getElementById("subTotal").innerHTML;
                var shipping = document.getElementById("shipping").innerHTML;
                document.getElementById("discount").innerHTML = t;
                var grandTotal = (parseInt(subTotal) + parseInt(shipping)) - t;
                document.getElementById("total").innerHTML = grandTotal;
                couponMsg.innerHTML = "Coupon code added successfully";
                couponMsg.style.color = "red";
            }
        }
    }

    r.open("POST", "applyCouponProcess.php", true);
    r.send(f);
}

function checkout() {
    var details = document.getElementById("details").innerHTML;
    var discount = document.getElementById("discount").innerHTML;

    var f = new FormData();
    f.append("dtl", details);
    f.append("dis", discount);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            var obj = JSON.parse(t);
            var orderId = obj["id"];
            var mail = obj["mail"];
            var amount = obj["amount"];

            if (t == "1") {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = "Please log in or sign up";
                document.getElementById("alertBtn").setAttribute("href", "login.php");
            } else if (t == "2") {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = "Please update your profile first";
                document.getElementById("alertBtn").setAttribute("href", "my-account.php");
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer
                    saveInvoice2(orderId, details, discount);
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221178",    // Replace your Merchant ID
                    "return_url": "http://localhost/alphatechComputers/cart.php",     // Important
                    "cancel_url": "http://localhost/alphatechComputers/cart.php",     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": orderId,
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"],
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }

        }
    }

    r.open("POST", "checkoutProcess.php", true);
    r.send(f);

}

function saveInvoice2(orderId, details, discount) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("det", details);
    f.append("dct", discount);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "checkoutInvoice.php?oid=" + orderId + "&disc=" + discount + "&deta=" + details;
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("POST", "savecheckoutInvoice.php", true);
    r.send(f);
}


function wishlistSearchResult(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("wishlistSearchResult").innerHTML = t;
        }
    }

    r.open("GET", "wishlistSearchResult.php?page=" + p, true);
    r.send();

}

function deleteWishlist(id, p) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deleted") {
                headerWishlist();
                wishlistSearchResult(p);
                var wishlistCount = document.getElementById("wishlistCount1").innerHTML;
                var newCount = parseInt(wishlistCount) - 1;
                document.getElementById("wishlistCount1").innerHTML = newCount;
                document.getElementById("wishlistCount2").innerHTML = newCount;
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }

    }

    r.open("GET", "deleteWishlistProcess.php?id=" + id, true);
    r.send();
}

var searchKeyword = 'sd';

function mainSearch() {

    var search = document.getElementById("searchInput").value;

    searchKeyword = search;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("mainSearchResult").innerHTML = t;
            document.getElementById("search").classList.remove("open");
        }

    }

    r.open("GET", "mainSearchProcess.php?s=" + search, true);
    r.send();

}

function mainSearchView(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("mainSearchResult").innerHTML = t;
        }
    }

    r.open("GET", "mainSearchProcess.php?page=" + p + "&s=" + searchKeyword, true);
    r.send();

}

// Admin Verification
var adv;
function adminVerification() {
    var email = document.getElementById("aemail");

    var f = new FormData();
    f.append("e", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var m = document.getElementById("adminVerificationModel");
                adv = new bootstrap.Modal(m);
                adv.show();
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);
}

function verify() {
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                adv.hide();
                window.location = "dashboard.php";
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("GET", "verificationProcess.php?v=" + verification.value, true);
    r.send();
}

function adminSignout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "index.php";
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
            }
        }
    }

    r.open("GET", "adminSignoutProcess.php", true)
    r.send();
}

var cm;
function addCategoryModal() {
    var m = document.getElementById("addCategoryModel");
    cm = new bootstrap.Modal(m);
    cm.show();
}

function categoryResult() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("categoryResult").innerHTML = t;
        }
    }

    r.open("GET", "categoryResult.php", true)
    r.send();
}

function addCategory() {

    var category = document.getElementById("cname").value;

    var m = document.getElementById("alertModal");
    bm = new bootstrap.Modal(m);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                categoryResult();
                cm.hide();
            } else if (t == "exists") {
                bm.show();
                document.getElementById("alertText").innerHTML = "This category already exists";
            } else {
                bm.show();
                document.getElementById("alertText").innerHTML = t;
            }
        }
    }

    r.open("GET", "addCategoryProcess.php?c=" + category, true)
    r.send();
}

function adminProductResult() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("adminProductResult").innerHTML = t;
        }
    }

    r.open("GET", "adminProductResult.php", true)
    r.send();
}

function adminCategorySearch(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("adminProductResult").innerHTML = t;
        }
    }

    r.open("GET", "adminCategorySearch.php?id=" + id, true)
    r.send();

}

function adminProductSearch() {

    var keyword = document.getElementById("productKey").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("adminProductResult").innerHTML = t;
        }
    }

    r.open("GET", "adminProductSearch.php?k=" + keyword, true)
    r.send();

}

function addProductImage() {
    var image = document.getElementById("pImageuploader");

    image.onchange = function () {

        var file_count = image.files.length;

        if (file_count <= 4) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("pi" + x).src = url;

            }

        } else {
            alert("Please select 4 or less than 4 images.");
        }

    }
}

function addProduct() {

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");

    var condition = 0;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    }

    var colour = document.getElementById("clr");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("price");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("pImageuploader");

    var m = document.getElementById("alertModal");
    bm = new bootstrap.Modal(m);

    var f = new FormData();

    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("con", condition);
    f.append("col", colour.value);
    f.append("qty", qty.value);
    f.append("cost", cost.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("desc", desc.value);


    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                bm.show();
                document.getElementById("alertText").innerHTML = "Product added successfully";
                document.getElementById("alertBtn").setAttribute("onclick", "window.location.reload();");
            } else {
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("onclick", "bm.hide();");
            }
        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);

}

function updateProduct(id) {

    var title = document.getElementById("title2");
    var colour = document.getElementById("clr2");
    var qty = document.getElementById("qty2");
    var price = document.getElementById("price2");
    var delivery_within_colombo = document.getElementById("dwc2");
    var delivery_outof_colombo = document.getElementById("doc2");
    var description = document.getElementById("desc2");
    var images = document.getElementById("pImageuploader");

    var m = document.getElementById("alertModal");
    bm = new bootstrap.Modal(m);

    var f = new FormData();
    f.append("id", id);
    f.append("t", title.value);
    f.append("c", colour.value);
    f.append("q", qty.value);
    f.append("p", price.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("d", description.value);

    var img_count = images.files.length;

    for (var x = 0; x < img_count; x++) {
        f.append("i" + x, images.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                bm.show();
                document.getElementById("alertText").innerHTML = "Product updated successfully";
                document.getElementById("alertBtn").setAttribute("onclick", "window.location.reload();");
            } else {
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("onclick", "bm.hide();");
            }
        }
    }

    r.open("POST", "updateProductProcess.php", true);
    r.send(f);

}

function load_model() {

    var brand = document.getElementById("brand");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("model").innerHTML = t;
        }
    }

    r.open("GET", "loadModel.php?b=" + brand.value, true);
    r.send();

}

function changeAdminImage() {
    var view = document.getElementById("viewImg2");
    var file = document.getElementById("profileimg2");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function updateAdminProfile() {
    var fname = document.getElementById("fname3");
    var lname = document.getElementById("lname3");
    var email = document.getElementById("email3");
    var mobile = document.getElementById("mobile3");
    var gender = document.getElementById("gender3");
    var image = document.getElementById("profileimg2");

    var f = new FormData();
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("e", email.value);
    f.append("m", mobile.value);
    f.append("g", gender.value);
    f.append("image", image.files[0]);

    var m = document.getElementById("alertModal");
    bm = new bootstrap.Modal(m);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                bm.show();
                document.getElementById("alertText").innerHTML = "Profile updated successfully";
                document.getElementById("alertBtn").setAttribute("onclick", "window.location.reload();");
            } else {
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("onclick", "bm.hide();");
            }
        }
    }

    r.open("POST", "updateAdminProcess.php", true);
    r.send(f);

}

function deleteProduct(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                adminProductResult();
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
            }
        }
    }

    r.open("GET", "deleteProductProcess.php?id=" + id, true);
    r.send();
}

function updateAdminProfile() {
    var name = document.getElementById("name");
    var email = document.getElementById("email4");
    var subject = document.getElementById("subject");
    var message = document.getElementById("message");

    var f = new FormData();
    f.append("n", name.value);
    f.append("e", email.value);
    f.append("s", subject.value);
    f.append("m", message.value);

    var m = document.getElementById("alertModal");
    bm = new bootstrap.Modal(m);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                bm.show();
                document.getElementById("alertText").innerHTML = "Thank you for connecting with us";
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
                name.value = null;
                email.value = null;
                subject.value = null;
                message.value = null;
            } else {
                bm.show();
                document.getElementById("alertText").innerHTML = t;
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("POST", "saveMessageProcess.php", true);
    r.send(f);

}

function myOrderResult(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("orders").innerHTML = t;
        }
    }

    r.open("GET", "myOrderResult.php?page=" + p, true);
    r.send();

}

function blockUser(email) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var txt = request.responseText;
            if (txt == "blocked") {
                document.getElementById("ub" + email).innerHTML = "Unblock";
                document.getElementById("ub" + email).classList = "btn-blue";
            } else if (txt == "unblocked") {
                document.getElementById("ub" + email).innerHTML = "Block";
                document.getElementById("ub" + email).classList = "btn-red";
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
            }

        }
    }

    request.open("GET", "userBlockProcess.php?email=" + email, true);
    request.send();

}

function adminUserSearch() {

    var keyword = document.getElementById("userKey").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("adminUserResult").innerHTML = t;
        }
    }

    r.open("GET", "adminUserSearch.php?k=" + keyword, true)
    r.send();

}

function changeStatus(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 1) {
                document.getElementById("btn" + id).innerHTML = "Packing";
                document.getElementById("btn" + id).classList = "packing-btn";
            } else if (t == 2) {
                document.getElementById("btn" + id).innerHTML = "Dispatch";
                document.getElementById("btn" + id).classList = "dispatch-btn";
            } else if (t == 3) {
                document.getElementById("btn" + id).innerHTML = "Shipping";
                document.getElementById("btn" + id).classList = "delivered-btn";
            } else if (t == 4) {
                document.getElementById("btn" + id).innerHTML = "Delivered";
                document.getElementById("btn" + id).classList = "delivered-btn disabled";
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
            }
        }
    }

    r.open("GET", "changeInvoiceStatusProcess.php?id=" + id, true);
    r.send();
}

function adminInvoiceSearch() {

    var keyword = document.getElementById("invoiceKey").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sellngHistoryResult").innerHTML = t;
        }
    }

    r.open("GET", "adminInvoiceSearch.php?k=" + keyword, true)
    r.send();

}

function findSellings() {

    var from = document.getElementById("from_date").value;
    var to = document.getElementById("to_date").value;

    var f = new FormData();
    f.append("f", from);
    f.append("t", to);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sellngHistoryResult").innerHTML = t;
        }
    }

    r.open("POST", "findSellingsProcess.php", true)
    r.send(f);

}

function blockProduct(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var txt = request.responseText;
            if (txt == "Deactive") {
                document.getElementById("pb" + id).innerHTML = "Active";
                document.getElementById("pb" + id).classList = "btn-blue";
            } else if (txt == "Active") {
                document.getElementById("pb" + id).innerHTML = "Deactive";
                document.getElementById("pb" + id).classList = "btn-red";
            } else {
                var m = document.getElementById("alertModal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("alertText").innerHTML = t;
            }

        }
    }

    request.open("GET", "productBlockProcess.php?id=" + id, true);
    request.send();

}

var rm;
var rmid;
function addReview(id) {
    rmid = id;

    var reviewModel = document.getElementById("reviewModel");
    rm = new bootstrap.Modal(reviewModel);
    rm.show();
}

function saveReview() {

    var review = document.getElementById("review-text")

    var f = new FormData();
    f.append("p", rmid);
    f.append("r", review.value);

    var m = document.getElementById("alertModal");
    bm = new bootstrap.Modal(m);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'Success') {
                bm.show();
                document.getElementById("alertText").innerHTML = "Thank You for Your Review!";
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
                rm.hide();
                document.getElementById("reviewText"+rmid).innerHTML = "Reviewed";
                document.getElementById("reviewText"+rmid).classList = "text-white";
            } else {
                bm.show();
                document.getElementById("alertText").innerHTML = "Address updated successfully";
                document.getElementById("alertBtn").setAttribute("data-bs-dismiss", "modal");
                document.getElementById("alertBtn").setAttribute("aria-label", "Close");
            }
        }
    }

    r.open("POST", "saveReviewProcess.php", true);
    r.send(f);

}