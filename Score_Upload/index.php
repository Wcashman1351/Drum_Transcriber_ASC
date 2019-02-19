<!DOCTYPE html>
<html>
<head>
<title> Musical Score Submission Server </title>
</head>
<body>
<?php
    // In PHP all variables are prefixed with '$'
    // _GET is an array that is generated upon the HTTP request and it contains the url strings.
    // the _GET array can be indexed using the variable's name
if (isset($_GET['password'])){
    if ($_GET['password'] = "passWord") {

    // Connect to the database server
    $dbcnx = new mysqli('127.0.0.1', 'root', '123456', 'drum_scores');
    if (!$dbcnx) {
      die( '<p>Unable to connect to the ' .
           'database server at this time.</p>' );
    }
    // If a score  has been submitted,
    // add it to the database.
    if (isset($_POST['addscore'])) {

      $score = $_GET['newscore'];
      $sql = "INSERT INTO scores SET score='$score', scoreDate=CURDATE()";
      if ($dbcnx->query($sql)) {
        echo('<p>Your score has been added.</p>'); 
      } else {
        echo('<p>Error adding submitted score: ' .
             mysql_error() . '</p>');
      }
    }
    }}
?>
</body>
</html>
