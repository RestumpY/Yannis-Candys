<?php
session_start();        //démarrer une session

$id = $_GET["panier"];


if(isset($_SESSION['panier'][$id]))
{
$_SESSION['panier'][$id]++ ; //ajoute 1 à la quantité
header("Location: Panier.php");
}


?>