<?php

// Let's see if we've tried sending a message.

$send_error = '';
$friend = '';
$message = '';

if (!empty($_POST['send'])) {
  if (empty($_POST['friend']) || empty($_POST['message'])) {
    if (empty($_POST['friend'])) {
      $send_error[] = 'You need to specify a friend to send to.';
      $err_friend = 1;
    }
    else {
      $friend = $_POST['friend'];
    }
    
    if (empty($_POST['message'])) {
      $send_error[] = 'You need to specify a message.';
      $err_message = 1;
    }
    else {
      $message = $_POST['message'];
    }
  }
  else {
    $strSQL = "INSERT INTO `messages` (`sender_id`,`message_body`,`timestamp`) VALUES (:senderID,:messagetext,'".time()."')";
    $statement = $xi->prepare($strSQL);
    
    $statement->bindValue(':senderID',getAccountID($_SESSION['auth']['username']));
    $statement->bindValue(':messagetext',$_POST['message']);
    
    if (!$statement->execute()) {
      watchdog($statement->errorInfo(),'SQL');
      $send_error[] = 'Your message could not be sent. Please try sending it again.';
    }
    else {
      $strSQL = "INSERT INTO `users_messages` (`message_id`,`user_id`) VALUES ((select MAX(message_id) FROM messages),:userID)";
      $statement = $xi->prepare($strSQL);
    
      $statement->bindValue(':userID',getAccountID($_POST['friend']));
      
      if (!$statement->execute()) {
        watchdog($statement->errorInfo(),'SQL');
        $send_error[] = 'Your message could not be sent. Please try sending it again.';
      }
      else {
        $_SESSION['success'] = 'Message sent';
        header("Location: messages.php");
      }
    }
  }
}

if (!empty($_SESSION['replyto'])) {
  $friend = getAccountName($_SESSION['replyto']);
  $_SESSION['replyto'] = '';
}

$strSQL = "SELECT * FROM friends WHERE (`fid` = :userID OR `uid` = :userID) AND status = 1";
$statement = $xi->prepare($strSQL);

$statement->bindValue(':userID',getAccountID($_SESSION['auth']['username']));

if (!$statement->execute()) {
  watchdog($statement->errorInfo(),'SQL');
  $friends_list = '';
}
else {
  $friends_list = $statement->fetchAll(PDO::FETCH_ASSOC);
}

?>
