<?php
include 'includes/header.php';
if(!isset($_SESSION['email']))
{
    header('location: index.php');
}
else
{
    // TEST : IF USER(ADMIN) :
    if($groupeID == 1)
    {
        header('location: admin/profileAdmin.php');
    }
}
?>

<div class="container-modify-profile">
<div class="header">
    <div class="container">
        <h1>Modifier votre profile</h1>
    </div>
</div>
<div class="body">

<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
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
        $stmt = $con->prepare('SELECT UserID FROM users WHERE email=?');
        $stmt->execute(array($_SESSION['email']));
        $donnee = $stmt->fetch();
        // TEST IF THE NEW EMAIL AND USERNAME ARE USED BY AN OTHER CLIENT :
        // SELECT TABLE EMAILS :
        $stmt = $con->prepare('SELECT email FROM users WHERE email=? AND UserID !=?');
        $stmt->execute(array($email,$donnee['UserID']));
        $nbr1 = $stmt->rowCount();
        // SELECT TABLE USERNAMES :
        $stmt = $con->prepare('SELECT username FROM users WHERE username=? AND UserID !=?');
        $stmt->execute(array($username,$donnee['UserID']));
        $nbr2 = $stmt->rowCount();
        // TESTS : 
        if($nbr1 != 0 || $nbr2 != 0)
        {
            if($nbr1 !=0 && $nbr2 !=0)
            {
                echo '
                <div class="alert alert-danger" role="alert">
                 Vous devez utilisé un autre email et un autre username
                </div>
                ';
            }
            else
            {
                if($nbr1 != 0)
                {
                    echo '
                    <div class="alert alert-danger" role="alert">
                     Vous devez utilisé un autre email
                     </div>
                    ';
                }
                if($nbr2 != 0)
                {
                    echo '
                    <div class="alert alert-danger" role="alert">
                     Vous devez utilisé un autre username
                     </div>
                    ';
                }
            }
        }
        else
        {
            if(empty($password))
            {
                $stmt = $con->prepare('UPDATE users SET email=? ,username=? ,nom=? ,prenom=? WHERE email=?');
                $stmt->execute(array($email,$username,$nom,$prenom,$_SESSION['email']));
                $_SESSION['email'] = $email;
            }
            else
            {
                $hashedpassword = sha1($password);
                $stmt = $con->prepare('UPDATE users SET email=? ,username=? ,password=? ,nom=? ,prenom=? WHERE email=?');
                $stmt->execute(array($email,$username,$hashedpassword,$nom,$prenom,$_SESSION['email']));
                $_SESSION['email'] = $email;
            }
            echo '
                <div class="alert alert-success" role="alert">
                Vous avez changé vos informations avec succès
                </div>
                ';
        }
    } 
}
?>

<?php 
$stmt = $con->prepare('SELECT * FROM users WHERE email=?');
$stmt->execute(array($_SESSION['email']));
$client = $stmt->fetch();
?>

<form class="modifyProfile" action="profile.php" method="POST">
 <label>Nouveau Email * : </label>
<input class="form-control" type="email" name="email" value="<?php echo $client['email']?>" autocomplete="off">
<label>Nouveau Username * : </label>
<input class="form-control" type="text" name="username" value="<?php echo $client['username']?>" autocomplete="off">
<label>Nouveau Password  : </label>
<input class="form-control" type="text" name="password" autocomplete="off">
<label>Nouveau Nom * : </label>
<input class="form-control" type="text" name="nom" value="<?php echo $client['nom']?>" autocomplete="off">
<label>Nouveau Prenom * : </label>
<input class="form-control" type="text" name="prenom" value="<?php echo $client['prenom']?>" autocomplete="off">
<input class="form-control btn-enregistrer" class="form-control"  type="submit" value="Enregistrer">
</form>

</div>
</div>

<?php
include 'includes/footer.php';
?>