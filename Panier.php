<?php 
session_start();

// unset($_SESSION['panier']); // Pour vider la variable.
// Connexion à la BDD
if(isset($_SESSION['panier'])){


require "Fonction.php";
$bdd=connect();

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
    <script src="bootstrap-auto-dismiss-alert.js"></script>
    <link href="style.css" rel="stylesheet">
  
    <title>Bonbon</title>
  </head>
  <body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  
  <a class="navbar-brand" href="MenuProfil.php"><img src="Image/Icone.jpg" /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="Panier.php">Mon panier</a>
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

  
  <div class="container">
  <div class="row justify-content-center" >


<center><h1> Votre Panier </h1></center>

  <div class='container'>
<table class='table table-dark'>
  <thead>
    <tr>
      <th scope='col'>Produit</th>
      <th scope='col'>Prix</th>
      <th scope='col'>Quantité</th>
      <th scope='col'>Montant</th>
    </tr>
  </thead>
  <tbody>
<?php

if(isset($_SESSION['panier'])){

$MontantHT = 0;
foreach($_SESSION['panier'] as $id=>$quantite ){

  $sql = "select * from produit where id = $id";
  $resultat = $bdd->query($sql);
  $produit = $resultat->fetch(PDO::FETCH_OBJ);
  $Montant = "$produit->prix"*$quantite;

  echo "
    <tr>

    <td> $produit->nom</td>
    <td> $produit->prix €</td>
    <td> $quantite</td>
    <td> $Montant €</td>
    <td><a href='Ajoute_Panier2.php?panier=$produit->id'><img src='Image/AjoutPanier' /></a></td>
    <td><a href='Retrait_Panier.php?panier=$produit->id'><img src='Image/retirerPanier' /></a></td>

    </tr>

    ";

    $MontantHT = $MontantHT + $Montant;
    //$TVA = $prixHT*(1+0.2);
    


}


?>

</tbody>
</table>
</div>
    <a href='MenuProfil.php' class='btn btn-primary'>Continuer mes achats</a>
    <br />
    <a href='Payer.php' class='btn btn-primary'>Payer</a>
    <a href='Vider.php' class='btn btn-primary'>Vider le panier</a>


  </div>
</div>

<?php
}
?>
</body>
</html>

