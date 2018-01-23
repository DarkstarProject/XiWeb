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
	$charid = $_GET['charid'];
	$search = $_GET['search'];
	$orderColGet = $_GET['order'];
	$orderColVal = $orderColGet[0]["column"] + 1;

	//If the user sent a search string from datatables, let's put it into the sql where clause
	if(!empty($search["value"])){
		$searchWhere = " and (replace(name, '_', ' ') like :searchValue)";

	} else {
		$searchWhere = '';
	}

	$strSQLAll = '
		SELECT char_inventory.itemid, name, quantity, location
	    FROM `char_inventory`
	    JOIN item_basic on char_inventory.itemId = item_basic.itemid
	    WHERE charid = :charid and name <> \'gil\'
	';

	//Here's the SQL statement to return character information
	$strSQLFiltered = '
		SELECT char_inventory.itemid, name, quantity, location
	    FROM `char_inventory`
	    JOIN item_basic on char_inventory.itemId = item_basic.itemid
	    WHERE charid = :charid and name <> \'gil\''.$searchWhere.'
	';

	//Here's the SQL statement to return character information
	$strSQL = '
		SELECT char_inventory.itemid, name, quantity, location
	    FROM `char_inventory`
	    JOIN item_basic on char_inventory.itemId = item_basic.itemid
	    WHERE charid = :charid and name <> \'gil\''.$searchWhere.'
		ORDER BY '.$orderColVal.' '.$orderColGet[0]["dir"].'
		LIMIT '.$_GET["start"].', '.$_GET["length"].' 
	';

	//Prepare the SQL statement
	$statement = $db->prepare($strSQL);
	if($searchWhere != ''){
		$statement->bindValue(':searchValue', '%'.$search["value"].'%');
	}
	$statement->bindValue(':charid', $charid);

	//$statement->debugDumpParams();

	//If the statement doesn't work, show an error.  Otherwise, fetch it into an array
	if (!$statement->execute()) {
		//watchdog($statement->errorInfo(),'SQL');
	} else {
		$arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	//Prepare the SQL statement
	$filteredStatement = $db->prepare($strSQLFiltered);
	if($searchWhere != ''){
		$filteredStatement->bindValue(':searchValue', '%'.$search["value"].'%');
	}
	$filteredStatement->bindValue(':charid', $charid);

	//If the statement doesn't work, show an error.  Otherwise, fetch it into an array
	if (!$filteredStatement->execute()) {
		//watchdog($statement->errorInfo(),'SQL');
	} else {
		$arrReturnFiltered = $filteredStatement->fetchAll(PDO::FETCH_ASSOC);	
	}

	//Prepare the SQL statement
	$allStatement = $db->prepare($strSQLAll);
	$allStatement->bindValue(':charid', $charid);

	//If the statement doesn't work, show an error.  Otherwise, fetch it into an array
	if (!$allStatement->execute()) {
		//watchdog($statement->errorInfo(),'SQL');
	} else {
		$arrReturnAll = $allStatement->fetchAll(PDO::FETCH_ASSOC);	
	}

	header('Content-type:application/json;charset=utf-8');

	//$arrReturnFiltered = array();

	$json = customJsonEncoder($arrReturn, $arrReturnFiltered, $arrReturnAll);
	echo($json);
	
	function customJsonEncoder($arrReturn, $arrReturnFiltered, $arrReturnAll){

		global $ahItemTypes, $inventoryLocations;

		$json = '
		{
			"draw": '.(int)$_GET['draw'].',
			"recordsTotal": '.sizeOf($arrReturnAll).',
			"recordsFiltered": '.sizeOf($arrReturnFiltered).',
			"data": [
		';

		foreach($arrReturn as $arr){
			$json .= '[';
			$innerjson = '';
			foreach($arr as $key=>$value){
		        //echo the key and value.
		        switch($key){
		        	case("itemid"):{
		        		$value = '<img src=\'http://static.ffxiah.com/images/icon/'.$value.'.png\');/>';
		        		$innerjson .= '"'.$value.'",';
		        		break;
		        	}
		        	case("name"):{
		        		$value = ucwords(str_replace("_", " ", $value));
		        		$innerjson .= '"'.$value.'",';
		        		break;
		        	}
		        	case("type"):{
		        		if(!empty($ahItemTypes[$value])){
		        			$value = $ahItemTypes[$value];
		        		}
						$innerjson .= '"'.$value.'",';
						break;
					}
					case("location"):{
						$innerjson .= '"'.$inventoryLocations[$value].'",';
						break;
					}
		        	case("stack"):{
		        		if($value == 0){
		        			$value = 'No';
		        		} else {
		        			$value = 'Yes';
		        		}
		        		$innerjson .= '"'.$value.'",';
		        		break;
		        	}
		        	case("price"):{
		        		$innerjson .= '"'.$value.' gil",';
		        		break;
		        	}
		        	default: {
		        		$innerjson .= '"'.$value.'",';
		        	}
		        }
		    }
		    $innerjson .= '"<a target=\'_blank\' href=\'http://ffxiclopedia.wikia.com/wiki/'.htmlentities(ucwords($arr["name"], " _-")).'\'>FFXIClopedia</a>",';
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