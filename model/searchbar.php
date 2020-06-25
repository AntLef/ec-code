<?php

require_once( 'database.php' );

// Open database connection
$db   = init_db();
 
// Attempt search query execution
try{
    if(isset($_REQUEST["term"])){
        // create prepared statement
        $sql = "SELECT * FROM media WHERE title LIKE :term OR `type` LIKE :term OR duration LIKE :term";
        $stmt = $db->prepare($sql);
        $term = '%' . $_REQUEST["term"] . '%';
        // bind parameters to statement
        $stmt->bindParam(":term", $term);
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                echo "<p><a href='index.php?media=" . $row['id'] ."'>" . $row["title"] . " - " . $row["type"] . " - " . $row["duration"] . "</a></p>";
            }
        } else{
            echo "<p>Aucun Résultat</p>";
        }
    }  
} catch(PDOException $e){
    die("ERROR: Impossible d'exécuter $sql. " . $e->getMessage());
}
 
// Close statement
unset($stmt);
 
// Close connection
unset($db);

?>