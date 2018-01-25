<?php

	//Get the count of online sessions currently on the server

	//Check if the config.php file has already been created.
	//If so, include it, otherwise display an error message
	if (file_exists('../config.php')) {
		include_once('../config.php');
		
;	} else {
		//$_SESSION['errors']['general'] = $lang['error']['config'];
		
	}

	//If the system is installed, proceed
	//'INSTALLED' is defined in the config.php file
	//If the system is not installed, navigate to the install page
	if (defined('INSTALLED')) {

		//includes.php
		//include_once('../lang/'.$language.'.inc.php');
		include_once('../includes/includes.php');
  		include_once('../includes/functions.php');

	} else {

		// If the config file exists, but the system is not installed, throw an error and redirect to the install directory
  		//$_SESSION['errors']['install'] = $lang['error']['install']['not_installed'];
  		header("Location: install/index.php");

	}

	//Get a reference to the database
	global $db;

	$strSQL = "SELECT COUNT(*) FROM `auction_house` where sale = 0";
	$statement = $db->prepare($strSQL);

	if (!$statement->execute()) {
		//watchdog($statement->errorInfo(),'SQL');
	}
	else {
		$arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	if (!empty($arrReturn)) {
		echo $arrReturn[0]['COUNT(*)'];
	}
	else {
		echo 0;
	}

?>