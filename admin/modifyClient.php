<?php 
include 'header-admin.php';
?>

<div class="container-page">
<div class="header">
        <div class="container-title">
            <h2>Changer Les informations de client</h2>
        </div>
</div>
<div class="body">

<?php
if(!isset($_GET['UserID']) || $_GET['UserID'] == 0)
{
    echo '
    <div class="alert alert-danger" role="alert">
     Vouz devez avoir ID de client <br>
     Retour au tableau de clients
     </div>
    ';
}
else 
{
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        if(empty($email) || empty($username) || empty($nom) || empty($prenom))
        {
            echo '
            <div class="alert alert-danger" role="alert">
            Vous devez remplire les champs avec ( * )
            </div>
             ';
        }
        else
        {
            // TEST IF THE NEW EMAIL AND USERNAME ARE USED BY AN OTHER CLIENT :
            // SELECT TABLE EMAILS :
            $stmt = $con->prepare('SELECT email FROM users WHERE email=? AND UserID!=?');
            $stmt->execute(array($email,$id));
            $nbr1 = $stmt->rowCount();
            // SELECT TABLE USERNAMES :
            $stmt = $con->prepare('SELECT username FROM users WHERE username=? AND UserID!=?');
            $stmt->execute(array($username,$id));
            $nbr2 = $stmt->rowCount();
            // TESTS : 
            if($nbr1 != 0 || $nbr2 != 0)
            {
                if($nbr1 !=0 && $nbr2 !=0)
                {
                echo '
                <div class="alert alert-danger" role="alert">
                Email et username utilisé par un autre client
                </div>
                ';
                }
                else 
                {
                    if($nbr1 != 0)
                    {
                    echo '
                     <div class="alert alert-danger" role="alert">
                     Email utilisé par un autre client
                     </div>
                    ';
                    }
                    if($nbr2 != 0)
                    {
                    echo '
                    <div class="alert alert-danger" role="alert">
                    Username utilisé par un autre client
                     </div>
                    ';
                    }
                }    
            }
            else 
            {
                if(empty($password))
                {
                    $stmt = $con->prepare('UPDATE users SET email=? ,username=? ,nom=? ,prenom=? WHERE UserID=?');
                    $stmt->execute(array($email,$username,$nom,$prenom,$id));
                }
                else 
                {
                    $hashedpassword = sha1($password);
                    $stmt = $con->prepare('UPDATE users SET email=? ,username=? ,password=? ,nom=? ,prenom=? WHERE UserID=?');
                    $stmt->execute(array($email,$username,$hashedpassword,$nom,$prenom,$id));
                }
                       echo '
                       <div class="alert alert-success" role="alert">
                       Vous avez changé les informations de client avec succès
                       </div>
                       ';
            }
        }
    }
   
?>
<?php
   $userID = $_GET['UserID'];
   $stmt = $con->prepare('SELECT * FROM users WHERE UserID=?');
   $stmt->execute(array($userID));
   $client = $stmt->fetch();
?>

        <form class="modify" action="modifyClient.php?UserID=<?php echo $client['UserID'] ?>" method="POST">
        <label>Le ID de client est : <?php echo $client['UserID'] ?></label> <br> <br>
        <input class="form-control" type="hidden" name="id" value="<?php echo $client['UserID'] ?>" >
        <label>Nouveau Email * : </label>
        <input class="form-control" type="email" name="email" value="<?php echo $client['email'] ?>" autocomplete="off" required>
        <label>Nouveau Username * : </label>
        <input class="form-control" type="text" name="username" value="<?php echo $client['username'] ?>" autocomplete="off" required>
        <label>Nouveau Password : </label>
        <input class="form-control" type="text" name="password" value="" autocomplete="off" >
        <label>Nouveau Nom * : </label>
        <input class="form-control" type="text" name="nom" value="<?php echo $client['nom'] ?>" autocomplete="off" required>
        <label>Nouveau Prenom * : </label>
        <input class="form-control" type="text" name="prenom" value="<?php echo $client['prenom'] ?>" autocomplete="off" required>
        <input type="submit" class="form-control btn-enregistrer" class="form-control" value="Modifier Le Client">
        </form>


<?php    
}
?>

</div>
</div>

<?php 
include 'footer-admin.php';
?>