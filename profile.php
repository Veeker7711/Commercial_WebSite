
<?php
// profile.php for profil in /var/www/html/php/gendar_t/dynamique
// 
// Made by BERNARD Robin
// Login   <bernar_r@etna-alternance.net>
// 
// Started on  Tue Nov 15 10:30:47 2016 BERNARD Robin
// Last update Fri Nov 18 09:36:42 2016 BERNARD Robin
//
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=bizarts_gendar_t', "admin", "admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$row = $pdo->prepare("SELECT * FROM Utilisateurs WHERE ID = :ID");
$row->bindParam(':ID', $_SESSION['ID'], PDO::PARAM_STR);
$row->execute();
$tab = $row->fetchALL();
$row->closeCursor();




?>
<html>
<head>
<meta charset="UTF-8">
        <link rel="stylesheet" href="Ressources/Style/style_profile.css" />
        <link rel="icon" type="image/png" href="Ressources/Images/logo.png" />
        <title>BizArts - Mon compte</title>
   <?php require_once("navbar.php"); ?>
        </head>
        <body>

   <div class="mon">
 <div class="titres">
   <h2>MON COMPTE</h2>
   </div>
   </div>
<!-- ONGLET TRADITIONNEL -->

       <div class="tradi">
           <div class="titres">
   <h2>Identité :</h2>
           </div>
           <div class="contenu">
             <br>
  <?php $i = 0;
  echo "Compte crée le : ".$tab[0]["Date_creation"]."<br><br>";
  echo "Nom : ".$tab[0]["Nom"]."<br>";
echo "Prenom : ".$tab[0]["Prenom"]."<br>";
echo "Date de naissance : ".$tab[0]["Date_de_naissance"]."<br>";
echo "Email : ".$tab[0]["Mail"]."<br>";
echo "Telephone : ".$tab[0]["Telephone"]."<br>";
echo "Sexe : ".$tab[0]["Sexe"]."<br>";

?>
<br>
<form action="profile2.php">
<input type="submit" value="Modifier ces information">
</form>
  <br>
  <br>
        </div>
         </div>

  <!-- ONGLET DIGITAL -->

   <div class="digi">
         <div class="titres">
   <h2>Votre adresse de livraison :</h2>
   </div><br>
         <div class="contenu">
<?php
  echo "Ville : ".$tab[0]["Ville"]."<br>";
echo "Adresse : ".$tab[0]["Adresse"]."<br>";
echo "Code Postal :".$tab[0]["Code_postale"]."<br>";
echo "Pays : ".$tab[0]["Pays"]."<br>";
?>
<br>
<form action="profile3.php">
 <input type="submit" value="Modifier ces information">
  </form>
  <br>
  <br>
  </div>
                      </div>
  <br>

  <?php require_once("footer.php");?>
       </body>
   </html>

  <?php
