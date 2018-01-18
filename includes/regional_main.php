<?php

$limit = 25; // Move this to config.php for production
    
// Let's find out how many people are online.

$totalPlayers = onlineCount();

// If there are more than 0 players on
  
if ($totalPlayers > 1) {
  $totalPages = ($totalPlayers / $limit);
    
  // Let's check to see if we are on a specific page. If we are, let's display the results only for that page.
  if (!empty($_GET['page'])) {
    $pg = $_GET['page'];
  }
  else {
    $pg = 1;
  }
  
  $totalPages = ceil($totalPages);
  if ($pg > $totalPages) {
    header("Location: regional.php?page=$totalPages");
  }
  
  $offset = ($totalPlayers / $pg) - 1; // We are getting the offset to display the results 
  
  // Everything is set, let's perform the query
  $strSQL = "SELECT * FROM accounts_sessions JOIN chars ON chars.charid=accounts_sessions.charid LIMIT $offset,$limit";
  $statement = $db->prepare($strSQL);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $onlineList = $statement->fetchAll(PDO::FETCH_ASSOC);
  }    
}
else {
  // There is only one page, so let's display all the characters in this region without pagination
  
  if (!empty($_GET['page'])) {
    header("Location: regional.php");
  
  }
  $strSQL = "SELECT * FROM accounts_sessions JOIN chars ON chars.charid=accounts_sessions.charid";
  $statement = $db->prepare($strSQL);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $onlineList = $statement->fetchAll(PDO::FETCH_ASSOC);
  }  
}

$page = 'regional main';
?>
