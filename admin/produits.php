<?php
include 'header-admin.php';
?>


<div class="container-page">
<div class="header">
    <div class="container-title">
        <h2>Gérer les Produits</h2>
    </div>
</div>
<div class="body">
<div class="container-btn">
    <a href="addProduit.php" class="btn btn-primary" style="background-color: #171c24;"> Ajouter Un Produit</a>
    </div>

    <table class="table-produit">
<thead>
<tr>
    <th>ID Produit</th>
    <th>NOM</th>
    <th>Prix</th>
    <th>Catégorie</th>
    <th>Image</th>
    <th>Quantité</th>
    <th>CONTROLE</th>
</tr>
</thead>
<tbody>

<?php
$stmt = $con->prepare('SELECT * FROM produits');
$stmt->execute();
?>

<?php while($produits = $stmt->fetch()){?>
<tr>
    <td><?php echo $produits['produitID'] ?></td>
    <td><?php echo $produits['produitNom'] ?></td>
    <td><?php echo $produits['produitPrix'] ?></td>
    <td><?php echo $produits['produitCategorie'] ?></td>
    <td><img src="imagesProduits/<?php echo $produits['image'] ?>" width="100" height="100"></th>
    <td><?php echo $produits['quantite'] ?></td>
    <td>
        <a href="modifyProduit.php?produitID=<?php echo $produits['produitID']  ?>"class="btn btn-primary"> Modifier</a>
        <a onclick="return confirm('Vous-êtes sûre?')" href="deleteProduit.php?produitID=<?php echo $produits['produitID']; ?>"class="btn btn-danger confirmation">Supprimer</a>
    </td>
</tr>
<?php } ?>
</tbody>
</table>

</div>
</div>


<?php
include 'footer-admin.php';
?>