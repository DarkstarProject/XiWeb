<?php
#ini_set("display_errors","Off");

//This function will attempt to login a user based on a username and password
function doLogin($username,$password) {
  global $db;

  $strSQL = "SELECT * FROM accounts WHERE (login = :username OR current_email = :username) AND password = PASSWORD(:password)";
  $statement = $db->prepare($strSQL);

  $statement->bindValue(':username',$_POST['username']);
  $statement->bindValue(':password',$_POST['password']);

  if (!$statement->execute()) { 
    watchdog($statement->errorInfo(),'SQL'); 
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

  if($errNo >= 1 || !$socket){
    $status = 0;
  } else {
    $status = 1;
    //fclose($socket);
  } 

  return $status;
}

//Get the count of online sessions currently on the server
function onlineCount(){

  //Get a reference to the database
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
function console_log($messages){
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

  $strSQL = "Update accounts set current_email = :newEmail , timelastmodify = NOW() where login = :login";
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
    SELECT chars.charid, charname, nation, zs1.name as CurrentZone, zs2.name as HomeZone, playtime, 
    cs.hp, cs.mp, cs.mjob, cs.sjob, cs.mlvl, cs.slvl, 
    ce.war, ce.mnk, ce.whm, ce.blm, ce.rdm, ce.thf, ce.pld, ce.drk, ce.bst, ce.brd, ce.rng, ce.sam, ce.nin, ce.drg, ce.smn, ce.blu, ce.cor, ce.pup, ce.dnc, ce.sch, ce.geo, ce.run, 
    cl.face, cl.race, cl.size, 
    cj.war as warlvl, cj.mnk as mnklvl, cj.whm as whmlvl, cj.blm as blmlvl, cj.rdm as rdmlvl, cj.thf as thflvl, cj.pld as pldlvl, cj.drk as drklvl, cj.bst as bstlvl, cj.brd as brdlvl, cj.rng as rnglvl, 
    cj.sam as samlvl, cj.nin as ninlvl, cj.drg as drglvl, cj.smn as smnlvl, cj.blu as blulvl, cj.cor as corlvl, cj.pup as puplvl, cj.dnc as dnclvl, cj.sch as schlvl, cj.geo as geolvl, cj.run as runlvl
    from chars
    join zone_settings zs1 on chars.pos_zone = zs1.zoneid
    join zone_settings zs2 on chars.home_zone = zs2.zoneid
    join char_stats cs on chars.charid = cs.charid
    join char_exp ce on chars.charid = ce.charid
    join char_look cl on chars.charid = cl.charid
    join char_jobs cj on chars.charid = cj.charid
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
  $offset  = new DateTime('@' . $seconds);
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

//This function will return all of the spells a character knows
function getCharacterSpells($charid){

  global $db;

  $strSQL = '
    SELECT name 
    FROM `char_spells` 
    JOIN spell_list on char_spells.spellid = spell_list.spellid
    WHERE charid = :charID
    ORDER BY 1
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

//This function will capitalize roman numerals (in the spell names)
function ucromans($string){

  $string = str_replace(" i", " I", $string);
  $string = str_replace(" ii", " II", $string);
  $string = str_replace(" iii", " III", $string);
  $string = str_replace(" iv", " IV", $string);
  $string = str_replace(" v", " V", $string);
  $string = str_replace(" vi", " VI", $string);

  return $string;

}

//This function will return the character's currently equipped items
function getCharacterEquipment($charid){

  global $db;

  $strSQL = '
    SELECT slotid, equipslotid, char_inventory.itemid, name
    FROM `char_equip`, char_inventory, item_basic
    WHERE char_equip.charid = char_inventory.charid and char_equip.slotid = char_inventory.slot and 
    char_equip.containerid = char_inventory.location and char_inventory.itemid = item_basic.itemid and char_equip.charid = :charID
    ORDER BY equipslotid
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

//This function will return an html image tag with an equipment icon based on the slot
function getEquipmentSlotIMG($characterEquipment, $slotstring){

  global $equipment_ids;

  $slotnum = $equipment_ids[$slotstring];

  foreach($characterEquipment as $equipment){
    if($equipment['equipslotid'] == $slotnum){
      return '<img src="http://static.ffxiah.com/images/icon/'.$equipment['itemid'].'.png" style="background: url(\'http://static.ffxiah.com/images/eq'.($slotnum+1).'.gif\');" class="tooltipster" title="'.ucwords(str_replace("_", " ", $equipment['name'])).'" alt="'.ucwords(str_replace("_", " ", $equipment['name'])).'"/>';
    }
  }

  return '<img src="http://static.ffxiah.com/images/eq'.($slotnum+1).'.gif"/>';

}

//This function will return how much gil a character has
function getCharacterGil($charid){

  global $db;

  $strSQL = '
    SELECT char_inventory.itemid, name, quantity, location
    FROM `char_inventory`
    JOIN item_basic on char_inventory.itemId = item_basic.itemid
    WHERE charid = :charid and name = \'gil\'
  ';
  $statement = $db->prepare($strSQL);

  $statement->bindValue(':charid', $charid);

  if (!$statement->execute()) {
    //watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $arrReturn[0]['quantity'];
  }

}

//This function will return all of the currencies for a character
function getCharacterCurrencies($charid){

  global $db;

  $strSQL = '
    SELECT *
    FROM `char_points`
    WHERE charid = :charid
  ';
  $statement = $db->prepare($strSQL);

  $statement->bindValue(':charid', $charid);

  if (!$statement->execute()) {
    //watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $arrReturn[0];
  }

}

//This function will create an account
function createAccount($account,$password,$email) {
  global $db;
  
  $id = getMaxAccountID() + 1;
  
  $strSQL = "INSERT INTO accounts (`id`,`login`,`password`,`current_email`, `registration_email`, timecreate, timelastmodify) VALUES(:id,:login,PASSWORD('$password'),:email, :email, NOW(), NOW())";
  $statement = $db->prepare($strSQL);
  $statement->bindValue(':id',$id);
  $statement->bindValue(':login',$account);
  $statement->bindValue(':email',$email);
  
  if (!$statement->execute()) {
    //watchdog($statement->errorInfo(),'SQL');
    var_dump($statement->errorInfo());
  }
  else {
    return TRUE;
  }
}

//This function will return an id for an account if it exists
function getAccountID($account) {
  global $db;

  $strSQL = "SELECT id FROM accounts WHERE login = :username OR current_email = :username";
  $statement = $db->prepare($strSQL);

  $statement->bindValue(':username',$account);

  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll();
  }

  if (!empty($arrReturn)) {
    return $arrReturn[0]['id'];
  }
  else {
    return 0;
  }

}

//This function will be used in the insert account function for the ID
function getMaxAccountID() {
  global $db;
  
  $strSQL = "SELECT max(id) AS maxid FROM accounts";
  $statement = $db->prepare($strSQL);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($arrReturn)) {
      return $arrReturn[0]['maxid'];
    }
    else {
      return 999;
    }
  }
}

//This function gets the IP address from a remote call (used in reCAPTCHA)
function getRealIPAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//This function will return the experience to get to the next level of a job
function getJobExpToLevel($level){

  global $db;

  $strSQL = '
    SELECT exp from exp_base where level = :level
  ';
  $statement = $db->prepare($strSQL);

  $statement->bindValue(':level', $level);

  if (!$statement->execute()) {
    //watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($arrReturn)){
      return $arrReturn[0]["exp"];
    } else {
      return 0;
    }
  }

}

?>
