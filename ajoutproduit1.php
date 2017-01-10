<?php
// ajoutproduit.php for web in /var/www/html/Web/PHP/dynamique
// 
// Made by REUTER Faustine
// Login   <reuter_f@etna-alternance.net>
// 
// Started on  Thu Nov 17 14:10:19 2016 REUTER Faustine
// Last update Fri Nov 18 16:33:33 2016 REUTER Faustine
//
session_start();

try
{
  $pdo = new PDO('mysql:host=localhost;dbname=bizarts_gendar_t', "admin", "admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}
$row = $pdo->query("SELECT * FROM Categories;");
$tab = $row->fetchAll();
$row->closeCursor();
$i = 0;
$size = count($tab);
?>

<html>
<head>
<meta charset="UTF-8">
     <link rel="stylesheet" href="Ressources/Style/style_panier.css" />
   <?php require_once("navbar.php");?>
     <title>Bizarts - Ajout produit</title>
     </head>
     <body>
  <?php if (intval($_SESSION['Role']) == 1){ ?>


 <div class="panier">
      <div class="titre"><h2>Nouveau produit - Etape 1/2</h2></div>
      <div class="contenu">
<br>
<form method="post" action="ajoutproduit2.php">
   Nom du produit :<br>
   <input type="text" placeholder="Libelle" name="libelle" required />
   <br><br>
   Description du produit :<br>
   <textarea rows="5" cols="100" placeholder="Description" name="description" required ></textarea>
   <br><br>
   Categorie : <br>
   <select name="categorie">
   <?php
  while ($i < $size)
    {
      echo '<option value="' . $tab[$i]['ID'] . '">' . $tab[$i]['Libelle'] . '</option>';
      $i = $i + 1;
    }
   ?>
   </select>
   <br><br>
   <input type="submit" value="Suivant" />
</form>
   <br>
   <br>
    </div>
    </div>
  <?php }
else { ?>
<div class="panier">
          <div class="titre"><h2>Autorisation requise !</h2></div>
   <div class="contenu"><br>Vous n&rsquo;êtes pas administrateur<br><br></div></div>
   
   <?php }
  ?>
   <?php require_once('footer.php'); ?>

   </body>
   </html>