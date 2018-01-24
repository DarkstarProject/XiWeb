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

	} else {

		// If the config file exists, but the system is not installed, throw an error and redirect to the install directory
  		$_SESSION['errors']['install'] = $lang['error']['install']['not_installed'];
  		header("Location: install/index.php");

	}

	$myCharacters = getMyCharacters();

	if(!empty($_GET['index'])){
		$selectedCharacter = $myCharacters[$_GET['index']];
	} else {
		if(!empty($myCharacters)){
			$selectedCharacter = $myCharacters[0];
		}
	}

	if(!empty($myCharacters)){
		$selectedCharacterSkills = getCharacterSkills($selectedCharacter['charid']);
		$selectedCharacterSpells = getCharacterSpells($selectedCharacter['charid']);
		$selectedCharacterEquipment = getCharacterEquipment($selectedCharacter['charid']);
		$selectedCharacterCurrencies = getCharacterCurrencies($selectedCharacter['charid']);
	}

	global $jobAbbreviations, $jobNames, $nations, $faces, $races;

	function showCharacterJobs($selectedCharacter){

		global $jobAbbreviations;

		if($selectedCharacter['sjob'] == 0){
			return $selectedCharacter['mlvl'].' '.strtoupper($jobAbbreviations[$selectedCharacter['mjob']]);
		} else {
			return $selectedCharacter['mlvl'].' '.strtoupper($jobAbbreviations[$selectedCharacter['mjob']]).' / '.$selectedCharacter['slvl'].' '.strtoupper($jobAbbreviations[$selectedCharacter['sjob']]);
		}

	}

	//These php files generate the html content to display
	include_once('themes/'.$theme.'/views/header.php');
	include_once('themes/'.$theme.'/views/navbar.php');
	include_once('themes/'.$theme.'/views/myCharacters.php');
	include_once('themes/'.$theme.'/views/footer.php');
	echo $output;

?>