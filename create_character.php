<?php
if (file_exists('config.php')) {
	include_once('config.php');
}
else {
	$_SESSION['errors']['general'] = $lang['error']['config'];
}

// If the system is installed, let's proceed
if (defined('INSTALLED')) {
  include_once('includes/includes.php');
  include_once('includes/functions.php');

  // We need to check if we are logged in already or not
  if (empty($_SESSION['logged'])) {
    // We aren't logged in, so we need to redirect to login.
    $_SESSION['destination'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
  }
  else {
    unset($_SESSION['errors']);
    unset($_SESSION['validation']['validation']);
    // We are already logged in, so let's proceed

     // Are we allowed to create characters? If not, let's get out of here!
     
     if (!$enable_creation) {
      header("Location: characters.php");
     }
    // Let's see if we have submitted the form already. If we have, we need to check for validation.
    
    if (!empty($_POST['create_character'])) {
      if (empty($_POST['character_name']) || empty($_POST['race']) || empty($_POST['face']) || empty($_POST['hair']) || empty($_POST['size']) || empty($_POST['gender']) || empty($_POST['job']) || empty($_POST['nation'])) {
        // One of the required fields is empty, we need to find out which one and evaluate it
        
        if (empty($_POST['character_name'])) {
            // Error tracking, character name is blank
            $_SESSION['errors'][] = $lang['error']['create_character']['empty_charname'];
            $_SESSION['validation']['validation']['charname'] = $lang['error']['create_character']['empty_charname'];
        }
        else {
          $_SESSION['validation']['validation']['character_name'] = '';
          $charname = $_POST['character_name'];
        }

        if (empty($_POST['race'])) {
          // Error tracking, race is blank
          $_SESSION['errors'][] = $lang['error']['create_character']['empty_race'];
          $_SESSION['validation']['validation']['race'] = $lang['error']['create_character']['empty_race'];
        }
        else {
          $_SESSION['validation']['validation']['race'] = '';
          $race = $_POST['race'];
        }

        if (empty($_POST['face'])) {
          // Error tracking, face is blank
          $_SESSION['errors'][] = $lang['error']['create_character']['empty_face'];
          $_SESSION['validation']['validation']['face'] = $lang['error']['create_character']['empty_face'];
        }
        else {
          $_SESSION['validation']['validation']['face'] = '';
          $face = $_POST['face'];
        }

        if (empty($_POST['gender'])) {
          // Error tracking, gender is blank
          $_SESSION['errors'][] = $lang['error']['create_character']['empty_gender'];
          $_SESSION['validation']['validation']['gender'] = $lang['error']['create_character']['empty_gender'];
        }
        else {
          $_SESSION['validation']['validation']['gender'] = '';
          $gender = $_POST['gender'];
        }

        if (empty($_POST['hair'])) {
          // Error tracking, hair is blank
          $_SESSION['errors'][] = $lang['error']['create_character']['empty_hair'];
          $_SESSION['validation']['validation']['hair'] = $lang['error']['create_character']['empty_hair'];
        }
        else {
           $_SESSION['validation']['validation']['hair'] = '';
          $hair = $_POST['hair'];
        }

        if (empty($_POST['size'])) {
          // Error tracking, size is blank
          $_SESSION['errors'][] = $lang['error']['create_character']['empty_size'];
          $_SESSION['validation']['validation']['size'] = $lang['error']['create_character']['empty_size'];
        }
        else {
          $_SESSION['validation']['validation']['size'] = '';
          $size = $_POST['size'];
        }

        if (empty($_POST['job'])) {
          // Error tracking, job is blank
          $_SESSION['errors'][] = $lang['error']['create_character']['empty_job'];
          $_SESSION['validation']['validation']['job'] = $lang['error']['create_character']['empty_job'];
        }
        else {
          $_SESSION['validation']['validation']['job'] = '';
          $job = $_POST['job'];
        }

        if (empty($_POST['nation'])) {
          // Error tracking, nation is blank
          $_SESSION['errors'][] = $lang['error']['create_character']['empty_nation'];
          $_SESSION['validation']['validation']['nation'] = $lang['error']['create_character']['empty_nation'];
        }  
        else {
          $_SESSION['validation']['validation']['nation'] = '';
          $nation = $_POST['nation'];
        }        
      }
      else {
        // Okay, none of the required fields are empty, so let's start validating the fields
        // Evaluate if the character name matches the pattern (Maximum 16 characters)
        // Evaluate if the character name contains any special characters (Should only be Alpha characters)
        // Evaluate if the character name is already in use
        
        $charname = $_POST['character_name'];
        $race = $_POST['race'];
        $gender = $_POST['gender'];
        $face = $_POST['face'];
        $hair = $_POST['hair'];
        $size = $_POST['size'];
        $job = $_POST['job'];
        $nation = $_POST['nation'];
        
        // If the character name length is too long, throw an error
        if (strlen($_POST['character_name']) > 16) {
          $_SESSION['errors'][] = $lang['error']['create_character']['charname_toolong'];
          $_SESSION['validation']['validation']['charname'] = $lang['error']['create_character']['charname_toolong'];
        }
        
        // If there are special characters in the name, throw an error
        if (!ctype_alpha($_POST['character_name'])) {
          $_SESSION['errors'][] = $lang['error']['create_character']['charname_invalid'];
          $_SESSION['validation']['validation']['charname'] = $lang['error']['create_character']['charname_invalid'];
        }
        
        // If the character is a reserved name, throw an error
        if (in_array($_POST['character_name'],$reserved_names)) {
          $_SESSION['errors'][] = $lang['error']['create_character']['charname_reserved'];
          $_SESSION['validation']['validation']['charname'] = $lang['error']['create_character']['charname_reserved'];
        }
        
        // If the character name exists, throw an error
        if (characterExists($_POST['character_name'])) {
          $_SESSION['errors'][] = $lang['error']['create_character']['character_exists'];
          $_SESSION['validation']['validation']['charname'] = $lang['error']['create_character']['character_exists'];
        }
        else {
          // Everything checks out, let's assemble the character information and create the character.
          
          $charname = ucwords(strtolower($charname));
          
          // We need to determine the race ID to store in the database
          switch ($race) {
            case 'Hume':
              if ($gender == "Male") {
                $rc = 1;
              }
              else {
                $rc = 2;
              }
              break;
            case 'Elvaan':
              if ($gender == "Male") {
                $rc = 3;
              }
              else {
                $rc = 4;
              }
              break;
            case 'Tarutaru':
              if ($gender == "Male") {
                $rc = 5;
              }
              else {
                $rc = 6;
              }
              break;
            case 'Mithra': // Mithra is only female, so we don't need to check the gender
              $rc = 7;
              break;
            case 'Galka': // Galka is only male, so we don't need to check the gender
              $rc = 8;
              break;
          }
          
          // Let's get the hair/face combo
          switch ($face) {
            case '1':
              if ($hair == '1') {
                $fc = 0;
              }
              else {
                $fc = 1;
              }
              break;
            case '2':
              if ($hair == '1') {
                $fc = 2;
              }
              else {
                $fc = 3;
              }
              break;
            case '3':
              if ($hair == '1') {
                $fc = 4;
              }
              else {
                $fc = 5;
              }
              break;
            case '4':
              if ($hair == '1') {
                $fc = 6;
              }
              else {
                $fc = 7;
              }
              break;
            case '5':
              if ($hair == '1') {
                $fc = 8;
              }
              else {
                $fc = 9;
              }
              break;
            case '6':
              if ($hair == '1') {
                $fc = 10;
              }
              else {
                $fc = 11;
              }
              break;
            case '7':
              if ($hair == '1') {
                $fc = 12;
              }
              else {
                $fc = 13;
              }
              break;
            case '8':
              if ($hair == '1') {
                $fc = 14;
              }
              else {
                $fc = 15;
              }
              break;
          }
          
          // Let's get the actual size of the model
          switch ($size) {
            case 'Small':
              $sz = 0;
              break;
            case 'Medium':
              $sz = 1;
              break;
            case 'Large':
              $sz = 2;
              break;
          }
          
          // Let's get the job and store it
          
          $job_temp = array(
            "Warrior" =>  1,
            "Monk" =>  2,
            "White Mage" =>  3,
            "Black Mage" =>  4,
            "Red Mage" =>  5,
            "Thief" =>  6,
            "Paladin" =>  7,
            "Dark Knight" =>  8,
            "Beastmaster" =>  9,
            "Bard" => 10,
            "Ranger" => 11,
            "Samurai" => 12,
            "Ninja" => 13,
            "Dragoon" => 14,
            "Summoner" => 15,
            "Blue Mage" => 16,
            "Corsair" => 17,
            "Puppetmaster" => 18,
            "Dancer" => 19,
            "Scholar" => 20,
            "Geomancer" => 21,
            "Rune Fencer" => 22
          );
          
          $jo = $job_temp[$job];
          
          // And finally, the home nation to start in
          switch ($nation) {
            case 'Republic of Bastok':
              $na = 1;
              break;
            case 'Kingdom of San D\'Oria':
              $na = 0;
              break;
            case 'Federation of Windurst':
              $na = 2;
              break;
          }
         
          $accid = getAccountID($_SESSION['auth']['username']);

          // TODO: Add in calculations to see if they have reached their maximum number of characters
          if (!createCharacter($accid,$charname,$fc,$rc,$sz,$na,$jo) != TRUE) {
            $_SESSION['errors'][] = $lang['error']['create_character']['creation_error'];
            #var_dump(createCharacter($accid,$charname,$fc,$rc,$sz,$na,$jo));
          }
          else {
            header("Location: characters.php");
          }

        }
      }
    }
  }
}
else {
  // If the config file exists, but the system is not installed, throw an error and redirect to the install directory
  $_SESSION['errors']['install'] = $lang['error']['install']['not_installed'];
  header("Location: install/index.php");
}

include_once('themes/'.$theme.'/views/header.php');
include_once('themes/'.$theme.'/views/nav.php');
include_once('themes/'.$theme.'/views/create_character.php');
include_once('themes/'.$theme.'/views/footer.php');
echo $output;
?>
