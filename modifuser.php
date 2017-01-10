<?php
// modifuser.php for WEB in /var/www/html/Web/PHP/dynamique
// 
// Made by REUTER Faustine
// Login   <reuter_f@etna-alternance.net>
// 
// Started on  Fri Nov 18 13:45:32 2016 REUTER Faustine
// Last update Fri Nov 18 16:40:28 2016 REUTER Faustine
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

?>

<html>
      <head>
       <link rel="stylesheet" href="Ressources/Style/style_panier.css" />
          <meta charset="utf-8" />
          <title>Droits</title>
        </head>
        <body>
  <?php require_once('navbar.php'); ?>
  <?php if (intval($_SESSION['Role'] == 1)){ ?>
 <div class="panier">
        <div class="titre"><h2>Modifier les droits</h2></div>
        <div class="contenu">
  <br>
  Administateurs :<br><br>
  <form method="post" action="#">
    <select name="admin">
    <?php

$row = $pdo->query("SELECT * FROM Utilisateurs WHERE Rôle=1");
$tab = $row->fetchAll();
$row->closeCursor();
$i = 0;
$size = count($tab);

  while ($i < $size) {
  echo '<option value="' . $tab[$i]['ID'] . '">' . $tab[$i]['Prenom'] . ' ' . $tab[$i]['Nom'] . ' ( ' .  $tab[$i]['Mail'] . ' )</option>';
  $i = $i + 1;
  }
  ?>
     </select>
<br>
     <?php
     if ($_POST['admin'] && $_POST['admin'] != 1)
       {
$row = $pdo->prepare("UPDATE Utilisateurs SET Rôle=2 WHERE ID=:id");
$row->bindParam(':id', $_POST['admin'], PDO::PARAM_STR);
$row->execute();
header('Location: #');
}
     else if($_POST['admin'] == 1)
       {
echo "<br>Le super administrateur ne peut pas etre downgrade !<br>";
}

  ?>
<input type="submit" value="Downgrade" />     
</form>  
<br>
  <br><br>
  Utilisateurs :<br><br>
    <form method="post" action="#">
        <select name="user">
<?php
    $row = $pdo->query("SELECT * FROM Utilisateurs WHERE Rôle=2");
$tab = $row->fetchAll();
$row->closeCursor();
$i = 0;
$size = count($tab);

while ($i < $size) {
echo '<option value="' . $tab[$i]['ID'] . '">' . $tab[$i]['Prenom'] . ' ' . $tab[$i]['Nom'] . ' ( ' .  $tab[$i]['Mail'] . ' )</option>';
$i = $i + 1;
}
  ?>
     </select>
     <br>

<?php
     if ($_POST['user'])
       {
$row = $pdo->prepare("UPDATE Utilisateurs SET Rôle=1 WHERE ID=:id");
$row->bindParam(':id', $_POST['user'], PDO::PARAM_STR);
$row->execute();
header('Location: #');
}

  ?>
     
     <input type="submit" value="Upgrade" />
  </form>
 <br><br>
  </div>
  </div>

					     <?php }
else { ?>
  <div class="panier">
              <div class="titre"><h2>Autorisation requise !</h2></div>
    <div class="contenu"><br>Vous n&rsquo;êtes pas administrateur<br><br></div></div>

					    <?php }
  ?>

  <?php require_once('footer.php'); ?>
  </body>
  </html>