<?php
include 'header-admin.php';
?>

<div class="container-page">
<div class="header">
    <div class="container-title">
        <h2>Ajouter Un Client</h2>
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
     $hashedpassword = sha1($password);
    if(empty($email) || empty($username) || empty($nom) || empty($prenom) || empty($password))
    {
        echo '
        <div class="alert alert-danger" role="alert">
        Vous devez remplire les champs avec ( * )
        </div>
        ';
    }
    else
    {
        // TEST IS USER IS ALREADY EXIST :
        // TEST BY EMAIL :
        $stmt = $con->prepare("SELECT email FROM users where email= ?");
        $stmt->execute(array($email));
        $count1 = $stmt->rowCount();
        // TEST BY USERNAME :
        $stmt = $con->prepare("SELECT username FROM users where username= ?");
        $stmt->execute(array($username));
        $count2 = $stmt->rowCount();
        if($count1 != 0 || $count2 !=0)
        {
            if($count1 != 0 && $count2 != 0)
            {
                echo '
                <div class="alert alert-danger" role="alert">
                ERREUR ! <br>
                Email et username utilisé par un autre client
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
                   Email utilisé par un autre client
                   </div>
                   ';
                }
                if($count2 > 0)
                {
                echo '
                <div class="alert alert-danger" role="alert">
                ERREUR ! <br>
                Username utilisé par un autre client
                </div>
                ';
                }
            }
        }
        else
        {
            $stmt2 = $con->prepare("INSERT INTO users(email,password,username,nom,prenom) VALUES (?,?,?,?,?)");
            $stmt2->execute(array($email,$hashedpassword,$username,$nom,$prenom));
             echo '
             <div class="alert alert-success" role="alert">
              Vouz avez ajouté le client avec succés
              </div>
              ';
        }
    }
        
}
?>

<form class="modify" action="addClient.php" method="POST">
<input class="form-control" type="email" name="email" placeholder="Email *" autocomplete="off" required>
<input class="form-control" type="text" name="username" placeholder="Username *" autocomplete="off" required>
<input class="form-control" type="text" name="password" placeholder="password *" autocomplete="off" required>
<input class="form-control" type="text" name="nom" placeholder="Nom *" autocomplete="off" required>
<input class="form-control" type="text" name="prenom" placeholder="Prenom *" autocomplete="off" required>
<input class="form-control btn-enregistrer" class="form-control"  type="submit" value="Ajouter Le Client" required>
</form>

</div>
</div>
<?php
include 'footer-admin.php';
?>