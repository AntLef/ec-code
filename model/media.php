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

  public static function getTextResume( $text ) {

    return substr($text, 0, 100) . " ...";

  }

}
