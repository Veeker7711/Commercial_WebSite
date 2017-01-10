<?php
// modifproduit.php for web in /var/www/html/gendar_t/dynamique
// 
// Made by GENDARME Thibaut
// Login   <gendar_t@etna-alternance.net>
// 
// Started on  Thu Nov 17 14:27:16 2016 GENDARME Thibaut
// Last update Fri Nov 18 14:01:38 2016 GENDARME Thibaut
//

try
{
  $pdo = new PDO('mysql:host=localhost;dbname=bizarts_gendar_t', "admin", "admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

if ($_POST['libelle'] && $_POST['image'] && $_POST['description'] && $_POST['prix'] && $_POST['id_modif'])
  {
    $key = 1;
    $row = $pdo->prepare("UPDATE Produits SET Libelle = :libelle, Image = :image, Prix_vente = :prix, Description = :description WHERE ID = :id ");
    $row->bindValue(':libelle', $_POST['libelle'], PDO::PARAM_STR);
    $row->bindValue(':image', $_POST['image'], PDO::PARAM_STR);
    $row->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
    $row->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);
    $row->bindValue(':id', $_POST['id_modif'], PDO::PARAM_STR);
    $row->execute();
    $row->closeCursor();
  }
if ($_POST['id_delete'])
  {
    $key_delete = 1;
    $row = $pdo->prepare("DELETE FROM Produits WHERE ID = :id");
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
   <div class="titre"><h2>Modification de produits</h2></div>
   <div class="contenu">
   <br>
   <?php if ($key == 1)                                                                                                                                      
{                                                                                                                                                            
  echo "Produit modifié !<br><br>";
}
 else if ($key_delete == 1)
   {
     echo "Produit Suprimé !<br><br>";
   }?>  

   <form method="post" action="#">
      <select name="id">
   <?php
   $row = $pdo->query("SELECT * FROM Produits");
$tab = $row->fetchAll();
$row->closeCursor();
$i = 0;
$size = count($tab);
 
while ($i < $size) {
echo '<option value="' . $tab[$i]['ID'] . '">' .$tab[$i]['Libelle'] .' </option>';
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
      $row = $pdo->prepare("SELECT * FROM Produits WHERE ID = :id");
      $row->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
      $row->execute();
      $tab = $row->fetch();
      $row->closeCursor();
      echo "<form method=\"post\" action=\"#\">";
      echo "<br>Libelle:<br><input type=\"text\" required value=\"".$tab['Libelle']."\" name=libelle>";
      echo "<br><br>Image:<br><img src=\"".$tab['Image']."\"><br><input type=\"text\" required value=\"".$tab['Image']."\" name=\"image\">";
      echo "<br><br>Description:<br><textarea rows=\"5\" cols=\"100\" required name=\"description\">".$tab['Description']."</textarea>";
      echo "<br><br>Prix:<br><input type=\"text\" name=\"prix\" required value=\"".$tab['Prix_vente']."\">";
      echo "<br><br><input type=\"submit\" action=\"#\" value=\"Modifier\"><br><br><input type=\"hidden\" name=\"id_modif\" value=\"".$_POST['id']."\">";
      echo "</form>";
      echo "<form method=\"post\" action=\"#\">";
      echo "<input type=\"hidden\" name=\"id_delete\" value=\"".$_POST['id']."\">";
      echo "<input type=\"submit\" action=\"#\" value=\"Supprimer\">";
      echo "</form>";
    }
}
  else { ?>
<div class="panier">
   <div class="titre"><h2>Autorisation requise !</h2></div>
   <div class="contenu"><br>Vous n&rsquo;êtes pas administrateur<br><br></div></div>
 <?php } ?>
				       </body>
  