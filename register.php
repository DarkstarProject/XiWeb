<?php

	//Check if the config.php file has already been created.
	//If so, include it, otherwise display an error message
	if (file_exists('config.php')) {
		include_once('config.php');
	} else {
		$_SESSION['errors']['general'] = $lang['error']['config'];
	}

	//Get the reCAPTCHA PHP Library in case we need it
	//Source https://github.com/google/recaptcha
	require('includes/Recaptcha/src/autoload.php');

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

		$_SESSION['messages']['registration'] = '';
		$_SESSION['errors']['registration'] = '';

		//Check to see if registration is allowed.  If not, continue no further
		if ($allowAccountRegistration == FALSE){
			$_SESSION['errors']['registration'][] = $lang['error']['registration']['not_allowed'];	
		}

  		//If this is a post back from the register form, let's see if we can process it or if we need to return some errors
  		if (!empty($_POST['register']) && $allowAccountRegistration) {

  			//Grab the post parameters
  			$username = $_POST['username'];
  			$password1 = $_POST['password1'];
  			$password2 = $_POST['password2'];
  			$email = $_POST['email'];

  			//Check reCAPTCHA to make sure it's not a bot or something
  			if($useRecaptcha){
  				$gRecaptchaResponse = $_POST['g-recaptcha-response'];
	  			$remoteIp = getRealIPAddr();
	  			$recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecretKey);
				$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
  			}

			if ($useRecaptcha == FALSE || $resp->isSuccess()) {
			    // verified!
			    // if Domain Name Validation turned off don't forget to check hostname field
			    // if($resp->getHostName() === $_SERVER['SERVER_NAME']) {  }

				//Do some error checking
	  			if(empty($username) || empty($password1) || empty($password2)){

	  				if(empty($username)){
	  					$_SESSION['errors']['registration'][] = $lang['error']['registration']['user_empty'];
	  				}

	  				if(empty($password1)){
	  					$_SESSION['errors']['registration'][] = $lang['error']['registration']['password_empty'];
	  				}

	  				if(empty($password2)){
	  					$_SESSION['errors']['registration'][] = $lang['error']['registration']['password_empty'];
	  				}

	  			} else {

	  				//If the user name exists, tell the user and don't register
		  			if(getAccountID($username) > 0){
		  				$_SESSION['errors']['registration'][] = $lang['error']['registration']['user_exists'];
		  			} else 	if($password1 != $password2){
		  				//Check if the passwords match
		  				$_SESSION['errors']['registration'][] = $lang['error']['registration']['password_match'];	
		  			} else {

		  				if(createAccount($username, $password1, $email)){
		  					$_SESSION['messages']['registration'][] = $lang['message']['registration']['account_created'];
		  					$username = '';
		  					$email = '';
		  				} else {
		  					$_SESSION['errors']['registration'][] = $lang['error']['registration']['general_error'];
		  				}

		  			}

	  			}

			} else {
			    $errors = $resp->getErrorCodes();
			    $_SESSION['errors']['registration'][] = $lang['error']['registration']['reCAPTCHA'];			    
			}

  		} else {

  			$username = '';
  			$email = '';

  		}

	} else {

		// If the config file exists, but the system is not installed, throw an error and redirect to the install directory
  		$_SESSION['errors']['install'] = $lang['error']['install']['not_installed'];
  		header("Location: install/index.php");

	}

	//These php files generate the html content to display
	include_once('themes/'.$theme.'/views/header.php');
	include_once('themes/'.$theme.'/views/navbar.php');
	include_once('themes/'.$theme.'/views/register.php');
	include_once('themes/'.$theme.'/views/footer.php');
	echo $output;

?>