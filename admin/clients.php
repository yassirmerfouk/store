<?php
include 'header-admin.php';
?>
<div class="container-page">
    <div class="header">
        <div class="container-title">
            <h2>Gérer les Clients</h2>
        </div>
    </div>
    <div class="body">
    <div class="container-btn">
    <a href="addClient.php" class="btn btn-primary" style="background-color: #171c24;"> Ajouter Un Client</a>
    </div>
<table class="table-client">
<thead>
<tr>
    <th>ID</th>
    <th>USERNAME</th>
    <th>NOM</th>
    <th>PRENOM</th>
    <th>EMAIL</th>
    <th>CONTROLE</th>
</tr>
</thead>
<tbody>
<?php
$stmt = $con->prepare('SELECT * FROM users WHERE groupeID != 1');
$stmt->execute();
?>
<?php while($clients = $stmt->fetch()){?>
<tr>
    <td><?php echo $clients['UserID'] ?></td>
    <td><?php echo $clients['username'] ?></td>
    <td><?php echo $clients['nom'] ?></td>
    <td><?php echo $clients['prenom'] ?></td>
    <td><?php echo $clients['email'] ?></td>
    <td>
        <a href="modifyClient.php?UserID=<?php echo $clients['UserID']; ?>"class="btn btn-primary"> Modifier</a>
        <a onclick="return confirm('Vous-êtes sûre?')" href="deleteClient.php?UserID=<?php echo $clients['UserID']; ?>"class="btn btn-danger confirmation">Supprimer</a>
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