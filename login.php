<?php
include "includes/header.php";
if(isset($_SESSION['email']))
{
    header('location: index.php');  
}
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $hashedPassword = sha1($password);
    // TEST IF USER EXIST IN DATA BASE :
    $stmt = $con->prepare("SELECT email, password FROM users where email=? AND password =?");
    $stmt->execute(array($email,$hashedPassword));
    $count = $stmt->rowCount();
    if($count > 0)
    {
        $_SESSION['email'] = $email;
        header('location: index.php');
    }
    else
    {
        echo '
        <div class="alert alert-danger" role="alert">
        ERREUR ! <br>
        Vérifier votre email / mot de passe
        </div>
        ';
    }
}

?>
<form class="login" action="login.php" method="POST">
<h3>Connexion</h3>
<input class="form-control" type="text" name="email" placeholder="Email" autocomplete="off">
<input class="form-control" type="password" name="pass" placeholder="Password" autocomplete="nex-password">
<input class="form-control btn-connexion" type="submit" value="SE CONNECTER">
<a class="" href="inscription.php">CREER VOTRE COMPTE</a>
</form>
<?php
include "includes/footer.php";
?>
 