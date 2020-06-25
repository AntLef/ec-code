<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage( $page ) {

  if ( !isset( $_GET['media'] ) ):

    $search = isset( $_GET['title'] ) ? $_GET['title'] : null;
    $medias = Media::filterMedias( $search );

    if ( isset( $_GET['like'] ) ):
      Media::addFavorite( $_GET['like'], $_SESSION['user_id'] );
    endif;

    require('view/mediaListView.php');
  
  else:

    $medias = Media::getMediasById( $_GET['media'] );

    if ( $medias[0]['type'] == "series" ):

      $series = Media::filterSeries( $medias[0]['id'] );
      $info_series = Media::filterInfoSeries( $medias[0]['id'] );

      $first_url = Media::firstEpisodeToSeries( $medias[0]['id'] );
      $url = isset( $_GET['url'] ) ? $_GET['url'] : $first_url['trailer_url'] ;

    endif;

    require('view/mediaView.php');
  
  endif;

}
