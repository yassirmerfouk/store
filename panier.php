<?php
include 'includes/header.php';
if(!isset($_SESSION['email']))
{
  header('location:index.php');
}
?>
<div class="container-page">
          <div class="header">
          <div class="container-title">
             <h2>Votre Panier</h2>
          </div>
          </div>
         <div class="body">
<?php
     if(isset($_GET['produitID']))
     {
        $id = $_GET['produitID'];
        // tableau pour stocker les informations de chaque produit de panier :
         $infosProduit = array(
          'UserID' => '',
          'produitID' => '',
          'produitNom' => '',
          'image' => '',
          'produitPrix' => '',
         );
        // Select id user et l'ajouté dans le tableau de panier : 
        $stmt = $con->prepare('SELECT UserID FROM users WHERE email=?');
        $stmt->execute(array($_SESSION['email']));
        $donnee = $stmt->fetch();
        $infosProduit['UserID'] = $donnee['UserID'];
        // Select infos de produit acheté :
        $stmt = $con->prepare('SELECT produitID,produitNom,image,produitPrix FROM produits WHERE produitID=?');
        $stmt->execute(array($id));
        $donnee = $stmt->fetch();
        $infosProduit['produitID'] = $donnee['produitID'];
        $infosProduit['produitNom'] = $donnee['produitNom'];
        $infosProduit['image'] = $donnee['image'];
        $infosProduit['produitPrix'] = $donnee['produitPrix'];
        // teste si le produits deja existe dans le panier de l'etulisateur :
        $stmt = $con->prepare('SELECT UserID,produitID FROM panier WHERE UserID=? AND produitID=?');
        $stmt->execute(array($infosProduit['UserID'],$infosProduit['produitID']));
        $count = $stmt->rowCount();
        if($count == 0)
        {
           $stmt = $con->prepare('INSERT INTO panier(UserID,produitID,produitNom,image,produitPrix) VALUES (?,?,?,?,?)');
           $stmt->execute(array($infosProduit['UserID'],$infosProduit['produitID'],$infosProduit['produitNom'],$infosProduit['image'],$infosProduit['produitPrix']));
        }
        header('location:'. $_SERVER['HTTP_REFERER']);
     }
     else
     {
       // select user ID :
        $stmt = $con->prepare('SELECT UserID FROM users WHERE email=?');
        $stmt->execute(array($_SESSION['email']));
        $donnee = $stmt->fetch();
        // select liste de produits de panier de client :
        $stmt = $con->prepare('SELECT * FROM panier WHERE UserID=?');
        $stmt->execute(array($donnee['UserID']));
        if($stmt->rowCount() == 0)
        {
           ?>
               <div class="alert alert-warning" role="alert">
                  Votre panier est vide
               </div>
           <?php
        }
        else
        {
           ?>
                 <table class="table-panier">
              <thead>
                  <tr>
                      <th>Nom Produit</th>
                      <th>Image Produit</th>
                      <th>Prix Produit</th>
                      <th>Controle</th>   
                  </tr>    
                  <tbody>
                      <?php
                        $prixTotale = 0;
                        while($table = $stmt->fetch())
                        {
                         
                      ?>
                  <tr>
                      <td><?php echo $table['produitNom'] ?></td>
                      <td><img src="admin/imagesProduits/<?php echo $table['image'] ?>" width=150 height=150></td>
                      <td><?php echo $table['produitPrix'] ?> Dhs</td>
                      <td>
                        <a onclick="return confirm('Vous-êtes sûre?')" href="deleteProduitPanier.php?UserID=<?php echo $table['UserID']?>&produitID=<?php echo $table['produitID']?>" class="btn btn-danger">Supprimer</a>
                      </td>   
                  </tr> 
                      <?php
                          $prixTotale += $table['produitPrix'];
                        }
                      ?> 
                      <tr>
                        <td></td>
                        <td></td>
                        <td style="font-weight: bold">Totale : </td>
                        <td style="font-weight: bold;color: red;font-size: 23px"><?php echo $prixTotale ?> Dhs</td>
                      </tr>
                  </tbody>
               </thead>
              </table>

           <?php
        }
     }
?>

</div>
</div>
<?php
 include 'includes/footer.php';
?>


