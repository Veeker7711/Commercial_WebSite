<?php
// articles.php for WEB in /var/www/html/Web/PHP/dynamique
// 
// Made by REUTER Faustine
// Login   <reuter_f@etna-alternance.net>
// 
// Started on  Mon Nov 14 16:19:28 2016 REUTER Faustine
// Last update Thu Nov 17 14:22:42 2016 GENDARME Thibaut
//
?>

<html>
<head>
<meta charset="UTF-8">
        <link rel="stylesheet" href="Ressources/Style/style_details.css" />
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
$ok = 0;
$size = count($tab);

while ($j !== $max && $j <= $max)
  {
    if ($j == $_GET['id'])
      $ok = 1;
    $j = $j + 1;
  }

$row = $pdo->query("SELECT * FROM Commentaires ORDER BY ID DESC;");
$com = $row->fetchAll();
$row->closeCursor();
$j = 0;
$taille = count($com);

if ($ok = 1) {
  $ok = 0;
while ($i < $size) {
  if ($tab[$i]['ID'] == $_GET['id'])
    {
      $ok = 1;
      ?>  
<div class="block">
  <div class="titres">
   <?php  echo '<h2>' . $tab[$i]['Libelle'] . '</h2>'; ?>
  </div>
   <?php
   echo '<br><img src="' . $tab[$i]['Image'] . '"><br><br>';
      echo $tab[$i]['Description'];
      echo '<br><br>' . $tab[$i]['Prix_vente'] . ' &euro;<br><br>'; ?>
	<?php  echo "<form method=\"post\" action=\"articles.php?id=" . $tab[$i]['ID']  . "\"><input type='submit' value='Ajouter au pannier'><input type=\"number\" name=\"nbr\" class=\"nbr\" value=\"1\">Qté<input type=\"hidden\" name=\"id\" value=\"" . $tab[$i]['ID'] . "\"></form><br><br>";
	if (intval($_POST['id']) == intval($tab[$i]['ID']))
	  {
	    if ($_SESSION['ID'])
	      {
		if (intval($_POST['nbr']) > 0)
		  echo "<br>Article(s) Ajouté au panier !";
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
		header("location: login.php");
	      }
	    
	  }
        
	?>
  </div>

             <div class="commentaire">
                     <div class="titres">
             <h2>Avis</h2>
       </div>
       
       <?php
      $check = 0;
	while ($j < $taille && $com[$j]['ID_produit'] == $_GET['id']) {
	  $check = 1;
	  echo '<br><strong>' . $com[$j]['Prenom_user'] . ' ' . $com[$j]['Nom_user'] . '</strong><br>';
	  echo $com[$j]['Note'] . '/5 : ' . $com[$j]['Avis'] . '<br><br>';
	  $j = $j + 1;
	}
	if ($check == 0)
	  {
	    echo "<br>Aucun commentaire sur cet article.<br>Soyez le premier a donner votre avis !<br><br>";
	  }
	echo '__________<br><br>';
	
	if ($_SESSION['Utilisateurs']){ ?>
       <form action="refresh.php" method='post'>


	    Note : <br><br>
	    <div class="note">
<select name="note">
	      <option  value="5">5/5</option>
	      <option  value="4">4/5</option>
	      <option  value="3">3/5</option>
	      <option  value="2">2/5</option>
	     <option   value="1">1/5</option>  
	    </select>
	    </div>


	    <br>
	  	    <br>Laisser un commentaire :<br><br> <textarea name="commentaire" rows="5" cols="100" required  placeholder="Exemple : Voici un exemple de commentaire"></textarea>
	    <?php echo " <br><br><input type=\"submit\" value=\"Envoyer\"><br><br><input type=\"hidden\" name=\"idproduit\" value=\"" . $tab[$i]['ID'] . "\">";?>
	        </form>
	    <?php }
      else
	{
	  echo "Veuillez vous connecter si vous souhaitez laisser un avis sur cet article.<br><br>";
	}
      
      if ($_POST['commentaire'])
	{
	  header('refresh.php');
	}
      ?>
	  
            
   </div>
       
       <?php }
      $i = $i + 1;
}
}
if ($ok == 0)
  { ?>
    <div class="block">
      <div class="titres">
    <h2>Op&eacute;ration impossible</h2>
		                </div>
		    <h5>Le produit est inexistant.<br><br></h5>
		    </div>

		    <?php }?>

<?php require_once("footer.php");?>
</body>
</html>