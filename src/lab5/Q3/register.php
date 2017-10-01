<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 12:41 AM
 */

$inputname = $_POST['name'];
$inputpsd = $_POST['password'];

$filename = 'user.txt';

$exist = 0;

foreach (file($filename) as $line) {
    list($username, $userpsd) = explode(',', $line);
    if ($inputname == $username) {
        $exist = 1;
        break;
    }
}

if ($exist == 1) {
    echo "<p>User name :$inputname, has exisr</p>
<p>Change your username with <a href='register.html'>link</a> </p>";
} else {

    $file = fopen($filename, 'a');

    fwrite($file, $inputname.','.$inputpsd."\n");

    fclose($file);

    echo "register success! 
<p>Go login with <a href='login.html'>link</a></p>
<p>Go register with <a href='register.html'>link</a></p>";
}