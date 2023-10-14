<?php
    if(isset($_GET['UserID']) && isset($_GET['produitID']))
    {
      include 'connect.php';
      $stmt = $con->prepare('DELETE FROM panier WHERE UserID=? AND produitID=?');
      $stmt->execute(array($_GET['UserID'],$_GET['produitID']));
      header('location: panier.php');
    }
