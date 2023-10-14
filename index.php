<?php
include "includes/header.php";
?>

<div class="containerglobal">

<div class="slider">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/s21.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/s21.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/s21.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>

</div>
 
<div class="products">
<?php
   $stmt = $con->prepare('SELECT * FROM produits');
   $stmt->execute();
   $produits = $stmt->fetchAll();
   $i = count($produits) - 1;
   while($i >= 0)
   {
   ?>
      <div class="card">
      <img src="admin/imagesProduits/<?php echo $produits[$i]['image']?>" style="width:100%;height:298px">
      <h1><?php echo $produits[$i]['produitNom']?></h1>
      <p class="price"><?php echo $produits[$i]['produitPrix']?> DHS</p>
      <p><button onclick="window.location.href='pageProduit.php?produitID=<?php echo $produits[$i]['produitID']  ?>'">Infos de produit</button></p>
      </div>
   <?php
   $i--;
   }
?> 
</div>

</div>
<?php
include "includes/footer.php";
?>