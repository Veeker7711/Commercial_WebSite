<?php
// categories.php for WEB in /var/www/html/Web/PHP/dynamique
// 
// Made by REUTER Faustine
// Login   <reuter_f@etna-alternance.net>
// 
// Started on  Thu Nov 10 10:40:29 2016 REUTER Faustine
// Last update Wed Nov 16 13:13:36 2016 GENDARME Thibaut
//
?>

<html>
<head>
<meta charset="UTF-8">
   <link rel="stylesheet" href="Ressources/Style/style_categories.css" />
   <link rel="icon" type="image/png" href="Ressources/Images/logo.png" />
   <title>BizArts - Categorie</title>
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
$row = $pdo->query("SELECT MAX(ID) FROM Produits;");
$max = $row->fetch();
$max = intval($max[0]);
$row->closeCursor();

$row = $pdo->query("SELECT * FROM Produits ORDER BY ID DESC;");
$tab = $row->fetchAll();
$row->closeCursor();
$i = 0;
$j = 0;
$ok = 0;
$size = count($tab);

while ($j !== $max && $j <= $max)
  {
    if ($j == $_GET['id'])
	$ok = 1;
    $j = $j + 1;
    }
if ($ok == 1)
  {
    $ok = 0;
    while ($i < $size) {
      if ($tab[$i]['ID_sous_categorie'] == $_GET['id'])
      {
	$ok = 1;
	?>
	 <div class="articles">
         <div class="nom">
       <?php echo '<h4>' . $tab[$i]['Libelle'] . '</h4>'; ?>
         </div>
         <div class="image">
       <?php echo '<a href="articles.php?id=' . $tab[$i]['ID'] . '"><img src="' . $tab[$i]['Image'] . '"/></a>';?>
         </div>
         <div class="description">
       <?php echo '<h5>' . $tab[$i]['Description'] . '</h5>';
       echo '<h4>' . $tab[$i]['Prix_vente'] . '&euro;</h4>'; 
       echo "<form method=\"post\" action=\"categories.php?id=" . $tab[$i]['ID_sous_categorie'] . "\"><input type=\"submit\" value=\"Ajouter au pannier\"><input type=\"hidden\" name=\"id\" value=\"" . $tab[$i]['ID'] . "\"><input type=\"number\" name=\"nbr\" class=\"nbr\" value=\"1\">Qté</form>";
       if (intval($_POST['id']) == intval($tab[$i]['ID']))
	 {
	   if ($_SESSION['ID']) /* verification si l'utilisateur est co ou non */
	     {
	       if (intval($_POST['nbr']) > 0)
		 echo "<br>Article(s) Ajouté au panier !<br>";
	       $qte = 0;
	       while ($qte < intval($_POST['nbr']))
		 {
		   $pdo->query("INSERT INTO Produit_Utilisateur(ID_produit,ID_utilisateur) VALUES (" . $tab[$i]['ID'] . "," . $_SESSION['ID'] . ")");
		   $qte++;
		 }
	     }
	   else
	     {
	       $_SESSION['url'] = "categories.php?id=" . $tab[$i]['ID_sous_categorie'];
	       require('login_float.php');
	     }
	     } ?>
         </div>
       </div>
	      <?php
	      }
	      $i = $i + 1;      
	      }
  }
if ($ok == 0)
  { ?>
  <div class="articles">
            <div class="nom">
      <h4>Op&eacute;ration impossible</h4>
            </div>
            <div class="description">
      <h5>La cat&eacute;gorie est inexistante.</h5>
      </div>
    </div>

  <?php }?> 
   <?php require_once("footer.php");?>
   </body>
   </html>