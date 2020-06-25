<?php

require_once( 'database.php' );

class User {

  protected $id;
  protected $email;
  protected $password;

  public function __construct( $user = null ) {

    if( $user != null ):
      $this->setId( isset( $user->id ) ? $user->id : null );
      $this->setEmail( $user->email );
      $this->setPassword( $user->password, isset( $user->password_confirm ) ? $user->password_confirm : false );
    endif;
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setEmail( $email ) {
    $this->email = $email;
  }

  public function setPassword( $password ) {
    $this->password = password_hash($password, PASSWORD_BCRYPT);
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  /***********************************
  * -------- CREATE NEW USER ---------
  ************************************/

  public function createUser() {

    // Open database connection
    $db   = init_db();

    // Check if email already exist
    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ) );

    if( $req->rowCount() > 0 ) throw new Exception( "Email ou mot de passe incorrect" );

    // Insert new user
    $req->closeCursor();

    $req  = $db->prepare( "INSERT INTO user ( email, password ) VALUES ( :email, :password )" );
    $req->execute( array(
      'email'     => $this->getEmail(),
      'password'  => $this->getPassword()
    ));

    // Close databse connection
    $db = null;

  }

  /***********************************
  * ---------- UPDATE USER -----------
  ************************************/

  public static function deleteAccount( int $id_user ) {

    // Open database connection
    $db   = init_db();

    // Check if email already exist
    $req  = $db->prepare( "DELETE FROM user WHERE id = ?" );
    $req->execute( array( $id_user ) );

    $req  = $db->prepare( "DELETE FROM favorite WHERE `user_id` = ?" );
    $req->execute( array( $id_user ) );

    // Close databse connection
    $db = null;

  }

  public static function updateEmailAccount( int $id_user, string $new_email ) {

    // Open database connection
    $db   = init_db();

    // Check if email already exist
    $req  = $db->prepare(  "UPDATE user SET email=? WHERE id = ? " );
    $req->execute( array( $new_email, $id_user ) );

    // Close databse connection
    $db = null;

  }

  public static function updatePasswordAccount( int $id_user, string $new_password ) {

    // Open database connection
    $db   = init_db();

    // Check if email already exist
    $req  = $db->prepare(  "UPDATE user SET `password`=? WHERE id = ? " );
    $req->execute( array( password_hash($new_password, PASSWORD_BCRYPT) , $id_user ) );

    // Close databse connection
    $db = null;

  }

  /**************************************
  * -------- GET USER DATA BY ID --------
  ***************************************/

  public static function getUserById( $id ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE id = ?" );
    $req->execute( array( $id ));

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }

  /***************************************
  * ------- GET USER DATA BY EMAIL -------
  ****************************************/
  
  public function getUserByEmail() {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ));

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }

  public static function ifEmailExist( $email ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT COUNT(id) FROM user WHERE email = ?" );
    $req->execute( array( $email ));

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }

  /***************************************
  * ------- VERIFY USER DATA BY ID -------
  ****************************************/

  public static function ifGoodPassword( $id, $password ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT password FROM user WHERE id = ?" );
    $req->execute( array( $id ));

    // Close databse connection
    $db   = null;

    $result = $req->fetch();

    print_r(  $result['password'] );

    if (password_verify( $password, $result['password'] ) == true):
      return true;
    else:
      return false;
    endif;
    
  }

}
