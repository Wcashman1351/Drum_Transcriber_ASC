
<?php
    // In PHP all variables are prefixed with '$'
    // _GET is an array that is generated upon the HTTP request and it contains the url strings.
    // the _GET array can be indexed using the variable's name
    // Connect to the database server
    $sqlObj = new mysqli('127.0.0.1', 'root', '123456', 'drum_scores');
        if (!$sqlObj) {
          die( '<p>Unable to connect to the ' .
              'database server at this time.</p>' );
        }
    // If a score  has been submitted,
    // add it to the database.
    if (isset($_GET['addscore'])) { 
      $sql = 'INSERT INTO ADMIN SET ScoreValue="'.$_GET['addscore'].'", Date=CURDATE()';
      echo ($sqlObj->query($sql) ? '<p>Your score has been added.</p>'
                                 : '<p>Error adding submitted score: '.$sqlObj->error_log.'</p>');
    }
?>

