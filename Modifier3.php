<?php
session_start();

// Connexion à la BDD
require "Fonction.php";
$bdd=connect();



$id = $_SESSION["id"];
$nom = $_POST["nom"];
$prix = $_POST["prix"];


$photo = basename($_FILES["photo"]["name"]);
$chemin = "Image/".$photo;
move_uploaded_file($_FILES["photo"]["tmp_name"],$chemin);

$id =$_SESSION["id"];

$sql="UPDATE produit set nom='$nom',prix='$prix',photo='$photo' where id=$id";

$resultat=$bdd->exec($sql);

header("location:Index.php");


?>

		