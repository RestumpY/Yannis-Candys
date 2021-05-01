<?php

 include "config.php";
 
// Fonction de connexion

function connect(){
	
try{
	$connect= new PDO('mysql:host='.HOTE.';dbname='.BDD,UTILISATEUR,MDP, array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
}
catch(PDOException $e){
	echo "Problème de connexion à la BDD <br>".$e->getMessage();
}

return $connect;
}


function securiser($donnees){

        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
}



?>