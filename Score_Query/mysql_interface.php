<?php
    // I dont know what this does header('Content-Type: application/json');
    if (isset($_POST['get_scores'])) {
        // Gets the musical scores from the MySQL database
        $dbcnx = new mysqli('127.0.0.1', 'root', '123456', 'drum_scores');
        if (!$dbcnx) {
            die( '<p>Unable to connect to the database server.</p>' );
        }
        // Checks Username and Password is valid
        $query = "SELECT * FROM ACCOUNTS WHERE User=".$_POST['Username']+"AND Pass=".$_POST['Password'];
        if (!$dbcnx->query($query)) {
            die( '<p>Incorrect Username or Password. Try again.</p>' );
        }

        // Retreives musical scores
        $query = "SELECT * FROM ".$_POST['Username'];
        if ($result = $dbcnx->query($sql)) {
            // If query is successful, then it puts all the entries into an array and returns it
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            echo json_encode($arr);
        } else {
            die ("<p>Query unsuccessful</p>");
        }
    } else if (isset($_POST['share_score'])) {
        null;
    }

?>
