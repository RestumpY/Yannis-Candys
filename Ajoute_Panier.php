<?php
session_start();        //démarrer une session

$id = $_GET["panier"];


if(!isset($_SESSION['panier']))
{
$_SESSION['panier'] =array(); // création de la variable de session
}

if(isset($_SESSION['panier'][$id]))
{
$_SESSION['panier'][$id]++ ; //ajoute 1 à la quantité
}
else
{
$_SESSION['panier'][$id]=1 ; // sinon met un dans la quantité
}


// Nous allons maintenant créer un message permettant de prévenir l’utilisateur que son produit a bien été ajouté au panier

$_SESSION['succes']="le produit a été ajouté au panier !" ; 

header("Location: MenuProfil.php");





?>