<?php
// inscription.php for inscription in /var/www/html/php/gendar_t/dynamique
//
// Made by BERNARD Robin
// Login   <bernar_r@etna-alternance.net>
//
// Started on  Thu Nov 10 09:50:41 2016 BERNARD Robin
// Last update Fri Nov 18 09:37:16 2016 BERNARD Robin
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
if ($_SESSION['ID'] == NULL)
  {
    header('Location: index.php');
  }
else
  {

if (!($_POST['nom']))
  {
    ?>
    <html>
      <head>
        <link rel="stylesheet" type="text/css" href="Ressources/Style/inscription.css">
        <meta charset="utf-8" />
      <title>Bizarts - Formulaire identite</title>
      
      </head>
      
      <body>
	<?php require_once('navbar.php'); ?>
        <form method="post" action="profile2.php">
          <div class="identite">
            <div class="titres">
              <h2>Votre identité</h2>
            </div>
            <br>
            <div class="contenu">
              <label for="nom">Nom :<br> <font size="2">2 caractere min</font></label>
	      <br>
	      <input  pattern=".{2,}" type="text" placeholder="Saisissez votre nom" name="nom" id="nom" required />
	      <br>
	      <br>
	      <label for="prenom">Prénom : <br><font size="2">2 caractere min</font></label>
	      <br>
	      <input type="text"  pattern=".{2,}" placeholder="Saisissez votre Prenom" name="prenom" id="prenom" required/>
	      <br>
	      <br>
	      Gender:
              <input type="radio" name="gender" value="F">Femelle
	      <input type="radio" name="gender" value="M">Male
	      <br>
	      <br>
	      <label for="prenom">Date de naissance :</label><br>
	      <input type="date" name="bday"><br>
	      <br>
	      <label for="telephone">Numero de telephone :</label>
	      <br>
	      <input pattern=".{10,}"  placeholder="Saisissez votre numero" name="telephone" id="telephone" required/>
	      <br>
	      <br>
	      <label for="email">Email :</label>
	      <br>
	      <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Saisissez votre Email" name="email" id="email" required/>
	      <br>
	      <br>
	      <label for="password">Mot de passe :<br> <font size="2">6 caractere min</font></label>
	      <br>
	      <input  pattern=".{6,}" type="password" placeholder="Mot de passe" name="password" id="password" required/>
	      <br>
	      <br>
	      <label for="confirm_password">Confirmation mot de passe :</label>
	      <br>
	      <input type="password" placeholder="Confirmez mot de passe" name="confirm_password" id="confirm_password" required>
	      <br><br>
  <input type="submit" value="Envoyer" />	      
	      <br><br>
					      </form>
	    </div>
	  </div>

      <footer>
	<h6>Copiright &copy gendar_t reuter_f bernar_r <a href="contact.php">Contactez Nous</a></h6>
      </footer>
    </html>
				<?php
				}
else {
  $error = 0;
  session_start();
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $datenaissance= $_POST['bday'];
  $telephone= $_POST['telephone'];
  $ville = $_POST['ville'];
  $adresse = $_POST['adresse'];
  $mail = $_POST['email'];
  $password = $_POST['password'];
  
  $passwordverif = $_POST['confirm_password'];
  if ($passwordverif !=  $password) {
    $error = 1;
    $error_password = 1;
  }
  $password = hash('sha256', $password);
  
  $codepostal = $_POST['postal'];
  $pays = $_POST['pays'];
  $sexe = $_POST["gender"];
  
  $role = "2";

  $datemodification = date("y.m.d");

  $ID = $_SESSION['ID'];
  $row2 = $pdo->query("SELECT Mail FROM Utilisateurs WHERE ID !=".$ID);
  $tab2 = $row2->fetchALL();
  $row2->closeCursor();
  $i = 0;
  $result = count($tab2);
  while ($i < $result)
    {
      if ($tab2[$i]['Mail'] == $mail)
	{
	  $error = 2;
	  $i++;
	}
      else
	$i++;
    }
  if ($error == 0)
    {
      $row = $pdo->prepare("UPDATE Utilisateurs SET Nom=:nom, Prenom=:prenom, Date_de_naissance=:datenaissance, Telephone=:telephone, Mail=:email, Sexe=:sexe, Password=:password, Date_modification=:datemodification WHERE ID=".$ID);
      $row->bindParam(':nom', $nom, PDO::PARAM_STR);
      $row->bindParam(':prenom', $prenom, PDO::PARAM_STR);
      $row->bindParam(':datenaissance', $datenaissance, PDO::PARAM_STR);
      $row->bindParam(':telephone', $telephone, PDO::PARAM_STR);
      
      $row->bindParam(':email', $mail, PDO::PARAM_STR);
      $row->bindParam(':sexe', $sexe, PDO::PARAM_STR);
      $row->bindParam(':password', $password, PDO::PARAM_STR);
      $row->bindParam(':datemodification', $datemodification, PDO::PARAM_STR);
      $row->execute();
      header('Location: index.php');
    }
  else
    {?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="Ressources/Style/inscription.css">
    <meta charset="utf-8" />
    <title>Inscription</title>
  </head>
  
  <body>
    <?php require_once('navbar.php'); ?>
    <form method="post" action="profile2.php">
      <div class="identite">
	<div class="titres">
	  <h2>Votre identité</h2>
	</div>
	<br>
	<div class="contenu">
	  <label for="nom">Nom :<br> <font size="2">2 caractere min</font></label>
	  <br>
	  <input  pattern=".{2,}" type="text" placeholder="Saisissez votre nom" name="nom" id="nom" required />
	  <br>
	  <br>
	  <label for="prenom">Prénom : <br><font size="2">2 caractere min</font></label>
	  <br>
	  <input type="text"  pattern=".{2,}" placeholder="Saisissez votre Prenom" name="prenom" id="prenom" required/>
	  <br>
	  <br>
	  Gender:
	  <input type="radio" name="gender" value="F">Femelle
	  <input type="radio" name="gender" value="M">Male
	  <br>
	  <br>
	  <label for="prenom">Date de naissance :</label><br>
	  <input type="date" name="bday"><br>
	  <br>
	  <label for="telephone">Numero de telephone :</label>
	  <br>
	  <input pattern=".{10,}"  placeholder="Saisissez votre numero" name="telephone" id="telephone" required/>
	  <br>
	  <br>
	  <label for="email">Email :</label>
	  <br>
	  <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Saisissez votre Email" name="email" id="email" required/>
	  <br>
			       <?php if ($error == 2)
			       echo "<br><font color=\"red\" size=\"5\">Email deja utilise</font><br>";    ?>
	
	  <br>
	  <label for="password">Mot de passe :<br> <font size="2">6 caractere min</font></label>
	  <br>
	  <input  pattern=".{6,}" type="password" placeholder="Mot de passe" name="password" id="password" required/>
	  <br>
	  <br>
	  <label for="confirm_password">Confirmation mot de passe :</label>
	  <br>
	  <input type="password" placeholder="Confirmez mot de passe" name="confirm_password" id="confirm_password" required>
	  <br>
					  <?php if ($error_password == 1)
					  echo "<br><font color=\"red\" size=\"5\">Mot de passe different a la verification</font><br>";    ?>
	
					  <br>
	  <input type="submit" value="Envoyer" />
	  <br><br>
    </form>
    </div>
    </div>
    
    <footer>
      <h6>Copiright &copy gendar_t reuter_f bernar_r <a href="contact.php">Contactez Nous</a></h6>
    </footer>
</html>


<?php }
      }
  }   ?>








