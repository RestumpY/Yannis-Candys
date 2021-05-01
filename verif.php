<?php
session_start();				//démarrer une session

require"../recaptcha/autoload.php";
$recaptcha = new \ReCaptcha\ReCaptcha("6Lc8m_0UAAAAAFCo7ait_nrUIl1iA8__CqRopq6W");
$gRecaptchaResponse = $_POST["g-recaptcha-reponse"];
$resp = $recaptcha->verify($gRecaptchaResponse);
if ($resp->isSuccess()) {
   

require "Fonction.php";			// Connexion au serveur de BDD
$bdd=connect();

$connexion = $_POST['formconnexion'];

if(isset($connexion)) {

	$log = htmlspecialchars($_POST["pseudo"]);			// Récupération des données saisies dans le formulaire d’identification. Pensez à crypter le mot de passe selon l’algorithme md5
	$mdp = sha1($_POST["mdp"]);

	if(!empty($log) AND !empty($mdp)) {

		$resultat = $bdd->prepare("SELECT * FROM admin WHERE login = ? AND mdp = ?");
		$resultat->execute(array($log, $mdp));
		$nb_lignes= $resultat->rowCount() ;					//Utilisation de la méthode rowCount permettant de compter le nombre de lignes de résultat renvoyées par la requête

		if($nb_lignes == 1) {

			$_SESSION["admin"]= $rep->login ;	// Initialisation d’une variable de session comportant le login de l’admin et une variable de session d’autorisation à OK et redirection vers la page secrète
			$_SESSION["autorisation"]="OK" ;
			header("Location: AccueilAdmin.php");
		}

		else{

			echo "Nom de compte ou mot de passe incorrect !";
		}


	}

	else{

		echo "Tout les champs doivent etre complétés !";

	}

}





} else {
    $errors = $resp->getErrorCodes();
}




?>