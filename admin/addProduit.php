<?php
include 'header-admin.php';
?>


<div class="container-page">
<div class="header">
    <div class="container-title">
        <h2>Ajouter Un Produit</h2>
    </div>
</div>
<div class="body">

<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $nomProduit = $_POST['produitNom'];
    $prixProduit = $_POST['produitPrix'];
    $descriptionProduit = $_POST['produitDescription'];
    $categorieProduit = $_POST['categorie'];
    $imageProduit = $_FILES['image']['name'];
    $quantiteProduit = $_POST['produitQuantite'];
    if(empty($nomProduit) || empty($prixProduit) || empty($imageProduit) || empty($quantiteProduit))
    {
        echo '
        <div class="alert alert-danger" role="alert">
        Vous devez remplire les champs avec ( * )
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
                   Vous devez donné une prix > 0 <br>
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
                  Vous devez donné une prix > 0 <br>
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
               // TEST IF PRODUCT IS ALREADY EXIST :
               $stmt = $con->prepare('SELECT produitNom FROM produits where produitNom=?');
               $stmt->execute(array($nomProduit));
               $nbr = $stmt->rowCount();
               if($nbr != 0)
               {
                echo '
                <div class="alert alert-danger" role="alert">
                Le produit se trouve dejà dans le stock
                </div>
                ';
               }
               else
               {
                $fichierTempo = $_FILES['image']['tmp_name'];
                move_uploaded_file($fichierTempo,'imagesProduits/' . $imageProduit);
                $stmt = $con->prepare('INSERT INTO produits(produitNom,produitPrix,produitDescription,produitCategorie,image,quantite) VALUES(?,?,?,?,?,?)');
                $stmt->execute(array($nomProduit,$prixProduit,$descriptionProduit,$categorieProduit,$imageProduit,$quantiteProduit));
                echo '
                  <div class="alert alert-success" role="alert">
                   Vouz avez ajouté le produit avec succés
                  </div>
                  ';
               }
           }
    }
}   
?>

<form class="modify" action="addProduit.php" method="POST" enctype="multipart/form-data">
<input class="form-control" type="text" name="produitNom" placeholder="Nom de Produit *" autocomplete="off" required>
<input class="form-control" type="text" name="produitPrix" placeholder="Prix de Produit *" autocomplete="off" required>
<input class="form-control" type="text" name="produitDescription" placeholder="Description de produit" autocomplete="off">
<label>Catégorie de Produit * : </label>
<select name="categorie" class="form-control form-control-lg" required>
  <option value="Téléphones" >Téléphones</option>
  <option value="Tablettes">Tablettes</option>
  <option value="Ordinateurs">Ordinateurs</option>
  <option value="Télévisions">Télévisions</option>
  <option value="Accessoires-téléphones">Accessoires téléphones</option>
</select>
<label>Photo 1 de Produit * : </label>
<input class="form-control" type="file" name="image" required>
<input class="form-control" type="text" name="produitQuantite" placeholder="Quantité de produit *" autocomplete="off" required>
<input class="form-control btn-enregistrer" class="form-control"  type="submit" value="Ajouter Le Produit">
</form>

</div>
</div>


<?php
include 'footer-admin.php';
?>