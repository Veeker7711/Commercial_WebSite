<?php
// materiel.php for WEB in /var/www/html/Web/PHP/dynamique
// 
// Made by REUTER Faustine
// Login   <reuter_f@etna-alternance.net>
// 
// Started on  Tue Nov  8 16:47:57 2016 REUTER Faustine
// Last update Thu Nov 17 10:22:44 2016 REUTER Faustine
//
?>

<html>
<head>
<meta charset="UTF-8">
     <link rel="stylesheet" href="Ressources/Style/style_materiel.css" />
     <link rel="icon" type="image/png" href="Ressources/Images/logo.png" />
     <title>BizArts - Materiel</title>
   <?php require_once("navbar.php"); ?>
     </head>
     <body>

 <?php
   try
   {
     $pdo = new PDO('mysql:host=localhost;dbname=bizarts_gendar_t', "admin", "admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
   }
   catch (Exception $e)
   {
     die('Erreur : ' . $e->getMessage());
   }

  $row = $pdo->query("SELECT * FROM Sous_categories WHERE ID_categorie = 1 ORDER BY ID DESC;");
  $tab = $row->fetchAll();
  $row->closeCursor();
  $i = 0;
  $size = count($tab);
 ?>

<!-- ONGLET TRADITIONNEL -->

       <div class="tradi">
         <div class="titres">
           <h2>Traditionnel</h2>
         </div>
         <div class="contenu">
           <br>
      <?php while ($i < $size){
    $url = 'categories.php?id=' . $tab[$i]['ID'];
    echo '<a href="' . $url . '">' . $tab[$i]['Nom'] . '</a><br>';
    $i = $i + 1;
      } ?>
    <br>
          </div>
       </div>
    
<!-- ONGLET DIGITAL -->

    <?php $row = $pdo->query("SELECT * FROM Sous_categories WHERE ID_categorie = 2 ORDER BY ID DESC;");
    $tab = $row->fetchAll();
$row->closeCursor();
$i = 0;
$size = count($tab);
 ?>

   <div class="digi">
       <div class="titres">
             <h2>Digital</h2>
           </div><br>
       <div class="contenu">

  <?php while ($i < $size){
  $url = 'categories.php?id=' . $tab[$i]['ID'];
  echo '<a href="' . $url . '">' . $tab[$i]['Nom'] . '</a><br>';
  $i = $i + 1;
} ?>

                 <br></div>
		    </div><br>

     <?php require_once("footer.php");?>
     </body>
 </html>