<?php
// tickets.php for WEB in /var/www/html/Web/PHP/dynamique
// 
// Made by REUTER Faustine
// Login   <reuter_f@etna-alternance.net>
// 
// Started on  Fri Nov 18 09:27:38 2016 REUTER Faustine
// Last update Fri Nov 18 13:53:17 2016 REUTER Faustine
//
try
{
  $pdo = new PDO('mysql:host=localhost;dbname=bizarts_gendar_t', "admin", "admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}
$row = $pdo->query("SELECT * FROM Contact WHERE ID=" . $_GET['id']);
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
         <title>Bizarts - Tickets</title>
         </head>
         <body>

         <div class="panier">
  <?php
echo '<div class="titre"><h2>Objet : ' . $tab[0]['Objet'] . '</h2></div>';
  ?>
         <div class="contenu">
  <br>
<?php
  echo 'Expediteur : ' . $tab[0]['Email'];
  ?>
<br><br>
<?php
echo $tab[0]['Contenu'];
?>
<br>
  <br>
 <form method="post" action="panneladmin.php">
  <?php
  echo '<input type="hidden" name="idticket" value="' . $tab[0]['ID'] . '">';
  ?>
     <input type="submit" name="delticket" value="Supprimer">
     </form>
  <br><br>
         </div>
  </div>

  </body>
  </html>