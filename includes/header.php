<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Store</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
</head>
<body>
<div class="header-container">
    <?php
      if(!isset($_SESSION['email']))
      {
        echo '
        <nav>
        <div class="menu-icon">
  <span class="fas fa-bars"></span></div>
  <div class="logo">
  MyStore</div>
  <div class="nav-items">
  <li><a href="index.php">Accueil</a></li>
  <li><a href="categories.php">Categories</a></li>
  <li><a href="login.php">Connexion</a></li>
  <li><a href="inscription.php">Inscription</a></li>
  </div>
  <div class="search-icon">
  <span class="fas fa-search"></span></div>
  <div class="cancel-icon">
  <span class="fas fa-times"></span></div>
  <form action="search.php" method="POST">
          <input type="search" class="search-data" name="search" placeholder="Search" required>
          <button type="submit" class="fas fa-search"></button>
        </form>
  </nav>
        ';
      }
      else 
      {
        // TESTER SI L'UTILISTEUR EST UN ADMIN OU NON :
         include 'teste-admin.php';
        // GROUPEID = 1 (ADMIN)
        if($groupeID == 1)
        {
          echo '
          <nav>
          <div class="menu-icon">
    <span class="fas fa-bars"></span></div>
    <div class="logo">
    MyStore</div>
    <div class="nav-items">
    <li><a href="index.php">Accueil</a></li>
    <li><a href="categories.php">Categories</a></li>
    <li><a href="profile.php">Profile Edit</a></li>
    <li><a href="admin/index.php">Admin</a></li>
    <li><a href="logout.php">Logout</a></li>
    </div>
    <div class="search-icon">
    <span class="fas fa-search"></span></div>
    <div class="cancel-icon">
    <span class="fas fa-times"></span></div>
    <form action="search.php" method="POST">
            <input type="search" class="search-data" name="search" placeholder="Search" required>
            <button type="submit" class="fas fa-search"></button>
          </form>
    </nav>
          ';
        }
        // GROUPEID != 1 (NOT ADMIN)
        else 
        {
          echo '
          <nav>
          <div class="menu-icon">
    <span class="fas fa-bars"></span></div>
    <div class="logo">
    MyStore</div>
    <div class="nav-items">
    <li><a href="index.php">Accueil</a></li>
    <li><a href="categories.php">Categories</a></li>
    <li><a href="panier.php">Panier</a></li>
    <li><a href="profile.php">Profile Edit</a></li>
    <li><a href="logout.php">Logout</a></li>
    </div>
    <div class="search-icon">
    <span class="fas fa-search"></span></div>
    <div class="cancel-icon">
    <span class="fas fa-times"></span></div>
    <form action="search.php" method="POST">
            <input type="search" class="search-data" name="search" placeholder="Search" required>
            <button type="submit" class="fas fa-search"></button>
          </form>
    </nav>
          ';
        }
      }  
    ?>
</div>
