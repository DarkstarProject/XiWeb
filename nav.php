<?php

/*
This page is strictly for handling the navigation logic. It's used to generate the character list in the main menu when the user is logged in

*/
if (!empty($_SESSION['logged'])) {
  $statement = $db->prepare("SELECT charid, charname FROM chars WHERE accid=:accID");
  $statement->bindValue(':accID',getAccountID($_SESSION['auth']['username']));
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $characters = $statement->fetchAll(PDO::FETCH_ASSOC);
  }  	
}
?>
