<?php

$message_error = array();

if ($_GET['id'] == 0) {
  header("Location: messages.php");
}
else {
  $strSQL = "SELECT * FROM messages JOIN users_messages ON messages.message_id=users_messages.message_id WHERE messages.message_id=:mID AND users_messages.user_id=".getAccountID($_SESSION['auth']['username'])."";
  $statement = $xi->prepare($strSQL);
  
  $statement->bindValue(':mID',$id);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    $message_error[] = 'An error occurred recovering the message.';
  }
  else {
    $arrayInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($arrayInfo)) {
      $message = $arrayInfo;
      $_SESSION['replyto'] = $message[0]['sender_id'];
      markMessageRead(getAccountID($_SESSION['auth']['username']),$message[0]['message_id']);
    }
    else {
      $message_error[] = 'Could not retrieve message.';
    }
  }
}

?>
