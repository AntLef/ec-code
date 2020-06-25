<?php

require_once( 'model/user.php' );

/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/

function signupPage( $post ) {

  if ( $post ):

    if ( filter_var($post['email'], FILTER_VALIDATE_EMAIL) && isset ( $post['email'] ) ):

      $data     = new stdClass();
      $data->email    = $post['email'];
      $data->password = $post['password'];
      $data->password_confirm = $post['password_confirm'];

      $user           = new User( $data );
      $userData       = $user->getUserByEmail();

      if( $userData == "" ):

        if( $post['password'] == $post['password_confirm'] ):
          
          $user->createUser();

          // function email verif
          // emailConfirmation($userData['id']);

          header( 'location: index.php' );

        else:
          $error_msg      = "Le mot de passe de confirmation ne correspond pas au mot de passe";
        endif;

      else:
        $error_msg      = "Email déja utilisé";
      endif;

    else:
      $error_msg      = "Veuillez renseigner un mail valide";
    endif;

  endif;
  
  require('view/auth/signupView.php');

}

/***************************
* ----- SIGNUP FUNCTION -----
***************************/
