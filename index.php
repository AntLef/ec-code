<?php

require_once( 'controller/homeController.php' );
require_once( 'controller/loginController.php' );
require_once( 'controller/signupController.php' );
require_once( 'controller/mediaController.php' );
require_once( 'controller/contactController.php' );
require_once( 'controller/profileController.php' );
require_once( 'controller/historyController.php' );

/**************************
* ----- HANDLE ACTION -----
***************************/

if ( isset( $_GET['action'] ) ):

  switch( $_GET['action']):

    case 'login':

      if ( !empty( $_POST ) ) login( $_POST );
      else loginPage();

    break;

    case 'signup':

      signupPage( $_POST );

    break;

    case 'logout':

      logout();

    break;

    case 'contact':

      contactPage();

    break;

    case 'profile':

      profilePage();
      
    break;

    case 'history':

      historyPage();
      
    break;

    case 'favorite':

      mediaPage( "favorite" );
      
    break;

  endswitch;

else:

  $user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( $user_id ):

    mediaPage( "media" );

  else:
  
    homePage();
  
  endif;

endif;
