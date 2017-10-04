<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 3:19 PM
 */

session_start();

$ipt_name = $_POST['user_name'];
$ipt_psd = $_POST['user_psd'];

$filename = "../database/users.txt";

$exist = 0;
$target_password = "";

foreach (file($filename) as $item) {
    list($username, $password) = explode(',', $item);

    if ($username == $ipt_name) {
        $exist = 1;
        $target_password = $password;
        break;
    }
}

if ($exist == 0) {
    echo "Can not find user name : $ipt_name! 
    Check your user name
    <p>Go Register with <a href='../client/register.html'>Link</a></p>
    <p>Go Login with <a href='../client/login.html'>Link</a></p>";
} else {
    if($target_password == $ipt_psd."\n") {

        $_SESSION['login'] = "YES";
        $_SESSION['user_name'] = $ipt_name;

        header("Location: ../client/user_enter_des_key.php");

    }else {
        echo "Your username is not matching with your password
    <p>Go Register with <a href='../client/register.html'>Link</a></p>
    <p>Go Login with <a href='../client/login.html'>Link</a></p>";
    }
}