<?php

	//Check if the config.php file has already been created.
	//If so, include it, otherwise display an error message
	if (file_exists('config.php')) {
		include_once('config.php');
	} else {
		//$_SESSION['errors']['general'] = $lang['error']['config'];
	}

	$showPasswordReset = false;

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
		if(!empty($_POST['resetPassword'])){

			$accountID = $_POST['account'];
  			$token = $_POST['token'];
  			$newPassword = $_POST['newPassword'];
  			$newPasswordConfirm = $_POST['newPasswordConfirm'];

  			if(!empty($accountID) && !empty($token)){
  				if(validatePasswordRequest($accountID, $token) == 0){
  					$_SESSION['errors']['password_reset'][] = $lang['error']['password_reset']['general_error'];
  				} else {
  					if($newPassword != $newPasswordConfirm){
  						$_SESSION['errors']['password_reset'][] = $lang['error']['password_reset']['password_match'];
  					} else {
  						if(resetAccountPassword($accountID, $newPassword) == 0){
  							$_SESSION['errors']['password_reset'][] = $lang['error']['password_reset']['general_error'];
  						} else {
  							$_SESSION['messages']['password_reset'][] = $lang['message']['password_reset']['success_done'];
  						}
  					}
  				}
  			}			

		} else if (!empty($_GET['account'])) {

  			$accountID = $_GET['account'];
  			$token = $_GET['token'];
  			
  			if(!empty($accountID) && !empty($token)){
  				if(validatePasswordRequest($accountID, $token) == 0){
  					$_SESSION['errors']['password_reset'][] = $lang['error']['password_reset']['general_error'];
  				} else {
  					$showPasswordReset = true;
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
	include_once('themes/'.$theme.'/views/passwordResetFinish.php');
	include_once('themes/'.$theme.'/views/footer.php');
	echo $output;

?>