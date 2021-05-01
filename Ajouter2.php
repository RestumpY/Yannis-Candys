<?php

include("Fonction.php");
$bdd = connect();

$nom = $_POST["nom"];
$prix = $_POST["prix"];
$photo = basename($_FILES["photo"]["name"]);
$chemin = "Image/".$photo;
move_uploaded_file($_FILES["photo"]["tmp_name"],$chemin);

$sql="INSERT INTO produit(nom,prix,photo) values('$nom','$prix', '$photo')";

$resultat=$bdd->exec($sql);

header("location:Index.php");
?>