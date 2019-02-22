<?php
    // I dont know what this does header('Content-Type: application/json');

    // Gets the musical scores from the MySQL database

    switch ($_POST['RequestType']) {
        case 'Share': echo ShareFunction($_POST['Username'], $_POST['scoreData'], $_POST['scoreDate']); break;
        case 'Login': echo LoginFunction($_POST['Username'], $_POST['Password']); break;
        case 'Submit': SubmitFunction($_POST['addscore']); break;
             default: die("Not a valid request");
    }

    function LoginFunction($Username, $Password) {
  
        $dbcnx = new mysqli('127.0.0.1', 'root', '123456', 'drum_scores');
        if (!$dbcnx) {
            die( '<p>Unable to connect to the database server.</p>' );
        }
       
        // Checks Username and Password is valid
        $query = 'SELECT * FROM ACCOUNTS WHERE Username="'.$Username.'"'.' AND Password="'.$Password.'";';
        if (!$dbcnx->query($query)) {
            die( '<p>Incorrect Username or Password. Error: '.$dbcnx->error.'.</p>' );
        }
        
        // Retreives musical scores
        $query = "SELECT * FROM ".$Username;
        if ($result = $dbcnx->query($query)) {
            // If query is successful, then it puts all the entries into an array and returns it
            // Total array is standard numbered. But each row array is indexed by the column names
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            echo json_encode($arr);
        } else {
            die ("<p>Query unsuccessful</p>");
        }

    } 
    function ShareFunction($Username, $ScoreData, $ScoreDate) {

        $dbcnx = new mysqli('127.0.0.1', 'root', '123456', 'drum_scores');
        if (!$dbcnx) {
            die( '<p>Unable to connect to the database server.</p>' );
        }

        // Checks username is valid
        $query = 'SELECT * FROM ACCOUNTS WHERE Username="'.$Username.'";';
        if (!($dbcnx->query($query))) {
            die('Username does not exist. Try again.');
        }
        // Insert musical score
        $query = 'INSERT INTO '.$Username.' (ScoreValue, Date) VALUES ("'
                    .$ScoreData.'", "'.$ScoreDate.'");';
        
        echo $dbcnx->query($query) ? "Succesdfully Added" : "Error adding score";
    }

    function SubmitFunction($Score) {
        $dbcnx = new mysqli('127.0.0.1', 'root', '123456', 'drum_scores');
        if (!$dbcnx) {
        die( '<p>Unable to connect to the ' .
            'database server at this time.</p>' );
        }
        // If a score  has been submitted,
        // add it to the database
        $sql = 'INSERT INTO ADMIN SET ScoreValue="'.$Score.'", Date=CURDATE()';

        echo $dbcnx->query($sql) ? "Your score has been added" 
                                 : '<p>Error adding submitted score: '.mysql_error();
    }
?>
