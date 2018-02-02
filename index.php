<?php

	//This is the required version of the config file.  This will be updated as the installation process is updated to make sure
	//the user is notified to update his or her config file to make it compatible
	$requiredConfigVersion = '1.0';

	//Check if the config.php file has already been created.
	//If so, include it, otherwise display an error message
	if (file_exists('config.php')) {
		include_once('config.php');
	} else {
		//$_SESSION['errors']['general'] = $lang['error']['config'];
	}

	//If the system is installed, proceed
	//'INSTALLED' is defined in the config.php file
	//If the system is not installed, navigate to the install page
	if (defined('INSTALLED')) {

		//includes.php
		include_once('./lang/'.$language.'.inc.php');
		include_once('includes/includes.php');
  		include_once('includes/functions.php');

  		//Check Version
		if(empty($configVersion) || $configVersion != $requiredConfigVersion){
			$_SESSION['errors']['install'][] = $lang['error']['install']['invalid_config_file_version'];
		}

	} else {

		// If the config file exists, but the system is not installed, throw an error and redirect to the install directory
  		$_SESSION['errors']['install'][] = $lang['error']['install']['not_installed'];
  		header("Location: install/index.php");

	}

	$newsTitles = [];
	$newsSummaries = [];

	if($newsShow1){
		$newsTitles[] = $newsTitle1;
		$newsSummaries[] = $newsSummary1;
	}
	if($newsShow2){
		$newsTitles[] = $newsTitle2;
		$newsSummaries[] = $newsSummary2;
	}
	if($newsShow3){
		$newsTitles[] = $newsTitle3;
		$newsSummaries[] = $newsSummary3;
	}

	if(sizeof($newsTitles) > 0) {
		$newsCountColSize = 12 / sizeof($newsTitles);
	}

	//These php files generate the html content to display
	include_once('themes/'.$theme.'/views/header.php');
	include_once('themes/'.$theme.'/views/navbar.php');
	include_once('themes/'.$theme.'/views/index.php');
	include_once('themes/'.$theme.'/views/footer.php');
	echo $output;

?>