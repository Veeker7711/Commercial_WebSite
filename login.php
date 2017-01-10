<?php
// login.php for web in /var/www/html/gendar_t/dynamique
// 
// Made by GENDARME Thibaut
// Login   <gendar_t@etna-alternance.net>
// 
// Started on  Tue Nov  8 15:10:00 2016 GENDARME Thibaut
// Last update Thu Nov 17 14:18:25 2016 GENDARME Thibaut
//
?>
<html>
<head>
<link rel="icon" type="image/png" href="ressources/logo.png" />
   <link rel="stylesheet" type="text/css" href="Ressources/Style/login.css">
   <meta charset="utf-8" />
   <title>Bizarts: Connexion</title>
   </head>
<?php if (!($_POST['email'])){ ?>
<body>
 <?php require_once('navbar.php'); ?>
<form method="post" action="login.php">
    <div class="identite">
   <div class="titres">
   <h2>Connectez vous :</h2>
   </div>
   <br>
   <div class="contenu">
   <label for="nom">Adesse mail :</label>
   <br>
   <input type="email" placeholder="Saisissez votre mail" name="email" id="email" required />
   <br>
   <br>
   <label for="password">Mot de passe :</label>
   <br>
   <input type="password" placeholder="Saisissez votre Mdp" name="password" id="password" required/>
   <br>
   <br>
   <input type="submit" name="Envoyer" value="Envoyer" />
   </div>
   </div>
   <?php require_once('footer.php');?>
   </body>
   </html>
   <?php }
 else {
   $pdo = new PDO('mysql:host=localhost;dbname=bizarts_gendar_t', "admin", "admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
   $row = $pdo->prepare("SELECT ID,Mail FROM Utilisateurs WHERE Mail = :mail");
   $row->bindParam(':mail', $_POST['email'], PDO::PARAM_STR);
   $row->execute();
   $tab_mail = $row->fetch();
   $row->closeCursor();
   $pwd = hash('sha256', $_POST["password"]);
   $row = $pdo->prepare("SELECT ID,Password FROM Utilisateurs WHERE Password = :pwd");
   $row->bindParam(':pwd', $pwd, PDO::PARAM_STR);
   $row->execute();
   $tab_pwd = $row->fetch();
   $row->closeCursor();
   if ($tab_mail["Mail"] && $tab_pwd["Password"] && $tab_mail['ID'] == $tab_pwd['ID'])
     {
       session_start();
       $row = $pdo->query("SELECT * FROM Utilisateurs WHERE ID=\"" . $tab_mail['ID'] . "\"");
       $tab_nom = $row->fetch();
       $_SESSION['Utilisateurs'] = $tab_nom['Nom'];
       $_SESSION['Prenom'] = $tab_nom['Prenom'];
       $_SESSION['ID'] = $tab_nom['ID'];
       $_SESSION['mail'] = $tab_nom['Mail'];
       $_SESSION['Role'] = $tab_nom['Rôle'];
       if ($_SESSION['url'])
	 {
	   $tmp = $_SESSION['url'];
	   $_SESSION['url'] = NULL;
	   header("location: ".$tmp);
	 }
       ?>
       <body>
	  <?php require_once('navbar.php'); ?>
	  <div class="identite">
	  <div class="titres">
	  <h2> Operation reussi ! </h2>
	  </div>
	  <br>
	  <div class="contenu">
	  <label>Vous venez de vous connectez !<br><?php echo $_SESSION['Utilisateurs']. "  " .  $_SESSION['Prenom'];?></label>
	  <br>
	  </div>
	  </div>
	    
	  <?php require_once('footer.php');
	  }
   else
     { ?>
       <body>
       <?php require_once('navbar.php'); ?>
       <form method="post" action="login.php">
       <div class="identite">
       <div class="titres">
       <h2>Connectez vous :</h2>
       </div>
       <br>
       <div class="contenu">
       <label for="nom">Adesse mail :</label>
       <br>
       <input type="email" placeholder="Saisissez votre mail" name="email" id="email" required />
       <br>
       <br>
       <label for="password">Mot de passe :</label>
       <br>
       <input type="password" placeholder="Saisissez votre Mdp" name="password" id="password" required/>
       <br>
       <br>
       <input type="submit" name="Envoyer" value="Envoyer" />
       <p>Invalid Password/Email</p>
       </div>
       </div>
       <?php require_once('footer.php');?>
       </body>
       </html>
       
<?php }
 }?>