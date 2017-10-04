<?php
session_start();
if (isset($_SESSION['login'])) {
    header('Location: login.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>

    <style>
        table {
            width: 400px;
            border-collapse: collapse;
        }
        th {
            width: 100px;
            text-align: center;
            background: #4CAF50;
            color: aliceblue;
        }
        td {
            width: 100px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Shopping Cart</h1>

    <form action="../server/prcess_cart.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Product A <input type="hidden" id="product_a_name" value="Product A" name="product_a_name"></td>
                    <td>$10 <input type="hidden" value="10" id="product_a_price" name="product_a_price"></td>
                    <td><input type="number" value="0" min="0" id="product_a_quantity" name="product_a_quantity" onchange="that.updateAll()"></td>
                    <td><div id="product_a_subtotal_prs">$0</div> <input type="hidden" value="0" id="product_a_subtotal" name="product_a_subtotal"></td>
                </tr>
                <tr>
                    <td>Product B <input type="hidden" id="product_b_name" value="Product B" name="product_b_name"></td>
                    <td>$20 <input type="hidden" value="20" id="product_b_price" name="product_b_price"></td>
                    <td><input type="number" value="0" min="0" id="product_b_quantity" name="product_b_quantity" onchange="that.updateAll()"></td>
                    <td><div id="product_b_subtotal_prs">$0</div> <input type="hidden" value="0" id="product_b_subtotal" name="product_b_subtotal"></td>
                </tr>
                <tr>
                    <td>Product C <input type="hidden" id="product_c_name" value="Product C" name="product_c_name"></td>
                    <td>$15 <input type="hidden" value="15" id="product_c_price" name="product_c_price"></td>
                    <td><input type="number" value="0" min="0" id="product_c_quantity" name="product_c_quantity" onchange="that.updateAll()"></td>
                    <td><div id="product_c_subtotal_prs">$0</div> <input type="hidden" value="0" id="product_c_subtotal" name="product_c_subtotal"></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th></th>
                    <th><div id="quantity">0</div><input value="0" id="total_quantity" name="total_quantity" type="hidden"/></th>
                    <th><div id="price">$0</div><input value="0" id="total_price" name="total_price" type="hidden"/></th>
                </tr>
            </tfoot>
        </table>

        <br>
        <br>

        Enter Your Card Number:<input type="number" id="credit_card_no" name="credit_card_no" value="0">
        <br>
        <br>
        <!--<button type="button" onclick="that.updateAll()">Update</button>-->
        <input type="hidden" name="encrypted" id="encrypted">
        <input type="submit" value="Submit" onclick="encrypt_all_with_RSA()">
    </form>

    <script type="text/javascript">
        var that = this;

        that.getQuantity = function getQuantity(product_name) {
            var product_u_quantity = parseInt(document.getElementById(product_name+'_quantity').value);
            return product_u_quantity;
        };

        that.calTotalVal = function calTotalVal(product_name) {
            var product_u_quantity = parseInt(document.getElementById(product_name+'_quantity').value);
            var product_u_price = parseInt(document.getElementById(product_name+'_price').value);

            var product_u_subtotal = product_u_quantity * product_u_price;
            document.getElementById(product_name+'_subtotal').value = product_u_subtotal;
            document.getElementById(product_name+'_subtotal_prs').innerHTML = '$'+product_u_subtotal;
            return product_u_subtotal;
        };

        that.updateAll = function updateAll() {
            var totalPrice = that.calTotalVal("product_a") + that.calTotalVal("product_b") +that.calTotalVal("product_c");
            var totalQuantity = that.getQuantity("product_a") + that.getQuantity("product_b") +that.getQuantity("product_c");

            document.getElementById('quantity').innerHTML = totalQuantity;
            document.getElementById('price').innerHTML = '$'+totalPrice;

            document.getElementById('total_quantity').value = totalQuantity;
            document.getElementById('total_price').value = '$'+totalPrice;
        }
    </script>

    <script type="text/javascript" src="js/rsa.js">
    </script>
    <script>
        function RSA_encryption(plaintext){
//            var plaintext = document.getElementById("plaintext").value;
            var pubilc_key = "-----BEGIN PUBLIC KEY-----MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzdxaei6bt/xIAhYsdFdW62CGTpRX+GXoZkzqvbf5oOxw4wKENjFX7LsqZXxdFfoRxEwH90zZHLHgsNFzXe3JqiRabIDcNZmKS2F0A7+Mwrx6K2fZ5b7E2fSLFbC7FsvL22mN0KNAp35tdADpl4lKqNFuF7NT22ZBp/X3ncod8cDvMb9tl0hiQ1hJv0H8My/31w+F+Cdat/9Ja5d1ztOOYIx1mZ2FD2m2M33/BgGY/BusUKqSk9W91Eh99+tHS5oTvE8CI8g7pvhQteqmVgBbJOa73eQhZfOQJ0aWQ5m2i0NUPcmwvGDzURXTKW+72UKDz671bE7YAch2H+U7UQeawwIDAQAB-----END PUBLIC KEY-----";
            // Encrypt with the public key...
            var encrypt = new JSEncrypt();
            encrypt.setPublicKey(pubilc_key);
            var encrypted = encrypt.encrypt(plaintext);

//            document.getElementById("encrypted").innerHTML = encrypted;
            return encrypted;
        }

        function RSA_decryption(){

            var encrypted = document.getElementById("encrypted").innerHTML;

            var private_key = "-----BEGIN PRIVATE KEY-----MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDN3Fp6Lpu3/EgCFix0V1brYIZOlFf4ZehmTOq9t/mg7HDjAoQ2MVfsuyplfF0V+hHETAf3TNkcseCw0XNd7cmqJFpsgNw1mYpLYXQDv4zCvHorZ9nlvsTZ9IsVsLsWy8vbaY3Qo0Cnfm10AOmXiUqo0W4Xs1PbZkGn9fedyh3xwO8xv22XSGJDWEm/QfwzL/fXD4X4J1q3/0lrl3XO045gjHWZnYUPabYzff8GAZj8G6xQqpKT1b3USH3360dLmhO8TwIjyDum+FC16qZWAFsk5rvd5CFl85AnRpZDmbaLQ1Q9ybC8YPNRFdMpb7vZQoPPrvVsTtgByHYf5TtRB5rDAgMBAAECggEAUDPieCnCd1rtvwpehXElpwxzJxg6ccdaVMjwx7tuoRidHoRzeB2fUNbWvLVIGvDTjTPGAr5I9BoFHT5tARJMeGIzbISDxsosDBRKu88cCx6dRl3ukcjSLsxMh8XUDhyWLsSgAMIpxVfHUuOsHmLZ2I3Ho6o1KIxdVg/JSgtdwTqjz3w8jmGQ/NXgc7Ym/ys1fLG9L2nYdMzK/mRJf/BnXiCNE6/SYlZYO716oC688UJBWS3BqB9jaJyNpigX//ynJvU6xw8FhHt4fRStUmCCYAYhCQu3XgbtmxKisDGhdBVASG+DM+vVTh+sSvxkNrjJjF+m2tSg578A8C8Ls0r3uQKBgQDpO9e178NR0HHmvWbZR9+uPugf4UT9+U2/dEfJBHAOp2GRsIvXkFwbPHuSHkc0iEPwz+U8gPC8jInSslKOUDtaGtUaVzzWrxxh7DggWx4pYs3I0Ki8C+CRTTdOY9GAFa9jhIyRmf6v9QoAH/loGNV2qYFbb+HweD0PnxlWha1txQKBgQDh9IBBltW7T96foUmHOn+x6xlF5MNDHxLBY6bngxKvMTZoi5C6wmmCmasF45LWbkvUiMAsovYN5z4cJnKXWmRmCS8NXUucmUgdvsmCbiB62BmZvHaOffmnIdhcAjBebT/Bn5qMvKCNy3fQFSfuEw1eRRO2IofB4o7z7m794vo25wKBgEPowrQcrZhCwwdWGn4laUGI23l80+PHFRYru0MSYbZCkiwjZXRMeiUMBUbUPhNTocSaI7rsKCweF3sbpOH/BmkD6wySXgp8Th1M9EKnhS6zsAtKhfbK1oY4H2RZuAQ9TCYD0BIM7pU5GcJTjQD8ShsU269N8lFcERtdTbldjtOpAoGAF4YkADAa6lhjXg0loY2Gk9hdFji913QZuMaOLtYnkNO3zWSSWc85ut4Svxc1R1vOSz89eqgwo7vqbHXYQken4jOckXCgGZqftnERe6HJgeCTsby8PxOAdVUBuHqF3J7VH2xlY7eTo4+GVsSNFq0nHCRm6/RmW9ohdeXh6k7CLAsCgYBZe3RLWuffKxg+lZmv9tJDOO813QPLFeixrBYhKjGDcwjVYcCugGNDmyStM0/++uWddgMKavNALjpamu8KolDNivrjL1qaFHX9Bpi108T+dDn2WpX+vUP6hjA/U2wtTvUbJle1SsbZxRrV9gf5PAJqTrQY4u28ezjR3PCV+R4kdw==-----END PRIVATE KEY-----";
            // Decrypt with the private key...
            var decrypt = new JSEncrypt();
            decrypt.setPrivateKey(private_key);
            var decrypted = decrypt.decrypt(encrypted);

            document.getElementById("decrypted").innerHTML = decrypted;
        }

        function encrypt_all_with_RSA() {
            var product_a_name = document.getElementById('product_a_name').value;
            var product_a_price = document.getElementById('product_a_price').value;
            var product_a_quantity = document.getElementById('product_a_quantity').value;
            var product_a_subtotal = document.getElementById('product_a_subtotal').value;
            var product_b_name = document.getElementById('product_b_name').value;
            var product_b_price = document.getElementById('product_b_price').value;
            var product_b_quantity = document.getElementById('product_b_quantity').value;
            var product_b_subtotal = document.getElementById('product_b_subtotal').value;
            var product_c_name = document.getElementById('product_c_name').value;
            var product_c_price = document.getElementById('product_c_price').value;
            var product_c_quantity = document.getElementById('product_c_quantity').value;
            var product_c_subtotal = document.getElementById('product_c_subtotal').value;
            var total_quantity = document.getElementById('total_quantity').value;
            var total_price = document.getElementById('total_price').value;
            var credit_card_no = document.getElementById('credit_card_no').value;

            var content = "";
            content = product_a_name + '&'
                + product_a_price + '&'
                + product_a_quantity + '&'
                + product_a_subtotal + '&'
                + product_b_name + '&'
                + product_b_price + '&'
                + product_b_quantity + '&'
                + product_b_subtotal + '&'
                + product_c_name + '&'
                + product_c_price + '&'
                + product_c_quantity + '&'
                + product_c_subtotal + '&'
                + total_quantity + '&'
                + total_price + '&'
                + credit_card_no;

            var encryted_credit_card_no = RSA_encryption(content);

            console.log(encryted_credit_card_no);

            document.getElementById('encrypted').value = encryted_credit_card_no;
        }
    </script>
</body>
</html>