<?php
// search.php for search in /var/www/html/php/gendar_t/dynamique
// 
// Made by BERNARD Robin
// Login   <bernar_r@etna-alternance.net>
// 
// Started on  Wed Nov  9 14:14:02 2016 BERNARD Robin
// Last update Thu Nov 17 16:12:05 2016 GENDARME Thibaut
//

?>
<html>
<head>
<link rel="icon" type="image/png" href="ressources/logo.png" />
     <link rel="stylesheet" type="text/css" href="Ressources/Style/style_search.css">
     <meta charset="utf-8" />
     <title>Bizarts: recherche</title>
     </head>
<body>
  <?php require_once('navbar.php'); ?>


    <div class="identite">
     <div class="titres">
  <h2>Resultat de la recherche :</h2>
     </div>
   <br>
   <div class="contenu">
   <?php
   if(isset($_POST['the_search'])){
     
     try
     {
       $connection = new PDO('mysql:host=localhost;dbname=bizarts_gendar_t', "admin", "admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
     }
     catch (Exception $e)
     {
       die('Erreur : ' . $e->getMessage());
     }
     $mot = $_POST['the_search'];
     if( strlen( $mot ) <= 2 )
       echo "3 Charactere minimum";
     else {
       $row = $connection->prepare("SELECT * FROM Produits WHERE CONCAT(Libelle, ' ', Description) LIKE :mot");
       $row->bindValue("mot","%".$mot."%",PDO::PARAM_STR);
       $row->execute();
       $tab = $row->fetchALL();
       $row->closeCursor();
       $i = 1;
       $result = count($tab);
       if ($result == 0)
	 {
	   echo "Aucun resultat";
	 }
       while ($result >= $i)
	 {
	   echo "<a href=\"http://192.168.55.56/php/gendar_t/dynamique/articles.php?id=".$tab[$i]['ID']."\">";
	   echo "<u>".$tab[$i]['Libelle']."</u><br>";
	   echo $tab[$i]['Description']."</a><br><br>";
	  	   $i++;
	 }
     }
   }
   ?>
   </div>
</div>


         </body>
 <?php require_once('footer.php');?>
         </html>

  