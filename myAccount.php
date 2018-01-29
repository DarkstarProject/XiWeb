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

  		//If the user is trying to update, let's give it a go
  		if (!empty($_POST['update'])) {

  			// We need to check if the credentials supplied match. If not, let the user know.
	    	if (!doLogin($_SESSION['auth']['username'],$_POST['password'])) {
	    		$_SESSION['errors']['account'] = '';
		        $_SESSION['errors']['account'][] = $lang['error']['auth']['invalid_login']; 
	    	} else {

	    		if(!empty($_POST['email'])){
	    			if(updateEmail($_SESSION['auth']['username'], $_POST['email']) == 0){
		    			$_SESSION['errors']['account'][] = $lang['error']['account']['email_fail']; 
		    		} else {
		    			$_SESSION['messages']['account'][] = $lang['messages']['account']['email_success'];
		    		}
	    		}

	    		if(!empty($_POST['newPassword'])){
	    			if(updatePassword($_SESSION['auth']['username'], $_POST['newPassword']) == 0){
		    			$_SESSION['errors']['account'][] = $lang['error']['account']['password_fail']; 
		    		} else {
		    			$_SESSION['messages']['account'][] = $lang['messages']['account']['password_success'];
		    		}
	    		}

	    	}

  		}

	} else {

		// If the config file exists, but the system is not installed, throw an error and redirect to the install directory
  		$_SESSION['errors']['install'] = $lang['error']['install']['not_installed'];
  		header("Location: install/index.php");

	}

	//Get a reference to the database
	global $db;

	//Here's the SQL statement to return character information
	$strSQL = '
		SELECT login, timecreate, email
		FROM accounts
		WHERE login = :account
	';

	//Prepare the SQL statement
	$statement = $db->prepare($strSQL);
	$statement->bindValue(':account', $_SESSION['auth']['username']);

	//If the statement doesn't work, show an error.  Otherwise, fetch it into an array
	if (!$statement->execute()) {
		//watchdog($statement->errorInfo(),'SQL');
	} else {
		$arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	//These php files generate the html content to display
	include_once('themes/'.$theme.'/views/header.php');
	include_once('themes/'.$theme.'/views/navbar.php');
	include_once('themes/'.$theme.'/views/myAccount.php');
	include_once('themes/'.$theme.'/views/footer.php');
	echo $output;

?>