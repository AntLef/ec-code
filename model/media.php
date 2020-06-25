<?php

require_once( 'database.php' );

class Media {

  protected $id;
  protected $genre_id;
  protected $title;
  protected $type;
  protected $status;
  protected $release_date;
  protected $summary;
  protected $trailer_url;

  public function __construct( $media ) {

    $this->setId( isset( $media->id ) ? $media->id : null );
    $this->setGenreId( $media->genre_id );
    $this->setTitle( $media->title );
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setGenreId( $genre_id ) {
    $this->genre_id = $genre_id;
  }

  public function setTitle( $title ) {
    $this->title = $title;
  }

  public function setType( $type ) {
    $this->type = $type;
  }

  public function setStatus( $status ) {
    $this->status = $status;
  }

  public function setReleaseDate( $release_date ) {
    $this->release_date = $release_date;
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getGenreId() {
    return $this->genre_id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getType() {
    return $this->type;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getReleaseDate() {
    return $this->release_date;
  }

  public function getSummary() {
    return $this->summary;
  }

  public function getTrailerUrl() {
    return $this->trailer_url;
  }

  /***************************
  * -------- GET LIST --------
  ***************************/

  public static function filterMedias( $title ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM media WHERE title LIKE ? ORDER BY release_date DESC" );
    $req->execute( array( '%' . $title . '%' ));

    // Close databse connection
    $db   = null;

    return $req->fetchAll();

  }

  public static function filterSeries( $id_media ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM series WHERE media_id = ? " );
    $req->execute( array( $id_media ) );

    // Close databse connection
    $db   = null;

    return $req->fetchAll();

  }

  public static function filterInfoSeries( $id_media ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT season_id FROM series WHERE media_id = ? GROUP BY season_id " );
    $req->execute( array( $id_media ) );

    // Close databse connection
    $db   = null;

    return $req->fetchAll();

  }

  public static function getMediasById( int $id ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM media WHERE id = ? " );
    $req->execute( array( $id ) );

    return $req->fetchAll();

  }

  public static function firstEpisodeToSeries( $id_media ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT trailer_url FROM series WHERE media_id = ? ORDER BY season_id, episode_id ASC " );
    $req->execute( array( $id_media ) );

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }

  public static function addFavorite( $id_media, $session_id ) {

    print ( $id_media . " === " . $session_id );

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT id FROM favorite WHERE media_id = ? AND `user_id` = ? " );
    $req->execute( array( $id_media, $session_id ) );

    $result = $req->fetch();

    if ( !isset($result["id"]) ):
      $sql = "INSERT INTO favorite (media_id, `user_id`) VALUES (?, ?) ";
    else:
      $sql = "DELETE FROM favorite WHERE media_id = ? AND `user_id` = ? ";
    endif;

    $req  = $db->prepare( $sql );
    $req->execute( array( $id_media, $session_id ) );

    // Close databse connection
    $db   = null;

    header( 'location: index.php' );

  }

  public static function textFavorite( $id_media, $session_id, $sort ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT id FROM favorite WHERE media_id = ? AND `user_id` = ? " );
    $req->execute( array( $id_media, $session_id ) );

    // Close databse connection
    $db   = null;

    $result = $req->fetch();

    if ( $sort == 1 ):

      if ( !isset( $result["id"] ) ):
        print "Ajouter au favori";
      else:
        print "Supprimer des favori";
      endif;
    
    else:

      if ( !isset( $result["id"] ) ):
        return 1;
      else:
        return 2;
      endif;

    endif;

  }

  public static function mediaInFavorite( $id_media, $session_id ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT id FROM favorite WHERE media_id = ? AND `user_id` = ? " );
    $req->execute( array( $id_media, $session_id ) );

    // Close databse connection
    $db   = null;

    $result = $req->fetch();

    if ( $sort == 1 ):

      print( !isset( $result["id"] ) ? "Ajouter au favori" : "Supprimer des favori" );
          
    else:

      return !isset( $result["id"] ) ? 1 : 2;

    endif;

  }



  public static function getTextResume( $text ) {

    return substr($text, 0, 100) . " ...";

  }
  
  public function emailConfirmation( $the_key ) {

    $eol = PHP_EOL;
    $uid = md5(uniqid(time()));

    $to      = $this->getEmail();
    $subject = 'Confirmer votre email';
    $message = <<<HTML
      <html>
        <body>
          <h1>Bonjour, Veuillez confirmer votre compte codflex</h1>
          <a href="http://localhost/Coding/Ec_code/ec_code_php/ec-code-2020-codflix-php-master/controller/VerificationController.php?user_key=$the_key">Clique connard</a>
        </body>
      </html>
    HTML;
    $header = "From: codflix <coding@gmail.com>".$eol;
    $header .= "Reply-To: ".$this->getEmail().$eol;
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";

    mail($to, $subject, $message, $header);
    echo "<script>alert('Vous avez reçu un emal de confirmation')</script>";
  }

}
