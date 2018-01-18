<?php
session_start();
$_SESSION['errors']['install'] = '';
$_SESSION['errors']['setup'] = '';
$language = 'en';

// The first thing we are going to do, even before checking if the form has been submitted

if (file_exists('../config.php')) {
  include('../config.php');
  $theme = 'default';
  include('lang/en.inc.php');
  if (defined('INSTALLED')) {
    // The config file exists, but XIWeb is already installed
    $_SESSION['errors']['install'][] = $lang['error']['install']['xiweb_installed'];
    $_SESSION['errors']['setup']['checked'] = TRUE;
  }
  else {
    if (!is_writeable('../config.php')) {
      // XIWeb isn't installed, and the configuration file isn't writeable
      $_SESSION['errors']['install'][] = $lang['error']['install']['config_unwriteable'];
      $_SESSION['errors']['setup']['checked'] = TRUE;
    }
  }
}
else {
    // If the file doesn't exist, let's go ahead and throw an error
    $language = 'en';
    include_once('../lang/en.inc.php');
    $_SESSION['errors']['install'][] = $lang['error']['install']['config_missing'];
}

if (!empty($_POST['install'])) {
  if (empty($_POST['database']) || empty($_POST['xi_database']) || empty($_POST['host']) || empty($_POST['password']) || empty($_POST['servername'])) {
    // If the required fields are empty, thrown an error
    if (empty($_POST['database'])) {
      $_SESSION['errors']['install']['missing_database'] = $lang['error']['install']['missing_database'];
    }
    else {
      $database = $_POST['database'];
    }
    
    if (empty($_POST['xi_database'])) {
      $_SESSION['errors']['install']['missing_xidatabase'] = $lang['error']['install']['missing_xidatabase'];
    }
    else {
      $xi_database = $_POST['xi_database'];
    }
    
    if (empty($_POST['host'])) {
      $_SESSION['errors']['install']['missing_host'] = $lang['error']['install']['missing_host']; 
    }
    else {
      $host = $_POST['host'];
    }
    
    if (empty($_POST['user'])) {
      $_SESSION['errors']['install']['missing_user'] = $lang['error']['install']['missing_user'];
    }
    else {
      $user = $_POST['user'];
    }
    
    if (empty($_POST['password'])) {
      $_SESSION['errors']['install']['missing_password'] = $lang['error']['install']['missing_password'];
    }
    else {
      $password = $_POST['password'];
    }
    
    if (empty($_POST['servername'])) {
      $_SESSION['errors']['install']['missing_servername'] = $lang['error']['install']['missing_servername'];
    }
    else {
      $servername = $_POST['servername'];
    }
    
    if (empty($_POST['serveraddress'])) {
      $_SESSION['errors']['install']['missing_serveraddress'] = $lang['error']['install']['missing_serveraddress'];
    }
    else {
      $serveraddress = $_POST['serveraddress'];
    }
    
    if (!empty($_POST['port'])) {
      $port = $_POST['port'];
    }
    else {
      $port = 3306;
    }
    if (!empty($_POST['allow_registration'])) {
      $allow_registration = 'checked';
    }
    if (!empty($_POST['allow_creation'])) {
      $allow_creation = 'checked';
    }
  }
  else {
    // All of the required fields are filled in, let's validate everything else
    
    $database = $_POST['database'];
    $xi_database = $_POST['xi_database'];
    (!empty($_POST['port']) ? $port = $_POST['port'] : $port = 3306); 
    $host = $_POST['host'];
    $user = $_POST['user'];
    $password = $_POST['password'];
    $servername = $_POST['servername'];
    $serveraddress = $_POST['serveraddress'];
    (!empty($_POST['allow_registration']) ? $allow_registration = 'checked' : '');
    (!empty($_POST['allow_creation']) ? $allow_creation = 'checked' : '');
    
    #$config = file_get_contents('../config.php');
    $write_contents = '<?php
define(\'INSTALLED\',TRUE);
    
$theme = \'default\';
$language = \'en\';
    
$db_host = \''.$host.'\';
$db_port = \''.$port.'\';
$db_user = \''.$user.'\';
$db_pass = \''.$password.'\';
$db_name = \''.$database.'\';
$xi_name = \''.$xi_database.'\';

$site_name = \''.$servername.'\';
$server_address = \''.$serveraddress.'\';
$frontpage_title = \'XIWeb Installation\';
$frontpage_message = \'This is the default front-page message for your XIWeb installation. To change this, please check the configuration file.\';

// Character creation settings
$enable_creation = '.(!empty($allow_creation) ? 'TRUE' : 'FALSE').'; // If set to TRUE, will allow characters to be created 
$allow_advanced_jobs = TRUE; // If set to TRUE, will allow characters to be created with advanced starting jobs (Default: FALSE)
$reserved_names = array(
\'Justin\',
);

$show_currencies = TRUE; // Should the \'currencies\' tab be displayed on character sheets?

/* 
  TODO: Since this stuff isn\'t implemented yet, let\'s not show it on the menubar
  REMOVE AS IMPLEMENTED
*/

$bestiary = FALSE; // Temporary, so that Bestiary doesn\'t show up in the menu bar
$ah = FALSE; // Temporary, so that Auction House doesn\'t show up in the menu bar
$items = FALSE; // Temporary, so that items don\'t show up in the menu bar
$friends = FALSE; // Temporary, so that the friends list doesn\'t show up
$tickets = FALSE; // Temporary, so that tickets don\'t show up in the menu bar
?>';
    file_put_contents('../config.php',$write_contents);
    $complete = TRUE;
  }
}

include("views/header.php");
include("views/install.php");

echo $content;
?>