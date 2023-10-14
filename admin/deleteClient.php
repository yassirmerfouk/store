<?php
$UserID = $_GET['UserID'];
include '../connect.php';
$stmt = $con->prepare('DELETE FROM users WHERE UserID=?');
$stmt->execute(array($UserID));
header('location:clients.php');
?>
