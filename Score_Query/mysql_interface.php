<?php
    header('Content-Type: application/json');

    $aResult = array();

    if (isset($_POST['functionname']) && isset($_POST['arguments']))  {     
        // MySQL Login details
        $dbcnx = new mysqli('127.0.0.1', 'root', '123456', 'drum_scores');
        if (!$dbcnx) {
            die( '<p>Unable to connect to the ' .
                'database server at this time.</p>' );
        }

        // Queries the database
        $arr = array();
        if ($result = $dbcnx->query($sql)) {
            // If query is successful, then it puts all the entries into an array and returns it
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            echo json_encode($arr);
        } else {
            echo json_encode($arr);

        }
    }

    

?>
