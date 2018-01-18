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
    // We are already logged in, so let's proceed
    
    // Are we viewing the main character list for this account?
    
    if (!empty($_GET['id'])) {
      $id = $_GET['id'];
      include('includes/character_view.php');
    }
    else {
      include('includes/characters.php');
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
include_once('themes/'.$theme.'/views/characters.php');
include_once('themes/'.$theme.'/views/footer.php');
echo $output;
?>
