<?php

include ('des.php');

$key = "this is key";

$message = "this is message";

$encrypted = php_des_encryption($key, $message);

$decrypted = php_des_decryption($key, $encrypted);