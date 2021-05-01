<?php 

// Connexion à la BDD
require "Fonction.php";
$bdd=connect();

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
  
  
  <a class="navbar-brand" href="AccueilAdmin.php"><img src="Image/Icone.jpg" /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Panier
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="Ajouter.php">Ajouter</a>
          <a class="dropdown-item" href="Supprimer.php">Supprimer</a>
        </div>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="Deconnexion.php">Déconnexion</a>
    </li>
    </ul>
    <form method="POST" action="Recherche.php" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" name="recherche" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
    </form>
  </div>
</nav>

<center><h1> Modifier un bonbon </h1></center>
  
  <div class="container">
  <div class="row justify-content-center" >
<?php

// Requete

$sql = "select* from produit";


//Execution de la requete

$resultat=$bdd->query($sql) ;

// Affichage des résultats dans un objet

while($produit = $resultat->fetch(PDO::FETCH_OBJ))
{


echo "

	<div class='card mb-3 text-center' style='width: 15rem;'>
		<img src='Image/$produit->photo' class='card-img-top' align='center'>
		<div class='card-body'>
			<h5 class='card-title'>$produit->nom</h5>
			<p class='card-text'>$produit->prix €</p>
			<a href='Modifier2.php?modif=$produit->id' class='btn btn-primary' name='modifier' >Modifier</a>
		</div>
	</div>";
  
}


?>
  </div>
</div>



</body>
</html>