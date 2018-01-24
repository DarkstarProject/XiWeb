<?php

	//Start the session
	session_start();

	//Instantiate errors
	$_SESSION['errors']['install'] = '';
	$_SESSION['errors']['setup'] = '';
	
	//Default language is english
	$language = 'en';

	//First, check to see if the config.php file already exists
	//If it doesn't show an error
	if (file_exists('../config.php')) {

		//Include the config.php file
		include('../config.php');

		//Set the theme to default
  		$theme = 'default';

  		//This php file includes all of the error messages
  		include('lang/en.inc.php');

  		//If the system is already installed, let the user know
		//'INSTALLED' is defined in the config.php file
		//If the system is not installed, show the error
  		if (defined('INSTALLED')) {
		    // The config file exists, but XIWeb is already installed
		    $_SESSION['errors']['install'][] = $lang['error']['install']['xiweb_installed'];
		    $_SESSION['errors']['setup']['checked'] = TRUE;
		  }
		  else {
		    if (!is_writeable('../config.php')) {
		      // XIWeb isn't installed, and the configuration file isn't writeable
		      $_SESSION['errors']['install'][] = $lang['error']['install']['config_unwriteable'];
		      $_SESSION['errors']['setup']['checked'] = TRUE;
		    }
		  }

	} else {

    	//This php file includes all of the error messages
    	include_once('./lang/en.inc.php');

    	//Show the error that the config is missing
    	//$_SESSION['errors']['install'][] = $lang['error']['config']['missing_config'];	

	}

	//Check to see if the user has finished filling out the installation form and is now posting the data back to the server
	if (!empty($_POST['install'])) {

		//Check to make sure we have everything.  It not, tell the user.  If so, continue on
		if (empty($_POST['databaseHost']) || empty($_POST['databasePort']) || empty($_POST['databaseName']) || empty($_POST['serverName'])) {
			// If the required fields are empty, thrown an error.  Otherwise, repopulate the fields with them so the user doesn't have to type them back in
			//Database Host
    		if (empty($_POST['databaseHost'])) {
    			$_SESSION['errors']['install']['missing_host'] = $lang['error']['install']['missing_host'];
    		} else {
    			$databaseHost = $_POST['databaseHost'];
    		}

    		//Database Port
    		if (!empty($_POST['databasePort'])) {
		      $databasePort = $_POST['databasePort'];
		    }
		    else {
		      $databasePort = 3306;
		    }

		    //Database Username
		    if (empty($_POST['databaseUser'])) {
		      $_SESSION['errors']['install']['missing_user'] = $lang['error']['install']['missing_user'];
		    }
		    else {
		      $databaseUser = $_POST['databaseUser'];
		    }

		    //Database User Password
		    if (empty($_POST['databaseUserPassword'])) {
		      $_SESSION['errors']['install']['missing_password'] = $lang['error']['install']['missing_password'];
		    }
		    else {
		      $databaseUserPassword = $_POST['databaseUserPassword'];
		    }

		    //Name of the database
		    if (empty($_POST['databaseName'])) {
		      $_SESSION['errors']['install']['missing_database'] = $lang['error']['install']['missing_database'];
		    }
		    else {
		      $databaseName = $_POST['databaseName'];
		    }

		    //Name of the FFXI server
		    if (empty($_POST['serverName'])) {
		      $_SESSION['errors']['install']['missing_servername'] = $lang['error']['install']['missing_servername'];
		    }
		    else {
		      $serverName = $_POST['serverName'];
		    }

		    //Address of the FFXI server
		    if (empty($_POST['serverAddress'])) {
		      $_SESSION['errors']['install']['missing_serveraddress'] = $lang['error']['install']['missing_serveraddress'];
		    }
		    else {
		      $serverAddress = $_POST['serverAddress'];
		    }

		} else {

			//Looks like we got enough information to create the config.php file.  Let's do it!
			$databaseHost = $_POST['databaseHost'];
			(!empty($_POST['databasePort']) ? $databasePort = $_POST['databasePort'] : $databasePort = 3306);
			$databaseUser = $_POST['databaseUser'];
		    $databaseUserPassword = $_POST['databaseUserPassword'];
			$databaseName = $_POST['databaseName'];
			$serverName = $_POST['serverName'];
			$serverAddress = $_POST['serverAddress'];

			//Contents of the config.php file
			$write_contents = '
<?php

	//This tells the site that installation is complete
	define(\'INSTALLED\',TRUE);

	//This variable will be detected for future updates
	$configVersion = \'1.0\';

	//This indicates which theme to use
	$theme = \'default\';

	//This indicates which language to use
	$language = \'en\';

	//This is the connection information to the database
	$db_host = \''.$databaseHost.'\';
	$db_port = \''.$databasePort.'\';
	$db_user = \''.$databaseUser.'\';
	$db_pass = \''.$databaseUserPassword.'\';
	$db_name = \''.$databaseName.'\';

	//This is the title displayed in the browser tab and the addres to check the status of the server
	$site_name = \''.addslashes($serverName).'\';
	$server_address = \''.$serverAddress.'\';

	//These display text on the page
	$frontpage_title = \'XIWeb Installation\';
	$frontpage_message = \'This is the default front-page message for your XIWeb installation. To change this, please check the configuration file.\';

	//These variables are for displaying the news items on the main page (will be changed to use a database in future versions)
	//Set a newsTitle to an empty string to hide that news item
	$newsTitle1 = \'News Title 1\';
	$newsSummary1 = \'News Description 1: <b>HTML</b> is <i>allowed</i>\';
	$newsDetails1 = \'
		News Details 1
	\';
	$newsTitle2 = \'News Title 2\';
	$newsSummary2 = \'News Description 2: <b>HTML</b> is <i>allowed</i>\';
	$newsDetails2 = \'
		News Details 2
	\';
	$newsTitle3 = \'News Title 3\';
	$newsSummary3 = \'News Description 3: <b>HTML</b> is <i>allowed</i>\';
	$newsDetails3 = \'
		News Details 3
	\';

?>				
			';

			//Write the config.php file
			file_put_contents('../config.php',$write_contents);

			header("Location: ../index.php");

		}

	}

	//These php files generate the html content to display
	include("views/header.php");
	include("views/navbar.php");
	include("views/index.php");
	include("views/footer.php");
	echo $output;

?>