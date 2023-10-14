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
    $username = $_POST['username'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $hashedpassword = sha1($password);
    if(empty($email) || empty($username) || empty($password) || empty($nom) || empty($prenom))
    {
        echo '
            <div class="alert alert-danger" role="alert">
             Vous devez remplire les champs avec ( * )
             </div>
            ';
    }
    else {
    // TEST IS USER IS ALREADY EXIST :
    // SELECT TABLE EMAILS :
    $stmt = $con->prepare("SELECT email FROM users where email= ?");
    $stmt->execute(array($email));
    $count1 = $stmt->rowCount();
    // SELECT TABLE USERNAME :
    $stmt = $con->prepare("SELECT username FROM users where username= ?");
    $stmt->execute(array($username));
    $count2 = $stmt->rowCount();
    if($count1 > 0 && $count2 > 0)
    {
        echo '
        <div class="alert alert-danger" role="alert">
        ERREUR ! <br>
        Vous devez utilisé un autre email et un autre username
        </div>
        ';
    }
    else
    {
        if($count1 > 0)
        {
            echo '
        <div class="alert alert-danger" role="alert">
        ERREUR ! <br>
        Vous devez utilisé un autre email
        </div>
        ';
        }
        else 
        {
            if($count2 > 0)
            {
                echo '
                <div class="alert alert-danger" role="alert">
                ERREUR ! <br>
                Vous devez utilisé un autre username
                </div>
                ';
            }
        else {
               $stmt2 = $con->prepare("INSERT INTO users(email,password,username,nom,prenom) VALUES (?,?,?,?,?)");
               $stmt2->execute(array($email,$hashedpassword,$username,$nom,$prenom));
               echo '
               <div class="alert alert-success" role="alert">
                GOOOOOD <br>
                Inscription avec succès <br>
                Vous pouvez utilisé votre email et mot de passe pour connecter <br>
                </div>
               ';
             }
       }
    }
}
}
?>
<form class="inscription" action="inscription.php" method="POST">
    <h3>Inscription</h3>
    <input class="form-control" type="email" name="email" placeholder="Email *" autocomplete="off" required>
    <input class="form-control" type="password" name="pass" placeholder="Password *" autocomplete="off" required>
    <input class="form-control" type="text" name="username" placeholder="Username *" autocomplete="off" required>
    <input class="form-control" type="text" name="nom" placeholder="Nom *" autocomplete="off" required>
    <input class="form-control" type="text" name="prenom" placeholder="Prenom *" autocomplete="off" required>
    <input class="btn-inscription" type="submit" value="Inscription">
    <a class="" href="login.php">Vous avez déjà un compte?</a>
</form>
<?php
include "includes/footer.php";
?>