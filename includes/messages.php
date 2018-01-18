<?php

// Were messages deleted? If so, we need to process the deletion

if (!empty($_POST['delete'])) {
  if (!empty($_POST['deleted'])) {
    $success = '';
    foreach ($_POST['deleted'] as $delete) {
      $strSQL = "DELETE FROM users_messages WHERE message_id=:mID AND user_id=:uID";
      $statement = $xi->prepare($strSQL);
      $statement->bindValue(':mID',$delete);
      $statement->bindValue(':uID',getAccountID($_SESSION['auth']['username']));
      
      if (!$statement->execute()) {
        watchdog($statement->errorInfo(),'SQL');
      }
      else {
        $success = 'Messages Deleted';
      }
    }
  }
}

if (!empty($_SESSION['success'])) {
  $success = $_SESSION['success'];
  $_SESSION['success'] = '';
}

// Let's get the list of messages that we have here.

$strSQL = "SELECT * FROM messages JOIN users_messages ON messages.message_id=users_messages.message_id WHERE user_id=:uID AND NOT status=2 GROUP BY messages.message_id";
$statement = $xi->prepare($strSQL);
$statement->bindValue(':uID',getAccountID($_SESSION['auth']['username']));

if (!$statement->execute()) {
  watchdog($statement->errorInfo(),'SQL');
}
else {
  $messages = $statement->fetchAll(PDO::FETCH_ASSOC);
}

?>
