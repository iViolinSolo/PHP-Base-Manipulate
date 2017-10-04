<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 02/10/2017
 * Time: 7:19 PM
 */

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../client/login.html");
}
$username = $_SESSION['user_name'];


include "rsa.php";

//$des_key = $_POST['des_key'];
$encrypted_des_key = $_POST['des_key'];

// Get the private Key
$privateKey = get_rsa_privatekey('private.key');
// compute the decrypted value
$decrypted = rsa_decryption($encrypted_des_key, $privateKey);

//echo $encrypted_des_key;
//echo $decrypted;

$filename = "../database/deskey.txt";
$file = fopen($filename, 'w');
fwrite($file, $username . ',' . $decrypted );
fclose($file);


$_SESSION['des_key'] = $decrypted;
header("Location: ../client/shoppingcart_needed_login.php");