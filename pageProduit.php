<?php
include "includes/header.php";
?>

<div class="container-page">
<div class="body">
<?php
if(!isset($_GET['produitID']) || $_GET['produitID'] == 0)
{
    ?>
        <div class="alert alert-danger" role="alert">
             ERREUR ! <br>
            Vous devez avoir le ID de produit
            </div>
    <?php
}
else
{
    $idproduit = $_GET['produitID'];
    // TESTE SI Le produit EXISTE DANS LE SITE : 
    $stmt = $con->prepare('SELECT produitCategorie FROM produits WHERE produitID=?');
    $stmt->execute(array($idproduit));
    $nbr = $stmt->rowCount();
    if($nbr == 0)
    {
       ?>
       <div class="alert alert-danger" role="alert">
             ERREUR ! <br>
            Pas de produit avec cet ID
            </div>
       <?php
    }
    else
    {
        $stmt = $con->prepare('SELECT * FROM produits WHERE produitID=?');
        $stmt->execute(array($idproduit));
        $produit = $stmt->fetch();
        ?>
             <div class="infosProduit">
             <div class="imageProduit">
             <img src="admin/imagesProduits/<?php echo $produit['image'] ?>">
             </div>
             <div class="infos">
                 <div>
                 <p class="title-product">Nom : <?php echo $produit['produitNom'] ?></p>
                 <p>Catégorie : <?php echo $produit['produitCategorie'] ?></p>
                 <p><?php echo $produit['produitDescription'] ?></p>
                 <p>Prix : <?php echo $produit['produitPrix'] ?> Dhs</p>
                  </div>
                  <div class="div-button">
                      <a 
                      <?php
                      if(!isset($_SESSION['email']))
                         { 
                         ?>
                         onclick="return confirm('Vouz devez inscrire au site au premier !!!')"
                         <?php
                         }
                         else
                         {
                             ?>
                              onclick="return confirm('Ajouter le produit dans le panier ?')" href="panier.php?produitID=<?php echo $produit['produitID'] ?>"
                              <?php
                         }
                      ?>
                      class="button">J'achète</a>
                  </div>
             </div>
             </div>
             <div class="title">
               <h3>Autres produits de même catégorie<h3>
             </div>
             <div class="products" style="background-color: #f8f9fa;">
                 <?php
                 $stmt = $con->prepare('SELECT * FROM produits WHERE produitCategorie=? AND produitID!=?');
                 $stmt->execute(array($produit['produitCategorie'],$produit['produitID']));
                 $tableproduits = $stmt->fetchAll();
                 $i = count($tableproduits) - 1;
                 $count = 0;
                 while($i >= 0 && $count <4)
                  {
                     ?>
                   <div class="card">
                   <img src="admin/imagesProduits/<?php echo $tableproduits[$i]['image']?>" style="width:100%;height:298px">
                   <h1><?php echo $tableproduits[$i]['produitNom']?></h1>
                   <p class="price"><?php echo $tableproduits[$i]['produitPrix']?> DHS</p>
                   <p><button onclick="window.location.href='pageProduit.php?produitID=<?php echo $tableproduits[$i]['produitID']  ?>'">Infos de produit</button></p>
                   </div>
                   <?php 
                   $count++;
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