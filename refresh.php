<?php
// refresh.php for web in /var/www/html/Web/PHP/dynamique
// 
// Made by REUTER Faustine
// Login   <reuter_f@etna-alternance.net>
// 
// Started on  Tue Nov 15 16:37:00 2016 REUTER Faustine
// Last update Thu Nov 17 12:49:14 2016 REUTER Faustine
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


$row = $pdo->prepare('INSERT INTO Commentaires(Note, Avis, Nom_user, Prenom_user, ID_produit) VALUE (:note, :avis, :nom, :prenom, :idproduit)');
$row->bindParam(':note', $_POST['note'], PDO::PARAM_STR);
$row->bindParam(':avis', $_POST['commentaire'], PDO::PARAM_STR);
$row->bindParam(':nom', $_SESSION['Utilisateurs'], PDO::PARAM_STR);
$row->bindParam(':prenom', $_SESSION['Prenom'], PDO::PARAM_STR);
$row->bindParam(':idproduit', $_POST['idproduit'], PDO::PARAM_STR);

$row->execute();
$row->closeCursor();

header("location: articles.php?id=".$_POST['idproduit']);