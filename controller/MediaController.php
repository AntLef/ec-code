<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

  if ( !isset( $_GET['media'] ) ):

    $search = isset( $_GET['title'] ) ? $_GET['title'] : null;
    $medias = Media::filterMedias( $search );

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
