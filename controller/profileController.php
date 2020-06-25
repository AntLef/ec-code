<?php

require_once( 'model/user.php' );


/****************************
* ----- LOAD PROFILE PAGE -----
****************************/

function profilePage() {

  if ( isset ( $_GET["submit"] ) ):

    if ( $_GET["submit"] == "delete" ):

      User::deleteAccount( $_SESSION['user_id'] );
      logout();
  
    elseif ( $_GET["submit"] == "modify_email" ):

      if( $_POST['email'] && User::ifEmailExist( $_POST['email'] )[0] == 0 ):
      
        User::updateEmailAccount( $_SESSION['user_id'], $_POST['email'] );
        $valid_msg_1      = "L'Email à bien été modifié";

      else:
      
        $error_msg_1      = "Email déja utilisé ou invalide";
      
      endif;

    elseif ( $_GET["submit"] == "modify_password" ):

      //  $_POST['old_password']

      if( User::ifGoodPassword( $_SESSION['user_id'], $_POST['old_password'] ) == true && $_POST['new_password'] ):
      
        User::updatePasswordAccount( $_SESSION['user_id'], $_POST['new_password'] );
        $valid_msg_2      = "Le mot de passe à bien été modifié";

      else:
      
        $error_msg_2      = "Le mot de passe de confirmation n'est pas valide";
      
      endif;

    endif;

  endif;



  require('view/profileView.php');

}

/***************************
* ----- PROFILE FUNCTION -----
***************************/

// modifyUser