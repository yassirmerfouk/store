<?php
include 'includes/header.php';
?>

<div class="container-page">
<div class="header">
<?php
if(($_SERVER['REQUEST_METHOD']!='POST'))
{
    header('location: index.php');
}
else
{
    $searchNom = $_POST['search'];
    ?>
       <div class="container-title">
             <h2>Résultat sur : <?php echo $searchNom ?></h2>
         </div>
         </div>
         <div class="body">
         <div class="products">
    <?php
              $stmt = $con->prepare("SELECT * FROM produits WHERE produitNom LIKE '%$searchNom%' ");
              $stmt->execute();
              while($produits = $stmt->fetch())
          {
        ?>
            <div class="card">
            <img src="admin/imagesProduits/<?php echo $produits['image']?>" style="width:100%;height:298px">
            <h1><?php echo $produits['produitNom']?></h1>
            <p class="price"><?php echo $produits['produitPrix']?> DHS</p>
            <p><button onclick="window.location.href='pageProduit.php?produitID=<?php echo $produits['produitID']  ?>'">Infos de produit</button></p>
            </div>
        <?php 
          }
        ?>  
    <?php    
}
?>

</div>
</div>
<?php
include 'includes/footer.php';
?>