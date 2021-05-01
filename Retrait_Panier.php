<?php
session_start();        //démarrer une session

$id = $_GET["panier"];


if($_SESSION['panier'][$id] == 1){

	unset($_SESSION['panier'][$id]);

}
else{

	$_SESSION['panier'][$id]-- ; 
}

header("Location: Panier.php");

?>