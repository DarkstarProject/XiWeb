<?php

	//Check if the config.php file has already been created.
	//If so, include it, otherwise display an error message
	if (file_exists('config.php')) {
		include_once('config.php');
	} else {
		$_SESSION['errors']['general'] = $lang['error']['config'];
	}

	//If the system is installed, proceed
	//'INSTALLED' is defined in the config.php file
	//If the system is not installed, navigate to the install page
	if (defined('INSTALLED')) {

		//includes.php
		include_once('./lang/'.$language.'.inc.php');
		include_once('includes/includes.php');
  		include_once('includes/functions.php');

  		unset($_SESSION['messages']);
		unset($_SESSION['errors']);

  		//If the user is trying to reset password, let's give it a go
  		if (!empty($_POST['resetPassword'])) {

  			$accountID = getAccountID($_POST['username']);
  			if($accountID == 0){
  				$_SESSION['errors']['password_reset'][] = $lang['error']['password_reset']['account_not_found'];
  			} else {
  				if(createPasswordRequest($accountID) == 0){
  					$_SESSION['errors']['password_reset'][] = $lang['error']['password_reset']['general_error'];
  				} else {
  					$_SESSION['messages']['password_reset'][] = $lang['message']['password_reset']['success'];
  				}
  			}

  		}

	} else {

		// If the config file exists, but the system is not installed, throw an error and redirect to the install directory
  		//$_SESSION['errors']['install'] = $lang['error']['install']['not_installed'];
  		header("Location: install/index.php");

	}

	//These php files generate the html content to display
	include_once('themes/'.$theme.'/views/header.php');
	include_once('themes/'.$theme.'/views/navbar.php');
	include_once('themes/'.$theme.'/views/passwordResetStart.php');
	include_once('themes/'.$theme.'/views/footer.php');
	echo $output;

?>