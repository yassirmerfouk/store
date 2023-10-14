<?php
session_start();
include '../connect.php';
include '../teste-admin.php';

if(!isset($_SESSION['email']))
{
    header('location: ../index.php');
}
if(isset($_SESSION['email']) && $groupeID != 1)
header('location: ../index.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/styles-admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <title>ADMIN</title>
</head>  
<body>  
<div class="header-container">
<nav>
          <div class="menu-icon">
    <span class="fas fa-bars"></span></div>
    <div class="logo">
    MyStore</div>
    <div class="nav-items">
    <li><a href="../index.php">Accueil Store</a></li>
    <li><a href="../index.php">Accueil</a></li>
    <li><a href="profileAdmin.php">Profile Edit</a></li>
    <li><a href="clients.php">Clients</a></li>
    <li><a href="produits.php">Produits</a></li>
    <li><a href="../logout.php">Logout</a></li>
    </div>
    <div class="search-icon">
      <span class="fas fa-search"></span></div>
      <div class="cancel-icon">
      <span class="fas fa-times"></span></div>
      <form action="#">
        <input type="search" class="search-data" placeholder="Search" required>
        <button type="submit" class="fas fa-search"></button>
      </form>
</nav>
</div>    