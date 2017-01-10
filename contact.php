<?php
// contact.php for contact in /var/www/html/php/gendar_t/statique
// 
// Made by BERNARD Robin
// Login   <bernar_r@etna-alternance.net>
// 
// Started on  Tue Nov  8 09:05:49 2016 BERNARD Robin
// Last update Fri Nov 18 09:36:15 2016 BERNARD Robin
//
session_start();
if (!($_POST['contenumail'])){

?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="Ressources/Style/inscription.css">
    <link rel="icon" type="image/png" href="ressources/logo.png" />
    <meta charset="utf-8" />
 <title>Bizarts - Contacte</title>
  </head>
  <body>
    <header>
   <?php require_once("navbar.php"); ?>
    </header>
    <form method="post" action="contact.php">
      <div class="identite">
        <div class="titres">
	  <h2>Envoyer un e-mail au Service Client BizArt</h2> 
	</div>
	<br>
        <div class="contenu">
	  <label for="destinataire">A: Service client BizArt</label>
	 <br>
	  <br>
	    <label for="email">Email :</label><br>
          
				 <?php
				 if (!($_SESSION['Utilisateurs']))
				   {?>
				    <br>
				 <input type="text" placeholder="Entrez votre adresse mail" name="email" id="Objet" required/>
				    <br>
				    <?php }
  else
    {
      echo "<br>" . $_SESSION['mail']  . "<br>";
    }?>
	  <br>
	  <label for="telephone">Objet :</label><br>
	  <br>
	      <input type="text" placeholder="Entrez le sujet" name="objet" id="objet" required/>
	 
	  <br>
	  <br>
	  <label for="contenumail">Contenu de votre email :</label>
	  <br><br>
	  <div class="text">
	   <textarea rows="5" cols="100" placeholder="Exemple : J'ai une question a propos du pinceau...etc" name="contenumail" required ></textarea>
	</div>
	  <br>
<br>
	   <input type="submit" value="Envoyer" /><br>
 	  <br>
	</div>
      </div>
     
	</div>
       </div>
<?php require_once('footer.php'); ?>
</body>
</html>

<?php
				     }
else {

  $connection = new PDO("mysql:host=127.0.0.1;dbname=bizarts_gendar_t","admin","admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
  if (!($_SESSION['Utilisateurs']))
    {
      $row = $connection->prepare('INSERT INTO Contact(Email,Objet,Contenu) VALUE (:mail, :objet, :contenumail)');
      $row->bindParam(':mail', $_POST['email'], PDO::PARAM_STR);
      $row->bindParam(':objet', $_POST['objet'], PDO::PARAM_STR);
      $row->bindParam(':contenumail', $_POST['contenumail'], PDO::PARAM_STR);
      $row->execute();
      $row->closeCursor();
    }
  else
    {
      $row = $connection->prepare('INSERT INTO Contact(Email,Objet,Contenu) VALUE (:mail, :objet, :contenumail)');
      $row->bindParam(':mail', $_SESSION['mail'], PDO::PARAM_STR);
      $row->bindParam(':objet', $_POST['objet'], PDO::PARAM_STR);
      $row->bindParam(':contenumail', $_POST['contenumail'], PDO::PARAM_STR);
      $row->execute();
      $row->closeCursor();
    }
  ?>
  <?php
  
  header('refresh:3;url=index.php');
?>
 
<html>
          <head>
            <link rel="stylesheet" type="text/css" href="Ressources/Style/inscription.css">
            <meta charset="utf-8" />
            <title>Inscription</title>
          </head>
         <div class="identite">
             <div class="titres">
               <h2>Felicitation</h2>
             </div>
             <br>
             <div class="contenu">
               <label for="nom">Message envoyé<br> </label>
				              <br>
<?php } ?>
