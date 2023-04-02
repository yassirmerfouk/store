<?php
include "includes/header.php";
?>

<div class="container-page">
<div class="header">

<?php

if(!isset($_GET['categorieName']) || empty($_GET['categorieName']))
{
    ?>
         <div class="container-title">
             <h2>Découvrez nos catégories</h2>
         </div>
         </div>
         <div class="body">
         <div class="div-categorie">

         <div class="card-categorie">
            <img src="images/categorieTV.jpg" style="width:100%;height:298px">
            <h1>Télévisions</h1>
            <p><button onclick="window.location.href='categories.php?categorieName=Télévisions'">Voir la categorie</button></p>
         </div>
         <div class="card-categorie">
            <img src="images/categoriePHONE.jpg" style="width:100%;height:298px">
            <h1>Téléphones</h1>
            <p><button onclick="window.location.href='categories.php?categorieName=Téléphones'">Voir la categorie</button></p>
         </div>
         <div class="card-categorie">
            <img src="images/categoriePC.jpg" style="width:100%;height:298px">
            <h1>Ordinateurs</h1>
            <p><button onclick="window.location.href='categories.php?categorieName=Ordinateurs'">Voir la categorie</button></p>
         </div>
         <div class="card-categorie">
            <img src="images/categorieTABLETTE.jpg" style="width:100%;height:298px">
            <h1>Tablettes</h1>
            <p><button onclick="window.location.href='categories.php?categorieName=tablettes'">Voir la categorie</button></p>
         </div>
         <div class="card-categorie">
            <img src="images/categorieACCESSOIREPHONE.jpg" style="width:100%;height:298px">
            <h1>Accessoires téléphones</h1>
            <p><button onclick="window.location.href='categories.php?categorieName=Accessoires-téléphones'">Voir la categorie</button></p>
         </div>

        </div>
    <?php
}
else
{
    $categorie = $_GET['categorieName'];
    // TESTE SI LA CATEGORIE EXISTE DANS LE SITE : 
    $stmt = $con->prepare('SELECT produitCategorie FROM produits WHERE produitCategorie=?');
    $stmt->execute(array($categorie));
    $nbr = $stmt->rowCount();
    if($nbr == 0)
    {
        ?>
            <div class="container-title">
                <h2>ERREUR</h2>
            </div>
            </div>
            <div class="body">
            <div class="alert alert-danger" role="alert">
             ERREUR ! <br>
            La catégorie demandé n'existe pas dans le store
            </div>
        <?php
    }
    else
    {
        $stmt = $con->prepare('SELECT * FROM produits WHERE produitCategorie=?');
        $stmt->execute(array($categorie));
        ?>
        <div class="container-title">
                <h2><?php echo $categorie ?></h2>
            </div>
            </div>
        <div class="body">
         <div class="products">
        <?php
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
        <?php   
    }
}

?>

</div>
</div>

<?php
include "includes/footer.php";
?>