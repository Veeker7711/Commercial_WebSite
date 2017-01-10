<?php
// panier.php for panier in /var/www/html/php/gendar_t/dynamique
// 
// Made by BERNARD Robin
// Login   <bernar_r@etna-alternance.net>
// 
// Started on  Mon Nov 14 14:08:05 2016 BERNARD Robin
// Last update Fri Nov 18 14:50:50 2016 BERNARD Robin
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

/* AJOUT ET SUPRESSION ARTICLES DEPUIS LE PANIER */

if ($_POST['id'] && intval($_POST['nbr']) > 0)
  {
    $j = 0;
    $i = 0;
    $row = $pdo->query("SELECT MAX(ID) FROM Produit_Utilisateur");
    $tab_nbr_products = $row->fetch();
    $row->closeCursor();
    $row = $pdo->query("SELECT MAX(ID) FROM Produits");
    $tab_nbr_products2 = $row->fetch();
    $row->closeCursor();
    while ($i < intval($_POST['nbr']))
      {
	$row = $pdo->exec("DELETE FROM Produit_Utilisateur WHERE ID=".$j." AND ID_produit=".$_POST['id']);
	if ($row != 0)
	  $i++;
	$j++;
	if ($j > intval($tab_nbr_products[0]) && $j > intval($tab_nbr_products2[0]))
	  $i = intval($_POST['nbr']) + 2;
	
      }
  }
else if ($_POST['id'] && intval($_POST['nbr_add']) > 0)
  {
    $qte = 0;
    while ($qte < intval($_POST['nbr_add']))
      {
	$pdo->query("INSERT INTO Produit_Utilisateur(ID_produit,ID_utilisateur) VALUES (" . $_POST['id']  . "," . $_SESSION['ID'] . ")");
	$qte++;
      }
  }


    ?>

<html>
<head>
<meta charset="UTF-8">
  <link rel="stylesheet" href="Ressources/Style/style_panier.css" />
  <?php require_once("navbar.php");?>
  <title>Bizarts - Panier</title>
  </head>
  <body>
  <div class="panier">
  <div class="titre"><h2>Panier</h2></div>
  <div class="contenu">
  <?php
  
  if ($_SESSION['Utilisateurs'])
    {
      $id = $_SESSION['ID'];

      $row = $pdo->query("SELECT ID_produit FROM Produit_Utilisateur WHERE ID_utilisateur = '".$id."'");

      $tab = $row->fetchAll();

      $row->closeCursor();


      
      if (count($tab))
	{
	  $i = 0;
	  $j = 0;
	?>
	    <div class="tableau">
	                 <table>
	                   <tr>
	                     <th>Article</th>
	                     <th>Quantite</th>
	       <th>Prix</th>
	       </tr>
	       <?php
	       $row = $pdo->query("SELECT Produits.ID,Libelle,Image,Prix_vente FROM Produits JOIN Produit_Utilisateur ON Produits.ID WHERE Produit_Utilisateur.ID_produit = Produits.ID AND ID_Utilisateur = '".$id."' ORDER BY ID");
	  $tab2 = $row->fetchAll();
	  $row->closeCursor();

	  $row= $pdo->query("SELECT ID_Produit, COUNT(*) AS nbpre FROM Produit_Utilisateur WHERE Produit_Utilisateur.ID_utilisateur = '".$id."' GROUP BY ID_Produit");
	  $tab3 = $row->fetchAll();
	  $row->closeCursor();
	  
	  
	  while ($i < count($tab))
	    {
	      while ($tab2[$i]['Libelle'] == $tab2[$i+1]['Libelle'] )
		$i++;
	      echo "<tr>
              <td><p>".$tab2[$i]["Libelle"]."</p><div class=\"image\"><img src=".$tab2[$i]["Image"]."><br><br><form method=\"post\" class=\"delete\" action=\"panier.php\"><input type=\"submit\" value=\"Supprimer\"><input type=\"number\" name=\"nbr\" class=\"nbr\" value=\"1\">Qté<input type=\"hidden\" name=\"id\" value=".$tab2[$i]['ID']."></form></td></div>
         <td>".$tab3[$j]["nbpre"]."<br><br><form method=\"post\" class=\"delete\" action=\"panier.php\"><input type=\"number\" name=\"nbr_add\" class=\"nbr\" value=\"1\"><input type=\"submit\" value=\"+\"><input type=\"hidden\" name=\"id\" value=" . $tab2[$i]['ID']  . "></form></td>
              <td>".$tab2[$i]["Prix_vente"]."€"."</td>
            </tr>";
	      $j++;
	      $i++;
	      
	    }
	  echo "<tr>
<th></th> 
<th></th>  
<th>TOTAL :";

	  $g = 0;
	  $h = 0;
	   while ($g < count($tab))
	    {
	      while ($tab2[$g]['Libelle'] == $tab2[$g+1]['Libelle'] )
		$g++;

	      $total = $total + $tab2[$g]["Prix_vente"] * $tab3[$h]["nbpre"];
	      $g++;
	      $h++;
	    }
	  
	  
echo " ".$total." €</th>
</tr></table><br>";
Echo "<button type=\"button\" onclick=\"alert('Faites bonne visite sur notre site ! :)')\">Passer au payement</button><br><br>";

	}
      else
	{
	  echo "<br>Panier vide...<br><br>";
	}
      
    }
  else
    {
      echo "<br><strong>Veuillez vous connectez</strong><br><br>";
    }
echo "</div></div></div>";
require_once('footer.php');
echo "</body>";
?>