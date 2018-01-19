<?php

	//Check if the config.php file has already been created.
	//If so, include it, otherwise display an error message
	if (file_exists('../config.php')) {
		include_once('../config.php');
	} else {
		$_SESSION['errors']['general'] = $lang['error']['config'];
	}

	//If the system is installed, proceed
	//'INSTALLED' is defined in the config.php file
	//If the system is not installed, navigate to the install page
	if (defined('INSTALLED')) {

		//includes.php
		include_once('../includes/includes.php');
  		include_once('../includes/functions.php');

	} else {

		// If the config file exists, but the system is not installed, throw an error and redirect to the install directory
  		$_SESSION['errors']['install'] = $lang['error']['install']['not_installed'];
  		header("Location: install/index.php");

	}

	//Get a reference to the database
	global $db;

	//Get parameters from datatables js
	$search = $_GET['search'];
	$orderColGet = $_GET['order'];
	$orderColVal = $orderColGet[0]["column"] + 1;

	//If the user sent a search string from datatables, let's put it into the sql where clause
	if(!empty($search["value"])){
		$searchWhere = " and (charname like :searchValue or replace(name, '_', ' ') like :searchValue)";

	} else {
		$searchWhere = '';
	}

	//Here's the SQL statement to return character information
	$strSQL = '
		SELECT charname , zone_settings.name, mjob, sjob, mlvl, slvl
		FROM chars, zone_settings, char_stats
		WHERE chars.charid in (select charid from accounts_sessions) and chars.pos_zone = zone_settings.zoneid and chars.charid = char_stats.charid'.$searchWhere.'
		ORDER BY '.$orderColVal.' '.$orderColGet[0]["dir"].'
		LIMIT '.$_GET["start"].', '.$_GET["length"].' 
	';

	//Prepare the SQL statement
	$statement = $db->prepare($strSQL);
	$statement->bindValue(':searchValue', '%'.$search["value"].'%');

	//If the statement doesn't work, show an error.  Otherwise, fetch it into an array
	if (!$statement->execute()) {
		//watchdog($statement->errorInfo(),'SQL');
	} else {
		$arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	header('Content-type:application/json;charset=utf-8');

	$json = customJsonEncoder($arrReturn);
	echo($json);
	
	function customJsonEncoder($arrReturn){

		global $jobNames, $jobAbbreviations;

		$json = '
		{
			"draw": '.(int)$_GET['draw'].',
			"recordsTotal": '.onlineCount().',
			"recordsFiltered": '.onlineCount().',
			"data": [
		';

		foreach($arrReturn as $arr){
			$json .= '[';
			$innerjson = '';
			foreach($arr as $key=>$value){
		        //echo the key and value.
		        switch($key){
		        	case "name":{
		        		$innerjson .= '"'.str_replace("_", " ", $value).'",';
		        		break;
		        	}
		        	case ("mjob"):{
		        		$innerjson .= '"Level '.$arr["mlvl"].' '.$jobNames[$value].' ('.$jobAbbreviations[$value].')",';
		        		break;
		        	}
		        	case ("sjob"):{
		        		if($jobNames[$value] == ''){
		        				$innerjson .= '"",';
		        		} else {
		        				$innerjson .= '"Level '.$arr["slvl"].' '.$jobNames[$value].' ('.$jobAbbreviations[$value].')",';
		        		}
		        		break;
		        	}
		        	case("mlvl"):{
		        		break;
		        	}
		        	case("slvl"):{
		        		break;
		        	}
		        	default: {
		        		$innerjson .= '"'.$value.'",';
		        	}
		        }
		    }
		    $json .= chop($innerjson, ',').'],';
		}

		if(sizeOf($arrReturn) > 0){
			$json = chop($json, ',');
		}

		$json .= '
			]}
		';

		echo $json;

	}



?>