<?php 
// inscription.php for inscription in /var/www/html/php/gendar_t/dynamique
// 
// Made by BERNARD Robin
// Login   <bernar_r@etna-alternance.net>
// 
// Started on  Thu Nov 10 09:50:41 2016 BERNARD Robin
// Last update Fri Nov 18 09:37:40 2016 BERNARD Robin
//
 try
{
  $pdo = new PDO('mysql:host=localhost;dbname=bizarts_gendar_t', "admin", "admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

session_start();

if ($_SESSION['ID'] == NULL)
  {
    header('Location: index.php');
  }
else
  {

if (!($_POST['ville']))
{
 
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="Ressources/Style/inscription.css">
    <meta charset="utf-8" />
  <title>Bizarts - Adresse de livraison</title>
    
  </head>
  
  <body>
   <?php require_once('navbar.php'); ?>
    <form method="post" action="profile3.php">

      <div class="adresse">
	<div class="titres">
	  <h2>Votre adresse de livraison</h2>
	</div>
	<div class="contenu">
	  <br>
	  <label for="adresse">Adresse ligne 1 : </label>
	  <br>
	  <input   pattern=".{6,}"  type="text" placeholder="Rue, voie" name="adresse" id="adresse" required/>
	  <br>
	  <br>
	  <label for="ville">Ville : </label>
	  <br>
	  <input   pattern=".{3,}" type="text" placeholder="Ville" name="ville" id="adresse" required/>
	  <br>
	  <br>
	  <label for="postal">Code postal : </label>
	  <br>
	  <input type="number" pattern=".{5,}"  placeholder="Code postal" name="postal" id="postal" required/>
	  <br>
	  <br>
	  <label for=pays>Pays: </label>
	  <br>
	  <input type="text"  pattern=".{2,}"placeholder="Pays" name="pays" id="pays"  required>
	  
	  <br>
	  <br>
	  <input type="submit" value="Envoyer" />
	</div>
      </div>
   </form>
  </body>
  <footer>
    <h6>Copiright &copy gendar_t reuter_f bernar_r <a href="contact.html">Contactez Nous</a></h6>
        </footer>
</html>
  <?php
			    }
else {
  session_start();
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $datenaissance= $_POST['bday'];
  $telephone= $_POST['telephone'];
  $ville = $_POST['ville'];
  $adresse = $_POST['adresse'];
  $mail = $_POST['email'];
  $password = $_POST['password'];
  
  
  $codepostal = $_POST['postal'];
  $pays = $_POST['pays'];
      $error = "1";
      $datemodification = date("y.m.d");
      $ID = $_SESSION['ID'];
      if ($error == 1)
    {
      $row = $pdo->prepare("UPDATE Utilisateurs SET Ville=:ville, Adresse=:adresse, Code_postale=:postal, Pays=:pays, Date_modification=:datemodification WHERE ID=".$ID);
      $row->bindParam(':ville', $ville, PDO::PARAM_STR);
      $row->bindParam(':adresse', $adresse, PDO::PARAM_STR);
      $row->bindParam(':postal', $codepostal, PDO::PARAM_STR);
      $row->bindParam(':pays', $pays, PDO::PARAM_STR);
      $row->bindParam(':datemodification', $datemodification, PDO::PARAM_STR);
      $row->execute();
      header('Location: index.php');
    }
  else
    {
?>
 <html>
   <head>
     <link rel="stylesheet" type="text/css" href="Ressources/Style/inscription.css">
     <meta charset="utf-8" />
     <title>Inscription</title>
   </head>
   
   <body>
     <?php require_once('navbar.php'); ?>
     <form method="post" action="inscription.php">
       
       <div class="adresse">
         <div class="titres">
           <h2>Votre adresse de livraison</h2>
         </div>
         <div class="contenu">
           <br>
           <label for="adresse">Adresse ligne 1 : </label>
	   <br>
	   <input   pattern=".{6,}"  type="text" placeholder="Rue, voie" name="adresse" id="adresse" required/>
	   <br>
	   <br>
	   <label for="ville">Ville : </label>
	   <br>
	   <input   pattern=".{3,}" type="text" placeholder="Ville" name="ville" id="adresse" required/>
	   <br>
	   <br>
	   <label for="postal">Code postal : </label>
	   <br>
	   <input type="number" pattern=".{5,}"  placeholder="Code postal" name="postal" id="postal" required/>
	   <br>
	   <br>
	   <label for=pays>Pays: </label>
	   <br>
	   <input type="text"  pattern=".{2,}"placeholder="Pays" name="pays" id="pays"  required>
	   
	   <br>
	   <br>
	   <input type="submit" value="Envoyer" />
	 </div>
       </div>
     </form>
   </body>
   <footer>
     <h6>Copiright &copy gendar_t reuter_f bernar_r <a href="contact.html">Contactez Nous</a></h6>
   </footer>
 </html>
			     
			     <?php }

}
  }
  ?>
