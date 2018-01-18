<?php
// Main character view logic

$statement = $db->prepare("SELECT * FROM chars WHERE accid = :accID");
$statement->bindValue(':accID',$_SESSION['auth']['username']);

if (!$statement->execute()) {
  watchdog($statement->errorInfo(),'SQL');
}
else {
  $characters = $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Let the system know we want to display the main character list, not the character sheet.
$page = 'characters';
?>
