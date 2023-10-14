<?php
$produitID = $_GET['produitID'];
include '../connect.php';
$stmt = $con->prepare('DELETE FROM produits WHERE produitID=?');
$stmt->execute(array($produitID));
header('location:produits.php');
?>