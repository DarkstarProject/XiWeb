<?php

	//If the config file exists, bring it in
	//Otherwise, show an error
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

  		//If the user is trying to login, let's give it a go
  		if (!empty($_POST['login'])) {

  			//If either the username of password param is empty, then throw an error.  Otherwise, try to authenticate
  			if (empty($_POST['username']) || empty($_POST['password'])) {
		        if (empty($_POST['username'])) {
		          $_SESSION['errors']['login'][] = $lang['error']['auth']['empty_username']; 
		          $_SESSION['errors']['validation']['username'] = 1;
		        }
		        if (empty($_POST['password'])) {
		          $_SESSION['errors']['login'][] = $lang['error']['auth']['empty_password']; 
		          $_SESSION['errors']['validation']['password'] = 2;
		        }
		    } else {

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
		        	} else {
		          		header("Location: index.php");
		         	}
		      	}

		    }

  		}

	}

	//These php files generate the html content to display
	include_once('themes/'.$theme.'/views/header.php');
	include_once('themes/'.$theme.'/views/navbar.php');
	include_once('themes/'.$theme.'/views/login.php');
	include_once('themes/'.$theme.'/views/footer.php');
	echo $output;

?>