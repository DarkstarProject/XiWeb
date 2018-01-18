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
    // Are we trying to log in, or is this the first visit to the page
    if (!empty($_POST['login'])) {
      if (empty($_POST['username']) || empty($_POST['password'])) {
        if (empty($_POST['username'])) {
          $_SESSION['errors']['login'][] = $lang['error']['auth']['empty_username']; 
          $_SESSION['errors']['validation']['username'] = 1;
        }
        if (empty($_POST['password'])) {
          $_SESSION['errors']['login'][] = $lang['error']['auth']['empty_password']; 
          $_SESSION['errors']['validation']['password'] = 2;
        }
      }
      else {
       // We need to check if the credentials supplied match. If not, let the user know.
       if (!doLogin($_POST['username'],$_POST['password'])) {
         $_SESSION['errors']['login'] = '';
         $_SESSION['errors']['login'][] = $lang['error']['auth']['invalid_login']; 
       }
       else {

         // The credentials matched, so let's log in.
         $_SESSION['logged'] = TRUE;
         $_SESSION['auth']['username'] = $_POST['username'];
         
         // Let's see if we were directed here from another page. If we were, send them back there after login
         if (!empty($_SESSION['destination'])) {
          header("Location: ". $_SESSION['destination']);
         }
         else {
          header("Location: index.php");
         }
       }
     }
    }
  }
  else {
    // We are already logged in, no sense being here.
    header("Location: index.php");
  }
}
else {
  // If the config file exists, but the system is not installed, throw an error and redirect to the install directory
  header("Location: install/index.php");
}

include_once('themes/'.$theme.'/views/header.php');
include_once('themes/'.$theme.'/views/login.php');
include_once('themes/'.$theme.'/views/footer.php');
echo $output;
?>
