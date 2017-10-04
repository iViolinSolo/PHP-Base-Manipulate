<?php
session_start();
?>

<html>
<body>

<?php
//Receive username from clint side
$entered_username = $_POST['username'];
//Receive password from client side
$entered_password = $_POST['password'];

if($entered_username=="USR1" & $entered_password == "PWD1"){
    $_SESSION['login'] = "YES";
    header('Location: content.php');
}else{
    echo "Wrong Username or Password!";
}

echo "<br/>Go <a href='http://titan.csit.rmit.edu.au/~e23700/Lab10/demo1/login.html'>back</a> to login";

?>


</body>
</html>
