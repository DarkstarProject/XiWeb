<?php
#ini_set("display_errors","Off");

//This function will attempt to login a user based on a username and password
function doLogin($username,$password) {
  global $db;

  $strSQL = "SELECT * FROM accounts WHERE (login = :username OR email = :username) AND password = PASSWORD(:password)";
  $statement = $db->prepare($strSQL);

  $statement->bindValue(':username',$_POST['username']);
  $statement->bindValue(':password',$_POST['password']);

  console_log($statement);

  if (!$statement->execute()) { 
    //watchdog($statement->errorInfo(),'SQL'); 
  }
  else {
    $arrReturn = $statement->fetchAll(); 
  }

  if (!empty($arrReturn)) {
    return TRUE;
  }
  else {
    return FALSE;
  }
}

//This function will log a person out from their current session
function doLogout(){

  $_SESSION['logged'] = FALSE;
  $_SESSION['auth']['username'] = '';

}

// Checks the status of the FFXI server to see if it is running
function serverstatus() {
  global $server_address;
  
  $socket = (@fsockopen($server_address,54230, $errNo, $errString, 1.0));

  if($errNo >= 1){
    $status = 0;
  } else {
    $status = 1;
    fclose($socket);
  } 

  return $status;
}

//Get the count of online sessions currently on the server
function onlineCount() {
  global $db;

  $strSQL = "SELECT COUNT(*) FROM `accounts_sessions`";
  $statement = $db->prepare($strSQL);

  if (!$statement->execute()) {
    //watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  if (!empty($arrReturn)) {
    return $arrReturn[0]['COUNT(*)'];

  }
  else {
    return '0';
  }
}

//Used for debugging purposes to send console messages to the client browser
function console_log( ...$messages ){
  $msgs = '';
  foreach ($messages as $msg) {
    $msgs .= json_encode($msg);
  }

  echo '<script>';
  echo 'console.log('. json_encode($msgs) .')';
  echo '</script>';
}

?>
