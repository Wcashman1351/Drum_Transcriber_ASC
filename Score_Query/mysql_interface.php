<?php
    // I dont know what this does header('Content-Type: application/json');

    // Gets the musical scores from the MySQL database
    $dbcnx = new mysqli('127.0.0.1', 'root', '123456', 'drum_scores');
    if (!$dbcnx) {
        die( '<p>Unable to connect to the database server.</p>' );
    }

    switch ($_POST['RequestType']) {
        case "Share": ShareFunction($_Post['Username']); break;
        case "Login": LoginFunction($_POST['Username'], $_POST['scoreData'], $_POST['scoreDate']); break;
             default: die();
    }

    function LoginFunction($Username, $Password) {
  
        // Checks Username and Password is valid
        $query = 'SELECT * FROM ACCOUNTS WHERE Username="'.$Username.'"'.' AND Password="'.$Password.'";';
        if (!$dbcnx->query($query)) {
            die( '<p>Incorrect Username or Password. Error: '.$dbcnx->error.'.</p>' );
        }
        
        // Retreives musical scores
        $query = "SELECT * FROM ".$Username;
        if ($result = $dbcnx->query($query)) {
            // If query is successful, then it puts all the entries into an array and returns it
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            header('Location: ViewScores.html');
            return json_encode($arr);
        } else {
            die ("<p>Query unsuccessful</p>");
        }

    } 
    function ShareFunction($Username, $ScoreData, $ScoreDate) {
        // Checks username is valid
        $query = 'SELECT * FROM ACCOUNTS WHERE Username="'.$Username.'";';
        if (!$dbcnx->query($query)) {
            return ('Username does not exist. Try again.');
        }
        // Insert musical score
        $query = 'INSERT INTO "'.$Username.'" VALUES (, "'
                    .$ScoreData.'", "'.$ScoreDate.'");';
        
        echo ($dbcnx->query($query) ? "Succesdfully Added" : "Error adding score");
    }

?>
