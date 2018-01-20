<?php
#ini_set("display_errors","Off");

//This function will attempt to login a user based on a username and password
function doLogin($username,$password) {
  global $db;

  $strSQL = "SELECT * FROM accounts WHERE (login = :username OR email = :username) AND password = PASSWORD(:password)";
  $statement = $db->prepare($strSQL);

  $statement->bindValue(':username',$_POST['username']);
  $statement->bindValue(':password',$_POST['password']);

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

//Get the count of items for sale in the auction house currently
function auctionHouseCount(){

  global $db;

  $strSQL = "SELECT COUNT(*) FROM `auction_house` where sale = 0";
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

//This function will update the email for an account
function updateEmail($login, $email){

  global $db;

  $strSQL = "Update accounts set email = :newEmail where login = :login";
  $statement = $db->prepare($strSQL);

  $statement->bindValue(':newEmail', $email);
  $statement->bindValue(':login', $login);

  if (!$statement->execute()) {
    return 0;
  }
  else {
    return 1;
  }

}

//This function will return the characters of the session user
function getMyCharacters(){

  global $db;

  $strSQL = "
    SELECT chars.charid, charname, nation, zs1.name as CurrentZone, zs2.name as HomeZone, playtime, cs.hp, cs.mp, cs.mjob, cs.sjob, cs.mlvl, cs.slvl, ce.war, ce.mnk, ce.whm, ce.blm, ce.rdm, ce.thf, ce.pld, ce.drk, ce.bst, ce.brd, ce.rng, ce.sam, ce.nin, ce.drg, ce.smn, ce.blu, ce.cor, ce.pup, ce.dnc, ce.sch, ce.geo, ce.run, cl.face, cl.race, cl.size
    from chars
    join zone_settings zs1 on chars.pos_zone = zs1.zoneid
    join zone_settings zs2 on chars.home_zone = zs2.zoneid
    join char_stats cs on chars.charid = cs.charid
    join char_exp ce on chars.charid = ce.charid
    join char_look cl on chars.charid = cl.charid
    where accid = (select id from accounts where login = :accID)
  ";
  $statement = $db->prepare($strSQL);
  $statement->bindValue(':accID',$_SESSION['auth']['username']);

  if (!$statement->execute()) {
    //watchdog($statement->errorInfo(),'SQL');
  }
  else {
    return $characters = $statement->fetchAll(PDO::FETCH_ASSOC);
  }

}

//This function will format the look of a character's playtime
function formatPlayTime($seconds){

  $zero    = new DateTime('@0');
  $offset  = new DateTime('@' . $seconds * 6);
  $diff    = $zero->diff($offset);
  return $diff->format('%a Days, %h Hours, %i Minutes');

}

//This function will get a characters gender basedon its race value
function getCharacterGender($race) {

  if ($race == '2' || $race == '4' || $race == '6' || $race == '7') {
    return 'Female';
  }
  else {
    return 'Male';
  }

}

//This function will return all of the skill values for the given character id
function getCharacterSkills($charid){

  global $db;

  $strSQL = '
    select char_skills.skillid, sr.name as skillname, value
    from char_skills
    join skill_ranks sr on char_skills.skillid = sr.skillid
    where char_skills.charid = :charID
    order by 2
  ';
  $statement = $db->prepare($strSQL);

  $statement->bindValue(':charID', $charid);

  if (!$statement->execute()) {
    //watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $arrReturn;
  }

}

?>
