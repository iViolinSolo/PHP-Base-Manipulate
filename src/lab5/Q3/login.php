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
$target_psd = '';

foreach (file($filename) as $line) {
    list($username, $userpsd) = explode(',', $line);
    if ($inputname == $username) {
        $exist = 1;
        $target_psd = $userpsd;
        break;
    }
}

if ($exist == 0) {
    echo "<p>User name :$inputname, not exist! ERROR!</p>
<p>Change your username with <a href='register.html'>link</a> </p>";
} else {

    if ($inputpsd."\n" == $target_psd) {
        echo 'Login success!';
    }else {
        echo 'password not right!';
    }

    echo "
<p>Go login with <a href='login.html'>link</a></p>
<p>Go register with <a href='register.html'>link</a></p>";
}