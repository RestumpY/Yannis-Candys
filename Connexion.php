<?php 
session_start();

// Connexion à la BDD
require "Fonction.php";
$bdd=connect();


if(isset($_POST['formconnexion'])){


  $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);             # Le " htmlspecialchars " permet d'éviter les injections de code à notre code
  $mdpconnect = sha1($_POST['mdpconnect']);                               # Le " sha1 " permet de acher le mot de passe pour pas qu'il soit connu par le hacker.

  if(!empty($pseudoconnect) AND !empty($mdpconnect)){

    $requser = $bdd->prepare("SELECT * FROM membre WHERE pseudo = ? AND mdp = ?");
    $requser->execute(array($pseudoconnect, $mdpconnect));
    $userexist = $requser->rowCount();
    if ($userexist == 1) {

      $userinfo = $requser->fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['pseudo'] = $userinfo['pseudo'];
      $_SESSION['mail'] = $userinfo['mail'];
      header("Location: Profil.php?id=".$_SESSION['id']);

    }
    else{

      $erreur = "Nom d'utilisateur ou mot de passe incorrecte !";
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
        <a class="nav-link" href="Admin.php">Admin</a>
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

  <h1>Se connecter</h1>
  <br / >

  <form method="POST" action="">
    <div class="form-group">
      <label for="pseudoconnect">Nom utilisateur</label>
      <input type="text" class="form-control" name="pseudoconnect" placeholder="Nom utilisateur">
    </div>
    <div class="form-group">
      <label for="mdpconnect"> Mot de passe </label>
      <input type="password" class="form-control" placeholder="Mot de passe" name="mdpconnect">
    </div>
    <button type="submit" name="formconnexion" class="btn btn-primary">Se connecter</button>
    <br /><br />
    <a href='Index.php' class='btn btn-primary'>Retour au menu</a>
    <a href='Inscription.php' class='btn btn-primary'>Pas encore de compte ?</a>
  </form>

  <?php

  if (isset($erreur)) {

    echo $erreur;
  }

  ?>

</div>

    
  



</body>
</html>