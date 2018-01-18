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
  if (!empty($_SESSION['logged'])) {
  
    // We are already logged in, so obviously we do not need to register
    header("Location: index.php");
  }
  else {
    // Okay, so we aren't logged in, let's see if the form has been initialized yet
    
    if (!empty($_POST['register'])) {
      if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['conf_password']) || empty($_POST['email'])) {
        if (empty($_POST['username'])) {
          $_SESSION['errors']['register'][] = $lang['error']['register']['empty_username'];
          $_SESSION['errors']['validation']['username'] = $lang['error']['register']['empty_username'];
        }
        else {
          $username = $_POST['username'];
        }
        
        if (empty($_POST['password'])) {
          $_SESSION['errors']['register'][] = $lang['error']['register']['empty_password'];
          $_SESSION['errors']['validation']['password'] = $lang['error']['register']['empty_password'];
        }
        else {
          $password = $_POST['password'];
        }
        
        if (empty($_POST['conf_password'])) {
          $_SESSION['errors']['register'][] = $lang['error']['register']['empty_conf_password'];
          $_SESSION['errors']['validation']['conf_password'] = $lang['error']['register']['empty_conf_password'];
        }
        else {
          $conf_password = $_POST['conf_password'];
        }
        
        if (empty($_POST['email'])) {
          $_SESSION['errors']['register'][] = $lang['error']['register']['empty_email'];
          $_SESSION['errors']['validation']['email'] = $lang['error']['register']['empty_email'];
        }
        else {
          $email = $_POST['email'];
        }
      }
      else {
        // No fields were left blank, so let's start validation
         $username = $_POST['username'];
         $password = $_POST['password'];
         $conf_password = $_POST['conf_password'];
         $email = $_POST['email'];
        
        // Do our passwords match?
        if ($password != $conf_password) {
          $_SESSION['errors']['register'][] = $lang['error']['register']['password_mismatch'];
          $_SESSION['errors']['validation']['password'] = $lang['error']['register']['password_mismatch'];
          $_SESSION['errors']['validation']['conf_password'] = $lang['error']['register']['password_mismatch'];
        }
        elseif (strlen($password) < 8) {
          $_SESSION['errors']['register'][] = $lang['error']['register']['password_too_short'];
          $_SESSION['errors']['validation']['password'] = $lang['error']['register']['password_too_short'];
        }
        elseif (strlen($password) > 16) {
          $_SESSION['errors']['register'][] = $lang['error']['register']['password_too_long'];
          $_SESSION['errors']['validation']['password'] = $lang['error']['register']['password_too_short'];
        }
        
        // Now we need to see if the e-mail address given is in valid email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $_SESSION['errors']['register'][] = $lang['error']['register']['invalid_email_format'];
          $_SESSION['errors']['validation']['email'] = $lang['error']['register']['invalid_email_format'];
        }
        
        // Let's see if that email address is already associated with an account
        if (isEmailRegistered($email) == TRUE) {
          $_SESSION['errors']['register'][] = $lang['error']['register']['email_taken'];
          $_SESSION['errors']['validation']['email'] = $lang['error']['register']['email_taken'];
        }
        // Finally, let's check to see if the username exists
        if (getAccountID($username) != '') {
          $_SESSION['errors']['register'][] = $lang['error']['register']['username_taken'];
          $_SESSION['errors']['validation']['username'] = $lang['error']['register']['username_taken'];
        }

        else {
          // Everything appears to be normal, let's create the account now!
          if (createAccount($username,$password,$email)) {
            $_SESSION['auth']['username'] = $username;
            $_SESSION['logged'] = TRUE;
            
            header("Location: index.php");
          }
        }
      }
    }
  }
}
else {
  // If the config file exists, but the system is not installed, throw an error and redirect to the install directory
  header("Location: install/index.php");
}

include_once('themes/'.$theme.'/views/header.php');
include_once('themes/'.$theme.'/views/register.php');
include_once('themes/'.$theme.'/views/footer.php');
echo $output;
?>
