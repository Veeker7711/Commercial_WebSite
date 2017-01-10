<?php
// ajoutproduit2.php for WEB in /var/www/html/Web/PHP/dynamique
// 
// Made by REUTER Faustine
// Login   <reuter_f@etna-alternance.net>
// 
// Started on  Thu Nov 17 15:21:20 2016 REUTER Faustine
// Last update Fri Nov 18 17:09:10 2016 BERNARD Robin
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
$row = $pdo->query("SELECT * FROM Sous_categories WHERE ID_categorie=" . $_POST['categorie']);
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
  <?php

  if(isset($_FILES['avatar']))
    {
      $dossier = 'upload/';
      $fichier = basename($_FILES['avatar']['name']);
      if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier))
	{
	  echo 'Upload effectué avec succès !';
	  $image = $dossier . $fichier;
	  $row = $pdo->prepare("INSERT INTO Produits (Libelle, Description, Prix_vente, Image, ID_sous_categorie) VALUES (:libelle, :description, :prix, :image, :id)");
	  $row->bindValue(':libelle', $_POST['libelle'], PDO::PARAM_STR);
	  $row->bindValue(':image', $image, PDO::PARAM_STR);
	  $row->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
	  $row->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);
	  $row->bindValue(':id', $_POST['sous_categorie'], PDO::PARAM_STR);
	  $row->execute();
	  $row->closeCursor();
	  header("location: ajoutproduit1.php");
	}
    }
else{ ?>

   <div class="panier">
        <div class="titre"><h2>Nouveau produit - Etape 2/2</h2></div>
        <div class="contenu">
  <br>
  <form method="post" action="ajoutproduit2.php" enctype="multipart/form-data">
  Categorie : 
  <?php if ($_POST['categorie'] == 1)
  echo "Traditionnel";

  if ($_POST['categorie'] == 2)
  echo "Digital";?>
  <br><br>
  Sous-categorie : <br>
     <select name="sous_categorie">
     <?php
  while ($i < $size)
    {
echo '<option value="' . $tab[$i]['ID'] . '">' . $tab[$i]['Nom'] . '</option>';
$i = $i + 1;
}
     ?>
     </select>
<br><br>

	 Photo du produit : <br><br>
	   <input type="file" name="avatar" required />
	 <?php
 echo "<input type=\"hidden\" name=\"categorie\" value=\"".$_POST['categorie']."\">";
echo "<input type=\"hidden\" name=\"description\" value=\"".$_POST['description']."\">";
echo "<input type=\"hidden\" name=\"libelle\" value=\"".$_POST['libelle']."\">";
?>
    
     <br><br>
     Prix : <br>
     <input type="number" required name="prix">
     <br><br>
     <input type="submit" value="Suivant" />
  </form>
     <br>
     <br>
      </div>
      </div>

  <?php require_once('footer.php'); ?>

     </body>
     </html>
  <?php } ?>