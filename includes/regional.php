<?php
$limit = 3; // Add to the config file

// Individual region page, used to display people available in a specific region

// If the region ID isn't empty, we need to display all of the people online in this region
if (!empty($_GET['id'])) {
  $id = $_GET['id']; // This is the region ID, as passed through the URI Path
  
  // We need to get the total amount of players online, in this region.
  
  switch ($id) {
    case 1:
      $regions =  "pos_zone='246' OR pos_zone='234' OR pos_zone='235' OR pos_zone='237'";
      break;
    case 2:
      $regions =  "pos_zone='230' OR pos_zone='231' OR pos_zone='232' OR pos_zone='233'";
      break;
    case 3:
      $regions =  "pos_zone='100' OR pos_zone='101' OR pos_zone='139' OR pos_zone='140' OR pos_zone='141' OR pos_zone='142' OR pos_zone='167' OR pos_zone='190'";
      break;
    case 4:
      $regions =  "pos_zone='102' OR pos_zone='103' OR pos_zone='108' OR pos_zone='193' OR pos_zone='196' OR pos_zone='248'";
      break;
    case 5:
      $regions =  "pos_zone='242' OR pos_zone='240' OR pos_zone='239' OR pos_zone='241' OR pos_zone='238'";
      break;
    case 6:
      $regions =  "pos_zone='6' OR pos_zone=' 161' OR pos_zone='162' OR pos_zone='165' OR pos_zone='5' OR pos_zone='112'";
      break;
    case 7:
      $regions =  "pos_zone='105' OR pos_zone='2' OR pos_zone='149' OR pos_zone='195' OR pos_zone='104' OR pos_zone='150' OR pos_zone='1'";
      break;
    case 8:
      $regions =  "pos_zone='113' OR pos_zone='201' OR pos_zone='212' OR pos_zone='174' OR pos_zone='128'";
      break;
    case 9:
      $regions =  "pos_zone='146' OR pos_zone='116' OR pos_zone='170' OR pos_zone='145' OR pos_zone='192' OR pos_zone='194' OR pos_zone='169' OR pos_zone='115'";
      break;
    case 10:
      $regions =  "pos_zone='250' OR pos_zone='252' OR pos_zone='176' OR pos_zone='123'";
      break;
    case 11:
      $regions =  "pos_zone='207' OR pos_zone='211' OR pos_zone='160' OR pos_zone='205' OR pos_zone='163' OR pos_zone='159' OR pos_zone='124'";
      break;
    case 12:
      $regions =  "pos_zone='209' OR pos_zone='114' OR pos_zone='168' OR pos_zone='208' OR pos_zone='247' OR pos_zone='125'";
      break;
    case 13:
      $regions =  "pos_zone='24' OR pos_zone='25' OR pos_zone='31' OR pos_zone='27' OR pos_zone='30' OR pos_zone='29'OR pos_zone='28' OR pos_zone='32' OR pos_zone='26'";
      break;
    case 14:
      $regions =  "pos_zone='207' OR pos_zone='211' OR pos_zone='160' OR pos_zone='205' OR pos_zone='163' OR pos_zone='159' OR pos_zone='124'";
      break;
    case 15:
      $regions =  "pos_zone='127' OR pos_zone='184' OR pos_zone='157' OR pos_zone='126' OR pos_zone='179' OR pos_zone='158'";
      break;
    case 16:
      $regions =  "pos_zone='246' OR pos_zone='244' OR pos_zone='245' OR pos_zone='243'";
      break;
    case 17:
      $regions =  "pos_zone='191' OR pos_zone='173' OR pos_zone='106' OR pos_zone='143' OR pos_zone='107' OR pos_zone='144' OR pos_zone='172'";
      break;
    case 18:
      $regions =  "pos_zone='181' OR pos_zone='180' OR pos_zone='130' OR pos_zone='178' OR pos_zone='177'";
      break;
    case 19:
      $regions =  "pos_zone='153' OR pos_zone='202' OR pos_zone='154' OR pos_zone='251' OR pos_zone='122' OR pos_zone='121'";
      break;
    case 20:
      $regions =  "pos_zone='4' OR pos_zone='44' OR pos_zone='118' OR pos_zone='213' OR pos_zone='3' OR pos_zone='198' OR pos_zone='249' OR pos_zone='117'";
      break;
    case 21:
      $regions =  "pos_zone='152' OR pos_zone='7' OR pos_zone='8' OR pos_zone='151' OR pos_zone='200' OR pos_zone='119' OR pos_zone='120'";
      break;
    case 22:
      $regions =  "pos_zone='147' OR pos_zone='197' OR pos_zone='109' OR pos_zone='148' OR pos_zone='110'";
      break;
    case 23:
      $regions =  "pos_zone='13' OR pos_zone='12' OR pos_zone='11'";
      break;
    default:
    $regions =  "pos_zone='230' OR pos_zone='231'";
      break;
  }
    
  $totalinRegion = totalRegionCount($regions);
  
  // After we get the total players online, we need to get the total amount of pages
  
  $totalPages = round($totalinRegion / $limit,0, PHP_ROUND_HALF_UP);
  
  if ($totalPages > 1) {
    // Let's check to see if we are on a specific page. If we are, let's display the results only for that page.
    if (!empty($_GET['page'])) {
      $pg = $_GET['page'];
      $offset = round(($totalinRegion / $pg)-1,0,PHP_ROUND_HALF_UP); // We are getting the offset to display the results 
    }
    else {
      $pg = 1;
      $offset = 0;
    }
    
    if ($pg > $totalPages) {
      header("Location: regional.php?id=$id&page=$totalPages");
    }
    
    
    // Everything is set, let's perform the query
    $strSQL = "SELECT * FROM accounts_sessions JOIN chars ON chars.charid=accounts_sessions.charid WHERE $regions ORDER BY chars.charname ASC LIMIT $offset,$limit";
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
      header("Location: regional.php?id=$id");
    
    }
    $strSQL = "SELECT * FROM accounts_sessions JOIN chars ON chars.charid=accounts_sessions.charid WHERE $regions";
    $statement = $db->prepare($strSQL);
    
    if (!$statement->execute()) {
      watchdog($statement->errorInfo(),'SQL');
    }
    else {
      $onlineList = $statement->fetchAll(PDO::FETCH_ASSOC);
    }  
  }
}
else {
  header("Location: regional.php");
}

$page = 'regional';
?>