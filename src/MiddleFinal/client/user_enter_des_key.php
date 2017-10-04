<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 04/10/2017
 * Time: 7:51 PM
 */
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.html");
}
$username = $_SESSION['user_name'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enter DES key</title>
</head>
<body>

<form action="../server/store_des_key_4c.php" method="post">
    Enter your custom DES Key:<input type="text" id="des_key" name="des_key">
    <br>
    <br>
    <input type="submit" value="Submit DES Key" onclick="encrypt_des_key_with_RSA()">
</form>

<script type="text/javascript" src="js/rsa.js">
</script>
<script>
    function RSA_encryption(plaintext){
        var pubilc_key = "-----BEGIN PUBLIC KEY-----MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzdxaei6bt/xIAhYsdFdW62CGTpRX+GXoZkzqvbf5oOxw4wKENjFX7LsqZXxdFfoRxEwH90zZHLHgsNFzXe3JqiRabIDcNZmKS2F0A7+Mwrx6K2fZ5b7E2fSLFbC7FsvL22mN0KNAp35tdADpl4lKqNFuF7NT22ZBp/X3ncod8cDvMb9tl0hiQ1hJv0H8My/31w+F+Cdat/9Ja5d1ztOOYIx1mZ2FD2m2M33/BgGY/BusUKqSk9W91Eh99+tHS5oTvE8CI8g7pvhQteqmVgBbJOa73eQhZfOQJ0aWQ5m2i0NUPcmwvGDzURXTKW+72UKDz671bE7YAch2H+U7UQeawwIDAQAB-----END PUBLIC KEY-----";
        // Encrypt with the public key...
        var encrypt = new JSEncrypt();
        encrypt.setPublicKey(pubilc_key);
        var encrypted = encrypt.encrypt(plaintext);

        return encrypted;
    }

    function encrypt_des_key_with_RSA() {
        var des_key = document.getElementById('des_key').value;


        var content = "";
        content = des_key ;

        var encryted_des_key = RSA_encryption(content);

        console.log(encryted_des_key);

        document.getElementById('des_key').value = encryted_des_key;
    }
</script>
</body>
</html>
