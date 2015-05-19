<?php

$password = $_POST['password'];
$username = $_POST['username'];

login($username, $password);

function login($username=null , $password=null) {
  try {
   $dbh = new PDO('mysql:host=localhost;dbname=mini', "root");
   foreach ($dbh->query('SELECT * from user') as $row) {
      if($row["name"] === $username and $row["password"] === $password) {
        echo "login successful!";
        setcookie("loggedin","true");

        header( "refresh:2;url=index.php");
      }
      else {
        echo "Please check your username and password!";
        setcookie("loggedin", "false");

        header( "refresh:2;url=index.php");
      }

   }
   $dbh = null;
 } catch (PDOException $e) {
   print "Error!: " . $e->getMessage() . "<br/>";
   die();
 }
}

?>
