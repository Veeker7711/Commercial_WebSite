<?php
// navbar.php for web in /var/www/html/gendar_t
// 
// Made by GENDARME Thibaut
// Login   <gendar_t@etna-alternance.net>
// 
// Started on  Mon Nov  7 15:03:03 2016 GENDARME Thibaut
// Last update Thu Nov 17 13:03:19 2016 BERNARD Robin
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

$id = $_SESSION['ID'];
$row = $pdo->query("SELECT ID_produit FROM Produit_Utilisateur WHERE ID_utilisateur = \"".$id."\"");
$tab2 = $row->fetchAll();
$row->closeCursor();
$a = count($tab2);

?>
<link rel="stylesheet" href="Ressources/Style/style_navbar.css" />
<?php if ($_SESSION['Utilisateurs']){ ?>
<nav class="naviguation">
   <div class="logo">
   <a class="navigation-image" href="index.php" title="titre"><img src="Ressources/Images/logo.png"></a>
   </div>
   <ul>
   <li><a class="navigation-lien" href="materiel.php" title="Materiel">Matériel</a></li>
   <li><a class="navigation-lien" href="panier.php" title="Panier">Panier
   <?php if ($a == 0)
   echo "";
 else
   echo "(".$a.")";?></a></li>
     <li><a class="navigation-lien" href="deco.php" title="Deconnexion">Déconnexion</a></li>
   <li><a class="navigation-lien" href="profile.php" title="Compte">Mon Compte</a></li>
   <?php if ($_SESSION['Role'] == 1) {?>
      <li><a class="navigation-lien" href="panneladmin.php" title="Pannel admin">Administration</a></li>
   <?php } ?>
   
   <li> <form method="post" action="search.php">
   <input type="search" placeholder="Entrez un mot-clef" name="the_search"> <input type="submit" value="Rechercher">
   </form></li>
   
   <div class="user">    <font color="white" style="float: right; margin-right: 5px">Bonjour <?php echo $_SESSION['Prenom']?></font></div>
    </ul>
    </nav>
    
    
 <?php }
 else { ?>
    <nav class="naviguation">
      <div class="logo">
      <a class="navigation-image" href="index.php" title="titre"><img src="Ressources/Images/logo.png"></a>
      </div>
      <ul>
      <li><a class="navigation-lien" href="materiel.php" title="titre">Matériel</a></li>
      <li><a class="navigation-lien" href="panier.php" title="titre">Panier</a></li>
      <li><a class="navigation-lien" href="login.php" title="#">Connexion</a></li>
      <li><a class="navigation-lien" href="inscription.php" title="#">Inscription</a></li>
      
      <form method="post" action="search.php">
      <input  type="search" placeholder="Entrez un mot-clef" name="the_search" required>
      <input type="submit" value="Rechercher">
      </form>
      <div class="user">    <font color="white" style="float: right; margin-right: 5px">Bonjour Invité (e)</font></div>
      </ul>
      </nav>
     <?php }

           ?>