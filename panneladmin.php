<?php
// panneladmin.php for WEB in /var/www/html/Web/PHP/dynamique
// 
// Made by REUTER Faustine
// Login   <reuter_f@etna-alternance.net>
// 
// Started on  Thu Nov 17 09:46:04 2016 REUTER Faustine
// Last update Fri Nov 18 17:00:24 2016 REUTER Faustine
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
$row = $pdo->query("SELECT * FROM Utilisateurs;");
$tab = $row->fetchAll();
$row->closeCursor();
$i = 0;
$size = count($tab);

?>

<html>
<head>
<meta charset="UTF-8">
  <link rel="stylesheet" href="Ressources/Style/style_materiel.css" />
  <link rel="stylesheet" href="Ressources/Style/style_panier.css" />
   <?php require_once("navbar.php");?>
  <?php if (intval($_SESSION['Role']) == 1){ ?>
  
   </head>
   <body>

   <div class="tradi">
   <div class="titres">
   <h2>Gestion des produits</h2>
   </div>
   <div class="contenu">
   <br>
   <a href="ajoutproduit1.php">Ajouter un produit</a><br>
   <a href="modifproduit.php">Modifier un produit</a><br>
   <br>
   </div>
   </div>

   <div class="digi">
   <div class="titres">
   <h2>Gestion des utilisateurs</h2>
   </div><br>
   <div class="contenu">

  <form method="post" action="#">
  <select name="users">
  <?php
  while ($i < $size) {
    echo '<option value="' . $tab[$i]['ID'] . '">' . $tab[$i]['Prenom'] . ' ' . $tab[$i]['Nom'] . ' ( ' .  $tab[$i]['Mail'] . ' )</option>';
    $i = $i + 1;
  }
?> 
   </select>

   <br><br>
   <form method="post" action="#">
   <input type="submit" name="delete" value="Supprimer">
   </form>
   <form method="post" action="modifuser.php">
    <input type="submit" name="modif" value="Modifier">
   </form>
  </form>

<?php

  if ($_POST['delete'])
    {
      if ($_POST['users'] == 1)
	{
	  echo "<br><br>Operation impossible !<br>On ne supprime pas le super administrateur !";
	}
      else
	{
	  $row = $pdo->prepare('DELETE FROM Utilisateurs WHERE ID= :id');
	  $row->bindParam(':id', $_POST['users'], PDO::PARAM_STR);
	  $row->execute();
	  $row->closeCursor();
	  header('location: refresh_admin.php');
	}
    }

  ?>
  
   <br>
   <br></div><br>
   </div><br>

<br>
      <div class="tradi">
     <div class="titres">
     <h2>Gestion des tickets</h2>
     </div>
     <div class="contenu">
     <br>
  <?php
  $row = $pdo->query("SELECT * FROM Contact;");
  $tab = $row->fetchAll();
  $row->closeCursor();
  $i = 0;
  $size = count($tab);
while ($i < $size)
  {
    echo '<a href="tickets.php?id=' . $tab[$i]['ID'] . '">' . $tab[$i]['Objet'] . ' ( ' . $tab[$i]['Email'] . ' ) </a><br>';
      $i = $i + 1;
      }


if ($_POST['delticket'])
  {
    	$row = $pdo->prepare('DELETE FROM Contact WHERE ID= :id');
	$row->bindParam(':id', $_POST['idticket'], PDO::PARAM_STR);
	$row->execute();
	$row->closeCursor();
	header('location: refresh_admin.php');
     
  }

  ?>
     <br>
     </div>
     </div>

      <div class="digi">
      <div class="titres">
   <h2>Gestion de l&rsquo;index</h2>
      </div><br>
      <div class="contenu">

      <a href="addart.php">Ajouter un article</a><br>
      <a href="modifart.php">Modifier un article</a><br>
      <a href="addevent.php">Modifier l&rsquo;evenement en cours</a><br>
      <a href="modifpartener.php">Modifier les partenaires</a><br>
      <br></div>
      </div><br>
					     <?php }
else { ?>
					     <div class="panier">
					               <div class="titre"><h2>Autorisation requise !</h2></div>
					     <div class="contenu"><br>Vous n&rsquo;êtes pas administrateur<br><br></div></div>

					     <?php }
					       ?>
					     
   
   <?php require_once("footer.php"); ?>
   </body>
   </html>