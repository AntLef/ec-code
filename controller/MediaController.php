<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

  if ( !isset( $_GET['media'] ) ):

    $search = isset( $_GET['titl'] ) ? $_GET['titl'] : null;
    $medias = Media::filterMedias( $search );

    require('view/mediaListView.php');
  
  else:

    $medias = Media::getMediasById( $_GET['media'] );

    require('view/mediaView.php');
  
  endif;

}
