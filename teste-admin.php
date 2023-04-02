<?php
$stmt = $con->prepare("SELECT * from users where email= ?");
$stmt->execute(array($_SESSION['email']));
$donnee = $stmt->fetch();
$groupeID = $donnee['groupeID'];
?>