<?php
// modifpartner.php for web in /var/www/html/gendar_t/dynamique
// 
// Made by GENDARME Thibaut
// Login   <gendar_t@etna-alternance.net>
// 
// Started on  Fri Nov 18 15:06:30 2016 GENDARME Thibaut
// Last update Fri Nov 18 16:35:47 2016 REUTER Faustine
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

if ($_POST['nom'] && $_POST['url'])
  {
    $key = 1;
    $row = $pdo->prepare("UPDATE Partenaires SET Nom = :nom, Url = :url WHERE ID = :id");
    $row->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
    $row->bindValue(':url', $_POST['url'], PDO::PARAM_STR);
    $row->bindValue(':id', $_POST['id_modif'], PDO::PARAM_STR);
    $row->execute();
    $row->closeCursor();
  }
if ($_POST['id_delete'])
  {
    $key_delete = 1;
    $row = $pdo->prepare("DELETE FROM Partenaires WHERE ID = :id");
    $row->bindValue(':id', $_POST['id_delete'], PDO::PARAM_STR);
    $row->execute();
    $row->closeCursor();
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
					     <div class="titre"><h2>Modification des Partenaires</h2></div>
					     <div class="contenu">
					     <br>
					     
<?php if ($key == 1)
{
  echo "Partenaires modifié !<br><br>";
}
else if ($key_delete == 1)
  {
    echo "Partenaires Suprimé !<br><br>";
  }?>

   <form method="post" action="#">
        <select name="id">
     <?php
  $row = $pdo->query("SELECT * FROM Partenaires");
$tab = $row->fetchAll();
$row->closeCursor();
$i = 0;
$size = count($tab);

while ($i < $size) {
  echo '<option value="' . $tab[$i]['ID'] . '">' .$tab[$i]['Nom'] .' </option>';
  $i = $i + 1;
}
?>
</select>
<br>
<br>
<input type="submit" action="#" value="Choisir">
    <br>
  <br>
  </form>
  <?php
  
  if ($_POST['id'])
    {
      $row = $pdo->prepare("SELECT * FROM Partenaires WHERE ID = :id");
      $row->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
      $row->execute();
      $tab = $row->fetch();
      $row->closeCursor();
      echo "<form method=\"post\" action=\"#\">";
      echo "<br>Nom:<br><input type=\"text\" required value=\"".$tab['Nom']."\" name=\"nom\">";
      echo "<br><br>Url:<br><input type=\"text\" name=\"url\" required value=\"".$tab['Url']."\">";
      echo "<br><br><input type=\"submit\" action=\"#\" value=\"Modifier\"><br><br><input type=\"hidden\" name=\"id_modif\" value=\"".$_POST['id']."\">";
      echo "</form>";
      echo "<form method=\"post\" action=\"#\">";
      echo "<input type=\"hidden\" name=\"id_delete\" value=\"".$_POST['id']."\">";
      echo "<input type=\"submit\" action=\"#\" value=\"Supprimer\"><br><br>";
      echo "</form>";
    }
}
  else { ?>
    <div class="panier">
      <div class="titre"><h2>Autorisation requise !</h2></div>
      <div class="contenu"><br>Vous n&rsquo;êtes pas administrateur<br><br></div></div>
					      <?php } ?>
                                       </body>

				       