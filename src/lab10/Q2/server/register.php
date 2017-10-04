<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 12:36 PM
 */

$filename = '../database/users.txt';

$inputname = $_POST['user_name'];
$inputpsd = $_POST['user_psd'];


$exist = 0;

foreach (file($filename) as $line) {
    list($username, $userpassword) = explode(',', $line);

    if ($username == $inputname) {
        $exist = 1;
        break;
    }
}

if ($exist == 1) {
    echo "<p>User name $inputname has exists in dbs, choose another one!</p>";
} else {

    $file = fopen($filename, 'a');

    $content = $inputname.','.$inputpsd."\n";

    fwrite($file, $content);

    fclose($file);

    echo "<p>Register success!</p>";
}
