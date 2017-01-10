<?php
// addart.php for addart in /var/www/html/php/gendar_t/dynamique
// 
// Made by BERNARD Robin
// Login   <bernar_r@etna-alternance.net>
// 
// Started on  Fri Nov 18 09:30:53 2016 BERNARD Robin
// Last update Fri Nov 18 16:38:21 2016 BERNARD Robin
//

try
{
  $pdo = new PDO('mysql:host=localhost;dbname=bizarts_gendar_t', "admin", "admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

?>

<html>
<head>
<meta charset="UTF-8">
       <link rel="stylesheet" href="Ressources/Style/style_panier.css" />
  <?php require_once("navbar.php");?>
       <title>Bizarts - Ajout Article</title>
       </head>
       <body>



   <div class="panier">
        <div class="titre"><h2>Nouvel article</h2></div>
        <div class="contenu">
  <br>
  <form method="post" action="#" enctype="multipart/form-data">
  Titre de l&#039article :<br>
     <input type="text" placeholder="titre" name="Titre" required />
     <br><br>
  Description de l&#039article :<br>
     <textarea rows="5" cols="100" placeholder="description" name="Contenu" required ></textarea>
    
    </select>
       <br><br>
  Photo article : <br><br>
  <input type="file" name="avatar" />


         <br><br>
         <input type="submit" name="submit" value="Ajouter l'article" />
</form>

  <?php


  session_start();

$datecreation = date("y.m.d");
if(isset($_FILES['avatar']))
  {
    $dossier = 'upload/';
    $fichier = basename($_FILES['avatar']['name']);
    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier))
      {
	echo 'Upload effectué avec succès !';
	$image = $dossier . $fichier;
	$row = $pdo->prepare("INSERT INTO Articles(Titre, Contenu, Image, Date_creation, Nom) VALUES(:titre, :contenu, :image, :datecreation, :nom)");
	$row->bindParam(':titre', $_POST['Titre'], PDO::PARAM_STR);
	$row->bindParam(':contenu', $_POST['Contenu'], PDO::PARAM_STR);
	$row->bindParam(':image', $image, PDO::PARAM_STR);
	$row->bindParam(':datecreation', $datecreation, PDO::PARAM_STR);
	$row->bindParam(':nom', $_SESSION['Utilisateurs'], PDO::PARAM_STR);
	$row->execute();
	$row->closeCursor();
	echo "<br><br>Article ajouté";
      }
    else
      {
	$row = $pdo->prepare("INSERT INTO Articles(Titre, Contenu, Date_creation, Nom) VALUES(:titre, :contenu, :datecreation, :nom)");
	$row->bindParam(':titre', $_POST['Titre'], PDO::PARAM_STR);
	$row->bindParam(':contenu', $_POST['Contenu'], PDO::PARAM_STR);
	$row->bindParam(':datecreation', $datecreation, PDO::PARAM_STR);
	$row->bindParam(':nom', $_SESSION['Utilisateurs'], PDO::PARAM_STR);
	$row->execute();
	$row->closeCursor();
	echo "<br><br>Article ajouté";
      }
  }


?>

        
 
     <br>
     <br>
      </div>
      </div>

  <?php require_once('footer.php'); ?>

     </body>
     </html>