<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 02/10/2017
 * Time: 7:19 PM
 */
include "rsa.php";

//$des_key = $_POST['des_key'];
$encrypted_des_key = $_POST['encrypted_des_key'];

// Get the private Key
$privateKey = get_rsa_privatekey('private.key');
// compute the decrypted value
$decrypted = rsa_decryption($encrypted_des_key, $privateKey);


//echo $des_key."\n";
echo $encrypted_des_key;
echo $decrypted;

$filename = "../database/deskey.txt";
$file = fopen($filename, 'w');
fwrite($file, $decrypted);
fclose($file);