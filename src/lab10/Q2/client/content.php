<?php
session_start();
if(!isset($_SESSION['login'])){
    header('Location: login.html');
}
?>

<html>
<body>

<h2>Lab 10 content</h2>

You can reach here only if you login successful.
<br/><br/>
<form action="../server/logout.php" method="POST">
    <button type="submit">Logout</button>
</form>


</body>
</html>