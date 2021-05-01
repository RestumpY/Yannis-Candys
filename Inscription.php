<?php 

// Connexion à la BDD
require "Fonction.php";
$bdd=connect();



if (isset($_POST['inscription'])) {

    $pseudo = htmlspecialchars($_POST['pseudo']);             # Le " htmlspecialchars " permet d'éviter les injections de code à notre code
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);                               # Le " sha1 " permet de acher le mot de passe pour pas qu'il soit connu par le hacker.
    $mdp2 = sha1($_POST['mdp2']);

  if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {

    $pseudolentgh = strlen($pseudo);        #le " strlen " permet d'avoir la longueur du pseudo

    if ($pseudolentgh <= 255) {

        $reqpseudo = $bdd->prepare("SELECT * FROM membre WHERE pseudo = ?");
        $reqpseudo->execute(array($pseudo));
        $pseudoexist = $reqpseudo->rowCount();

        if ($pseudoexist == 0){

      if ($mail == $mail2) {

        $reqmail = $bdd->prepare("SELECT * FROM membre WHERE mail = ?");
        $reqmail->execute(array($mail));
        $mailexist = $reqmail->rowCount();

        if ($mailexist == 0) {

          if ($mdp == $mdp2) {

            $insertmembre = $bdd->prepare("INSERT INTO membre(pseudo, mail, mdp) VALUES(?,?,?)");
            $insertmembre->execute(array($pseudo, $mail, $mdp));
            $erreur = "Votre compte a bien été créé ! <a href=\"Connexion.php\" class='btn btn-primary'>Me connecter</a>";
            }

            else{

              $erreur = "Votre mot de passe de correspond pas !";
            }

            # On continue
          }

          else{

            $erreur = "Adresse mail déja utilisée !";
          }

          # On continue
        }
        else{

          $erreur = "Votre adresse mail ne correspond pas !";
        }

        # On continue
      }
      else{

        $erreur = "Pseudo déjà utilisé !";
      }

      # On continue
    }

    else{

      $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
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
        <a class="nav-link" href="Connexion.php">Se connecter</a>
      </li>
    </ul>
    <form method="POST" action="Recherche.php" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" name="recherche" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
    </form>
  </div>
</nav>


<div align="center">

  <h1>Inscription</h1>
  <br / >

  <form method="POST" action="">
    <div class="form-group">
      <label for="pseudo">Nom utilisateur</label>
      <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Nom utilisateur" value="<?php if(isset($pseudo)){ echo $pseudo; }?>">  <!-- Le "value" sert à ne pas devoir réécrire à chaque fois le mot en entier. Il le garde en mémoire pour juste modifier -->
    </div>
    <div class="form-group">
      <label for="mail">Adresse mail</label>
      <input type="email" class="form-control" id="mail" name="mail" placeholder="Mail" value="<?php if(isset($mail)){ echo $mail; }?>">
    </div>
    <div class="form-group">
      <label for="mail2">Confirmation du mail</label>
      <input type="email" class="form-control" id="mail2" name="mail2" placeholder="Confirmation du Mail" value="<?php if(isset($mail2)){ echo $mail2; }?>">
    </div>
    <div class="form-group">
      <label for="mdp"> Mot de passe </label>
      <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" id="mdp">
    </div>
    <div class="form-group">
      <label for="mdp2"> Confirmation du mot de passe </label>
      <input type="password" class="form-control" placeholder="Confirmation du mot de passe" name="mdp2" id="mdp2">
    </div>
    <button type="submit" name="inscription" class="btn btn-primary">Valider</button>
    <br /><br />
    <a href='Index.php' class='btn btn-primary'>Retour au menu</a>
    <a href='Connexion.php' class='btn btn-primary'>Se connecter</a>
  </form>

  <?php
  if (isset($erreur)) {

    echo $erreur;
  }
  ?>
</div>

</body>
</html>