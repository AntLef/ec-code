<?php

require_once( 'database.php' );

class History {

    /***************************
     * -------- GET LIST --------
    ***************************/

    public static function all( $user_id ) {

        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "SELECT * FROM history WHERE `user_id` = ? ORDER BY `start_date` DESC" );
        $req->execute( array( $user_id ));

        // Close databse connection
        $db   = null;

        return $req->fetchAll();

    }

    /***************************
     * -- MODIFY INFORMATION --
    ***************************/

    public static function deleteHistory( $user_id, $id ) {

        print ( $id_media . " === " . $session_id );

        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "DELETE FROM history WHERE id = ? AND `user_id` = ? " );
        $req->execute( array( $id, $id_media ) );

        // Close databse connection
        $db   = null;

    }

    public static function deleteAllHistory( $user_id ) {

        print ( $id_media . " === " . $session_id );

        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "DELETE FROM history WHERE `user_id` = ? " );
        $req->execute( array( $id_media ) );

        // Close databse connection
        $db   = null;

    }



}
