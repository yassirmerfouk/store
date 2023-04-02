<?php 
include 'header-admin.php';
?>

<div class="container-page">
<div class="header">
        <div class="container-title">
            <h2>Changer Les informations de produit</h2>
        </div>
</div>
<div class="body">

<?php
if(!isset($_GET['produitID']) || $_GET['produitID'] == 0)
{
    echo '
    <div class="alert alert-danger" role="alert">
     Vouz devez avoir ID de produit <br>
     Retour au tableau de produit
     </div>
    ';
}
else
{
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $idProduit = $_POST['id'];
        $nomProduit = $_POST['produitNom'];
        $prixProduit = $_POST['produitPrix'];
        $descriptionProduit = $_POST['produitDescription'];
        $imageProduit = $_FILES['image']['name'];
        $quantiteProduit = $_POST['produitQuantite'];
        if(empty($nomProduit) || empty($prixProduit) || empty($quantiteProduit))
        {
           echo '
           <div class="alert alert-danger" role="alert">
           Vous devez remplire les champs avec ( * )
           </div>
           ';
        }
        else
        {
            // TEST IF THE NEW NAME OF PRODUCT IS USED BY AN OTHER CLIENT :
            // SELECT TABLE NOM PRODUIT :
            $stmt = $con->prepare('SELECT produitNom FROM produits WHERE produitNom=? AND produitID!=?');
            $stmt->execute(array($nomProduit,$idProduit));
            $nbr = $stmt->rowCount();
            if($nbr != 0)
            {
                echo '
                <div class="alert alert-danger" role="alert">
                 Vous devez utilisé un autre nom pour votre produit
                </div>
                ';
            }
            else
            {
                $prixProduit = (int)$prixProduit;
                $quantiteProduit = (int)$quantiteProduit;
               if($prixProduit <= 0 || $quantiteProduit <=0)
               {
                  if($prixProduit <=0 && $quantiteProduit <=0)
                  {
                   echo '
                   <div class="alert alert-danger" role="alert">
                   Vous devez donné un prix > 0 <br>
                   et une quantité > 0
                   </div>
                   ';
                  }
                 else
                 {
                    if($prixProduit <=0)
                    {
                      echo '
                      <div class="alert alert-danger" role="alert">
                      Vous devez donné un prix > 0 <br>
                      </div>
                      ';
                    }
                    if($quantiteProduit <= 0)
                    {
                      echo '
                     <div class="alert alert-danger" role="alert">
                      Vous devez donné une quanité > 0 <br>
                      </div>
                     ';
                    }
                 }
                }
                else
                {
                    if(empty($imageProduit))
                    {
                      $stmt = $con->prepare('UPDATE produits SET produitNom=? ,produitPrix=? ,produitDescription=?, quantite=? WHERE produitID=?');
                      $stmt->execute(array($nomProduit,$prixProduit,$descriptionProduit,$quantiteProduit,$idProduit));
                    }
                    else
                    {
                        $fichierTempo = $_FILES['image']['tmp_name'];
                        move_uploaded_file($fichierTempo,'imagesProduits/' . $imageProduit);
                        $stmt = $con->prepare('UPDATE produits SET produitNom=? ,produitPrix=? ,produitDescription=?,image=? ,quantite=? WHERE produitID=?');
                        $stmt->execute(array($nomProduit,$prixProduit,$descriptionProduit,$imageProduit,$quantiteProduit,$idProduit));
                    }
                    echo '
                    <div class="alert alert-success" role="alert">
                     Vouz avez changé les informations de produit avec succès
                    </div>
                    ';
                }
            }
        }
    }
?>    
    <?php
    $produitID = $_GET['produitID'];
    $stmt = $con->prepare('SELECT * FROM produits WHERE produitID=?');
    $stmt->execute(array($produitID));
    $produit = $stmt->fetch();
 ?>
 
 <form class="modify" action="modifyProduit.php?produitID=<?php echo $produit['produitID'] ?>" method="POST" enctype="multipart/form-data">
 <label>Le ID de produit est : <?php echo $produit['produitID'] ?></label> <br> <br>
 <input class="form-control" type="hidden" name="id" value="<?php echo $produit['produitID'] ?>" >
 <label>Nouveau Nom * : </label>
 <input class="form-control" type="text" name="produitNom" value="<?php echo $produit['produitNom']  ?>" autocomplete="off" required>
 <label>Nouveau Prix * : </label>
 <input class="form-control" type="text" name="produitPrix" value="<?php echo $produit['produitPrix']  ?>" autocomplete="off" required>
 <label>Nouveau Description : </label>
 <input class="form-control" type="text" name="produitDescription" value="<?php echo $produit['produitDescription']  ?>" autocomplete="off">
 <label>La catégorie de produit est : <?php echo $produit['produitCategorie'] ?></label> <br> <br>
 <label>Nouveau Photo : </label>
 <input class="form-control" type="file" name="image">
 <input class="form-control" type="text" name="produitQuantite" value="<?php echo $produit['quantite']  ?>" autocomplete="off" required>
 <input class="form-control btn-enregistrer" class="form-control"  type="submit" value="Modifier Le Produit">
 </form>  

<?php 
}
?>

</div>
</div>

<?php 
include 'footer-admin.php';
?>