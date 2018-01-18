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
    
    // Let's find out if we are reading a message, or if we are at the main message page
    
    if (!empty($_GET['a']) && ($_GET['a'] == 'compose')) {
      include_once('includes/messages_compose.php');
      $page = 'messages_compose.php';
    }
    elseif (!empty($_GET['id'])) {
      $id = $_GET['id'];
      include_once('includes/messages_read.php');
      $page = 'messages_read.php';
    }
    else {
        include_once('includes/messages.php');
        $page = 'messages.php';
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
include_once('themes/'.$theme.'/views/'.$page);
include_once('themes/'.$theme.'/views/footer.php');
echo $output;
?>
