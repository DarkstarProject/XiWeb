<?php
// Main character sheet logic

$statement = $db->prepare("SELECT * FROM chars WHERE charid = :charID");
$statement->bindValue(':charID',$_GET['id']);

if (!$statement->execute()) {
  watchdog($statement->errorInfo(),'SQL');
}
else {
  $character = $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Let the system know we want to display the main character list, not the character sheet.
$page = 'characters sheet';
?>
