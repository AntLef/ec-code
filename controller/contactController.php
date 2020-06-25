<?php

require_once( 'model/user.php' );

/****************************
* ----- LOAD CONTACT PAGE -----
****************************/

function contactPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  require('view/contactView.php');
  
}

/***************************
* ----- CONTACT FUNCTION -----
***************************/
