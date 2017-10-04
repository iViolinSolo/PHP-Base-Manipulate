<?php

include ('des.php');

$key = "this is key";

$message = "this is message";

$encrypted = php_des_encryption($key, $message);

echo $encrypted."\n";

$decrypted = php_des_decryption($key, $encrypted);

echo $decrypted."\n";