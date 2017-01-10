<?php
// login.php for web in /var/www/html/gendar_t/dynamique
// 
// Made by GENDARME Thibaut
// Login   <gendar_t@etna-alternance.net>
// 
// Started on  Tue Nov  8 15:10:00 2016 GENDARME Thibaut
// Last update Thu Nov 17 15:42:24 2016 BERNARD Robin
//
?>
<html>
<head>
<link rel="icon" type="image/png" href="ressources/logo.png" />
   <link rel="stylesheet" type="text/css" href="Ressources/Style/login_float.css">
   <meta charset="utf-8" />
   <title>Bizarts: Connexion</title>
   </head>
<?php if (!($_POST['email'])){ ?>
<body>
</div></div>  
<form method="post" action="#">
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
   </body>
   </html>
   <?php }
 else {
   $pdo = new PDO('mysql:host=localhost;dbname=bizarts_gendar_t', "admin", "admin");
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
       $row = $pdo->query("SELECT ID,Nom,Prenom FROM Utilisateurs WHERE ID=\"" . $tab_mail['ID'] . "\"");
       $tab_nom = $row->fetch();
       $_SESSION['Utilisateurs'] = $tab_nom['Nom'];
       $_SESSION['Prenom'] = $tab_nom['Prenom'];
       $_SESSION['ID'] = $tab_nom['ID'];
       header("location: ". $_SESSION['url']);
     }
   else
     { ?>
       <body>
</div></div>  
 <form method="post" action="#">
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
       </body>
       </html>
       
<?php }
 }?>