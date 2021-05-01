<?php
session_start();        //démarrer une session

require "Fonction.php";     // Connexion au serveur de BDD
$bdd=connect();

if (isset($_POST['formconnexion'])) {

  $log = htmlspecialchars($_POST["pseudo"]);      // Récupération des données saisies dans le formulaire d’identification. Pensez à crypter le mot de passe selon l’algorithme md5
  $mdp = sha1($_POST["mdp"]);

  if (!empty($log) AND !empty($mdp)) {

    $resultat = $bdd->prepare("SELECT * FROM admin WHERE login = ? AND mdp = ?");
    $resultat->execute(array($log, $mdp));
    $nb_lignes= $resultat->rowCount() ;         //Utilisation de la méthode rowCount permettant de compter le nombre de lignes de résultat renvoyées par la requête

    if ($nb_lignes == 1) {

      $userinfo = $resultat->fetch();
      $_SESSION["login"]= $userinfo['pseudo'] ;// Initialisation d’une variable de session comportant le login de l’admin et une variable de session d’autorisation à OK et redirection vers la page secrète
      $_SESSION["mdp"]= $userinfo['mdp'] ; 
      $_SESSION["admin"]= $userinfo->login ;
      $_SESSION["autorisation"]="OK" ;
      header("Location: AccueilAdmin.php");
    }

    else{

      $erreur = "Nom de compte ou mot de passe incorrect !";
    }


  }

  else{

    $erreur = "Tout les champs doivent etre complétés !";

  }

}


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link href="style.css" rel="stylesheet">
	
    <title>Bonbon</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  
  
  <a class="navbar-brand" href="Index.php"><img src="Image/Icone.jpg" /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="Connexion.php">Se connecter</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="Inscription.php">Inscription</a>
      </li>
    </ul>
    <form method="POST" action="Recherche.php" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" name="recherche" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
    </form>
  </div>
</nav>

<div align="center">

  <h1>Compte Administrateur</h1>
  <br / >

  <form method="POST" action="">
    <div class="form-group">
      <label for="pseudo">Nom utilisateur</label>
      <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Nom d'utilisateur">
    </div>
    <div class="form-group">
      <label for="mdp"> Mot de passe </label>
      <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" id="mdp">
    </div>
    <div class="g-recaptcha" data-sitekey="6Lc8m_0UAAAAAJ4hQbd_CdH2yYL1xf-ViVeT4qp8"></div>
    <br />
    <button type="submit" name="formconnexion" class="btn btn-primary">Se connecter</button>
    <a href='Index.php' class='btn btn-primary'>Retour au menu</a>
  </form>
    <?php

  if (isset($erreur)) {

    echo $erreur;
  }

  ?>
</div>


</body>
</html>