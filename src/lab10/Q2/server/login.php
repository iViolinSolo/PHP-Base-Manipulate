<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 12:36 PM
 */

session_start();

$filename = '../database/users.txt';

$inputname = $_POST['user_name'];
$inputpsd = $_POST['user_psd'];


$exist = 0;
$targetpsd = '';

foreach (file($filename) as $line) {
    list($username, $userpassword) = explode(',', $line);

    if ($username == $inputname) {
        $exist = 1;
        $targetpsd = $userpassword;
        break;
    }
}

if ($exist == 0) {
    echo "<p>User name $inputname not exists in dbs, choose another one!</p>
<p>Login Fail!</p>";
} else {

    if ($targetpsd == $inputpsd."\n") {
        echo "<p>Login success!</p>";
        $_SESSION['login'] = "YES";
        header('Location: ../client/content.php');
    } else {
        echo "Password not matched!";
    }

    echo "<br/>Go <a href='../client/login.html'>back</a> to login";

}
