<?php
// addevent.php for web in /var/www/html/gendar_t/dynamique
// 
// Made by GENDARME Thibaut
// Login   <gendar_t@etna-alternance.net>
// 
// Started on  Fri Nov 18 14:06:30 2016 GENDARME Thibaut
// Last update Fri Nov 18 16:41:18 2016 REUTER Faustine
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

if ($_POST['lien'])
  {
    $row = $pdo->prepare("UPDATE News SET Image = :image, Lien = :lien WHERE ID=1");
    $row->bindValue(':image', $_POST['image'], PDO::PARAM_STR);
    $row->bindValue(':lien', $_POST['lien'], PDO::PARAM_STR);
    $row->execute();
    $row->closeCursor();
    header("location: index.php");
  }
?>
<html>
<head>
<meta charset="UTF-8">
  <link rel="stylesheet" href="Ressources/Style/style_panier.css">
  <?php require_once("navbar.php");?>
  </head>
  <body>
  <?php if (intval($_SESSION['Role'] == 1)){ ?>
<div class="panier">
   <div class="titre"><h2>Modification de l&rsquo;événement</h2></div>
   <div class="contenu">
    <br>
<?php
$row = $pdo->prepare("SELECT * FROM News");
$row->execute();
$tab = $row->fetch();
$row->closeCursor();
echo "<form method=\"post\" action=\"#\">";
echo "<br>Lien de l'événement<br><input type=\"text\" required value=\"".$tab['Lien']."\" name=lien>";
echo "<br><br>Image:<br><img src=\"".$tab['Image']."\"><br><input type=\"text\" required value=\"".$tab['Image']."\" name=\"image\">";
echo "<br><br><input type=\"submit\" action=\"#\" value=\"Modifier\"><br><br>";
echo "</form>";
}
else { ?>
       <div class="panier">
       <div class="titre"><h2>Autorisation requise !</h2></div>
       <div class="contenu"><br>Vous n&rsquo;êtes pas administrateur<br><br></div></div>
       <?php }
require_once('footer.php');
?>
</body>
</html>