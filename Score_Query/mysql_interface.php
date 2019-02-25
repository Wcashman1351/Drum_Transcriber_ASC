<?php
    // I dont know what this does header('Content-Type: application/json');

    // Gets the musical scores from the MySQL database

    switch ($_POST['RequestType']) {
        case 'Share' : echo ShareFunction($_POST['Username'], $_POST['scoreData'], $_POST['scoreDate']); break;
        case 'Login' : echo LoginFunction($_POST['Username'], $_POST['Password']);                       break;
        case 'Submit': SubmitFunction($_POST['addscore']);                                               break;
        default      : die("Not a valid request");
    }

    function LoginFunction($Username, $Password) {
  
        $sqlObj = ConnectToMySQL(); // Establish connection to MySQL Server
       
        // Checks Username and Password is valid
        $query = 'SELECT * FROM ACCOUNTS WHERE Username="'.$Username.'"'.' AND Password="'.$Password.'";';
        if (!$sqlObj->query($query)) {
            die( '<p>Incorrect Username or Password. Error: '.$sqlObj->error.'.</p>' );
        }
        $arr = [];
        // Retreives musical scores
        $query = "SELECT * FROM ".$Username;
        if ($result = $sqlObj->query($query)) {
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

        $sqlObj = ConnectToMySQL(); // Establish connection to MySQL Server

        // Checks username is valid
        $query = 'SELECT * FROM ACCOUNTS WHERE Username="'.$Username.'";';
        if (!($sqlObj->query($query))) {
            die('Username does not exist. Try again.');
        }
        // Insert musical score
        $query = 'INSERT INTO '.$Username.' (ScoreValue, Date) VALUES ("'
                    .$ScoreData.'", "'.$ScoreDate.'");';
        
        echo $sqlObj->query($query) ? "Succesdfully Added" : "Error adding score";
    }

    function SubmitFunction($Score) {
        
        $sqlObj = ConnectToMySQL(); // Establish connection to MySQL Server

        $query = 'INSERT INTO ADMIN SET ScoreValue="'.$Score.'", Date=CURDATE()';

        echo $sqlObj->query($query) ? "Your score has been added" 
                                 : '<p>Error adding submitted score: '.mysql_error();
    }

    function ConnectToMySQL() {
        $sqlObj = new mysqli('127.0.0.1', 'root', '123456', 'drum_scores');
        if (!$sqlObj) {
        die( '<p>Unable to connect to the ' .
            'database server at this time.</p>' );
        }
        return $sqlObj;
    }
?>
