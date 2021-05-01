<?php
session_start();

// Connexion à la BDD
require "Fonction.php";
$bdd=connect();



$id =$_GET["suppr"];


$sql="DELETE FROM produit where id=$id";

$resultat=$bdd->exec($sql);
header("location:AccueilAdmin.php");


?>

