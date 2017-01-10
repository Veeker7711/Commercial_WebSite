
<?php
// deco.php for deco in /var/www/html/php/gendar_t/dynamique
// 
// Made by BERNARD Robin
// Login   <bernar_r@etna-alternance.net>
// 
// Started on  Mon Nov 14 12:18:16 2016 BERNARD Robin
// Last update Thu Nov 17 17:12:29 2016 GENDARME Thibaut
session_start(); 
session_unset();
session_destroy();
header('Location: index.php');  
  ?>

