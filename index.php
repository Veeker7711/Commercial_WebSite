<?php
// index.php for WEB in /var/www/html/Web/PHP/dynamique
// 
// Made by REUTER Faustine
// Login   <reuter_f@etna-alternance.net>
// 
// Started on  Mon Nov  7 13:34:35 2016 REUTER Faustine
// Last update Fri Nov 18 09:35:34 2016 BERNARD Robin
//

  try
  {
    $pdo = new PDO('mysql:host=localhost;dbname=bizarts_gendar_t', "admin", "admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
  }
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}
$row = $pdo->query("SELECT * FROM News ORDER BY ID DESC;");
$tab = $row->fetchAll();
$row->closeCursor();
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="Ressources/Style/style_index.css" />
<?php require_once("navbar.php");?>
  <title>BizArts - Bienvenue</title>
  
</head>
<body>
<div class="news">
  <div class="titres">
    <h2>EVENEMENTS</h2>
  </div>
  <div class="contenu">
   <?php
   echo '<a  href="' . $tab[0]['Lien'] . '" title="En ce moment"><img src="' . $tab[0]['Image'] . '"></a>';
   ?>
  </div>
</div>


<!-- AFFICHAGE DES ARTICLES -->
   
<?php
$row = $pdo->query("SELECT * FROM Articles ORDER BY ID DESC;");
$tab = $row->fetchAll();
$row->closeCursor();
$i = 0;
$size = count($tab);

while ($i < $size){ ?>
  
<div class="articles">
  <div class="titres">
    <h2><?php echo $tab[$i]['Titre']; ?></h2>
  </div>
  <div class="contenu">
    <?php if($tab[$i]['Image'] != NULL){
    echo "<br><img src='" . $tab[$i]['Image'] . "'/>"; }?>
  <h4><?php echo $tab[$i]['Contenu']; ?></h4>
  </div>
  <div class="bas">
  <h6><?php echo 'Par ' . " " . $tab[$i]['Nom'] . " " . 'le ' . " " . $tab[$i]['Date_creation']; ?></h6>
  <?php $i = $i + 1;?>
  </div>
</div>
  <?php } ?>

<!-- AFFICHAGE DES PARTENAIRES -->

<?php
$row = $pdo->query("SELECT * FROM Partenaires ORDER BY ID DESC;");
$tab = $row->fetchAll();
$row->closeCursor();
?>

<div class="partenaires">
  <div class="titres">
    <h2>Partenaires</h2>
  </div>
  <div class="contenu">
  <?php
  $i = 0;
  $size = count($tab);
  echo '<br>';
  while ($i < $size){
    echo '<a href=' . $tab[$i]['Url'] . '>' . $tab[$i]['Nom'] .'</a><br>';
    $i = $i + 1;
  }
  ?>
    </div>
</div>

<!-- AFFICHAGE DES ARTICLES LES PLUS VENDUS -->

<?php
$row = $pdo->query("SELECT Libelle,ID FROM Produits LEFT JOIN Ventes ON Produits.ID WHERE Ventes.ID_produit = Produits.ID");
$tab = $row->fetchAll();
$row->closeCursor();
?>

<div class="partenaires">
    <div class="titres">
      <h2>Les plus vendus</h2>
    </div>
    <div class="contenu">
    <?php
  $i = 0;
$size = count($tab);
echo '<br>';
while ($i < $size){
  echo '<a href="articles.php?id=' . $tab[$i]['ID'] . '">' . $tab[$i]['Libelle'] .'</a><br>';
  $i = $i + 1;
}
  ?>
    </div>
    </div>
    

<?php require_once("footer.php"); ?>
</body>
</html>