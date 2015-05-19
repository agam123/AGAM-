<?php

logout();

function logout() {
  setcookie("loggedin","");

  header( "refresh:2;url=index.php");
}

?>
