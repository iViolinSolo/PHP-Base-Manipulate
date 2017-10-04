<?php
session_start();

unset($_SESSION['login']);

echo "You have logged out, you cannot access to the <a href='../client/shoppingcart_needed_login.php'>shoppingcart page</a> right now";

echo "<br/><br/>If you try to access to the content page without login successful, you will be redirect to <a href='../client/login.html'>login.html</a> page";
?>