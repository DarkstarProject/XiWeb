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

		doLogout();
		header("Location: index.php");

	}

?>