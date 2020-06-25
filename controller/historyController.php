<?php

require_once( 'model/history.php' );
require_once( 'model/media.php' );

/****************************
* ----- LOAD PROFILE PAGE -----
****************************/

function historyPage() {

  if ( isset ( $_GET["submit"] ) ):

    if ( $_GET["submit"] == "delete" ):

      History::deleteHistory( $_SESSION['user_id'], $_GET["id"] );

    elseif ( $_GET["submit"] == "alldelete" ):

      History::deleteAllHistory( $_SESSION['user_id'] );

    endif;

  endif;


  $historys = History::all( $_SESSION['user_id'] );

  require('view/historyView.php');

}

/***************************
* ----- PROFILE FUNCTION -----
***************************/
