<?php
    // I dont know what this does header('Content-Type: application/json');

    // Gets the musical scores from the MySQL database
    $dbcnx = new mysqli('127.0.0.1', 'root', '123456', 'drum_scores');
    if (!$dbcnx) {
        die( '<p>Unable to connect to the database server.</p>' );
    }

    if (isset($_POST['get_scores'])) {
        // Checks Username and Password is valid
        $query = "SELECT * FROM ACCOUNTS WHERE User=".$_POST['Username']+"AND Pass=".$_POST['Password'].";";
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
        // Checks username is valid
        $query = "SELECT * FROM ACCOUNTS WHERE User=".$_POST['Username'].";";
        if (!$dbcnx->query($query)) {
            die( '<p>Username does not exist. Try again.</p>' );
        }
        // Insert musical score
        $query = "INSERT INTO ".$_POST['Username']."(Score, Data) VALUES ("
                    .$_POST['data_entry']['score'].", ".$_POST['data_entry']['Date'].");";
        if ($dbcnx->query($query)) {
            echo json_encode("Succesdfully Added");
        } else {
            echo json_encode("Error adding score");
        }
    }

?>
