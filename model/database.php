<?php

/*************************************
* ----- INIT DATABASE CONNECTION -----
*************************************/

function init_db() {
  try {

    $host     = 'localhost:3308';
    $dbname   = 'codflix';
    $charset  = 'utf8';
    $user     = 'mamp';
    $password = '1234';

    $db = new PDO( "mysql:host=$host;dbname=$dbname;charset=$charset", $user, $password );

  } catch(Exception $e) {

    die( 'Erreur : '.$e->getMessage() );

  }

  return $db;
}
