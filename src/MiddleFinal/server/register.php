<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 3:19 PM
 */

$ipt_name = $_POST['user_name'];
$ipt_psd = $_POST['user_psd'];

$filename = '../database/users.txt';

$exist = 0;

foreach (file($filename) as $item) {
    list($username, $password) = explode(',', $item);

    if ($username == $ipt_name) {
        $exist = 1;
        break;
    }
}

if ($exist == 1) {
    echo "username : $ipt_name has registered! plz choose another one
    <p>Go Register with <a href='../client/register.html'>Link</a></p>
    <p>Go Login with <a href='../client/login.html'>Link</a></p>";
} else {
    $content = $ipt_name.",".$ipt_psd."\n";

    $file = fopen($filename, 'a');

    fwrite($file, $content);

    fclose($file);

    echo "Register success!
    <p>Go Register with <a href='../client/register.html'>Link</a></p>
    <p>Go Login with <a href='../client/login.html'>Link</a></p>";
}
