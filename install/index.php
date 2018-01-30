<?php

	//Start the session
	session_start();

	$install_version = "1.0";

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
		if (empty($_POST['FFXIdatabaseHost']) || empty($_POST['FFXIdatabasePort']) || empty($_POST['FFXIdatabaseName']) || empty($_POST['FFXIdatabaseUser']) || $_POST['FFXIdatabasePassword'] ||
			empty($_POST['XIWEBdatabaseName']) || empty($_POST['XIWEBdatabaseUser']) || $_POST['XIWEBdatabasePassword'] ||
			empty($_POST['serverName'])) {
			// If the required fields are empty, thrown an error.  Otherwise, repopulate the fields with them so the user doesn't have to type them back in
			//Database Host
    		if (empty($_POST['FFXIdatabaseHost'])) {
    			$_SESSION['errors']['install']['missing_host'] = $lang['error']['install']['missing_host'];
    		} else {
    			$databaseHost = $_POST['FFXIdatabaseHost'];
    		}

    		//Database Port
    		if (!empty($_POST['FFXIdatabasePort'])) {
		      $databasePort = $_POST['FFXIdatabasePort'];
		    }
		    else {
		      $databasePort = 3306;
		    }

		    //Database Username
		    if (empty($_POST['FFXIdatabaseUser'])) {
		      $_SESSION['errors']['install']['missing_user'] = $lang['error']['install']['missing_user'];
		    }
		    else {
		      $databaseUser = $_POST['FFXIdatabaseUser'];
		    }

		    //Database User Password
		    if (empty($_POST['FFXIdatabaseUserPassword'])) {
		      $_SESSION['errors']['install']['missing_password'] = $lang['error']['install']['missing_password'];
		    }
		    else {
		      $databaseUserPassword = $_POST['FFXIdatabaseUserPassword'];
		    }

		    //Name of the database
		    if (empty($_POST['FFXIdatabaseName'])) {
		      $_SESSION['errors']['install']['missing_database'] = $lang['error']['install']['missing_database'];
		    }
		    else {
		      $databaseName = $_POST['FFXIdatabaseName'];
		    }

		    //Database Username
		    if (empty($_POST['XIWEBdatabaseUser'])) {
		      $_SESSION['errors']['install']['missing_user'] = $lang['error']['install']['missing_user'];
		    }
		    else {
		      $databaseUser = $_POST['XIWEBdatabaseUser'];
		    }

		    //Database User Password
		    if (empty($_POST['XIWEBdatabaseUserPassword'])) {
		      $_SESSION['errors']['install']['missing_password'] = $lang['error']['install']['missing_password'];
		    }
		    else {
		      $databaseUserPassword = $_POST['XIWEBdatabaseUserPassword'];
		    }

		    //Name of the database
		    if (empty($_POST['XIWEBdatabaseName'])) {
		      $_SESSION['errors']['install']['missing_database'] = $lang['error']['install']['missing_database'];
		    }
		    else {
		      $databaseName = $_POST['XIWEBdatabaseName'];
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

		    //Allow users to register
		    if (!empty($_POST['newAccountRegistration'])) {		      
		      $newAccountRegistration = $_POST['newAccountRegistration'];
		    }

		    //Use reCAPTCHA
		    if (!empty($_POST['useRecaptcha'])) {		      
		      $useRecaptcha = $_POST['useRecaptcha'];
		    }

		    //reCAPTCHA Site Key
		    if (!empty($_POST['recaptchaSiteKey'])) {		      
		      $recaptchaSiteKey = $_POST['recaptchaSiteKey'];
		    }

		    //reCAPTCHA Secret Key
		    if (!empty($_POST['recaptchaSecretKey'])) {		      
		      $recaptchaSecretKey = $_POST['recaptchaSecretKey'];
		    }

		} else {

			//Looks like we got enough information to create the config.php file.  Let's do it!
			$FFXIdatabaseHost = $_POST['FFXIdatabaseHost'];
			(!empty($_POST['FFXIdatabasePort']) ? $FFXIdatabasePort = $_POST['FFXIdatabasePort'] : $FFXIdatabasePort = 3306);
			$FFXIdatabaseUser = $_POST['FFXIdatabaseUser'];
		    $FFXIdatabaseUserPassword = $_POST['FFXIdatabaseUserPassword'];
			$FFXIdatabaseName = $_POST['FFXIdatabaseName'];
			$XIWEBdatabaseUser = $_POST['XIWEBdatabaseUser'];
		    $XIWEBdatabaseUserPassword = $_POST['XIWEBdatabaseUserPassword'];
			$XIWEBdatabaseName = $_POST['XIWEBdatabaseName'];
			$serverName = $_POST['serverName'];
			$serverAddress = $_POST['serverAddress'];
			$newAccountRegistration = ($_POST['newAccountRegistration'] == 'on' ? TRUE : FALSE);
			$useRecaptcha = ($_POST['useRecaptcha'] == 'on' ? TRUE : FALSE);
			$recaptchaSiteKey = $_POST['recaptchaSiteKey'];
		    $recaptchaSecretKey = $_POST['recaptchaSecretKey'];

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
	$db_host = \''.$FFXIdatabaseHost.'\';
	$db_port = \''.$FFXIdatabasePort.'\';
	$FFXI_db_user = \''.$FFXIdatabaseUser.'\';
	$FFXI_db_pass = \''.$FFXIdatabaseUserPassword.'\';
	$FFXI_db_name = \''.$FFXIdatabaseName.'\';
	$XIWEB_db_user = \''.$XIWEBdatabaseUser.'\';
	$XIWEB_db_pass = \''.$XIWEBdatabaseUserPassword.'\';
	$XIWEB_db_name = \''.$XIWEBdatabaseName.'\';

	//This is the title displayed in the browser tab and the addres to check the status of the server
	$site_name = \''.addslashes($serverName).'\';
	$server_address = \''.$serverAddress.'\';

	$bannerBackground = \'themes/default/images/bg.jpg\';

	//These display text on the page
	$frontpage_title = \'XIWeb Installation\';
	$frontpage_message = \'This is the default front-page message for your XIWeb installation. To change this, please check the configuration file.\';

	//These variables are for displaying the news items on the main page (will be changed to use a database in future versions)
	//Set a newsTitle to an empty string to hide that news item
	$newsTitle1 = \'News Title 1\';
	$newsSummary1 = \'
		<div style="height:200px;background-image: url(\\\'themes/default/images/news/news1.jpg\\\');background-repeat:no-repeat;background-size:cover;"></div>
		<p>News Summary 1: <b>HTML</b> is <i>allowed</i></p>
	\';
	$newsDetails1 = \'
		<img src="themes/default/images/news/news1.jpg" style="height:300px;padding:10px" align="left"/>
		<p style="padding:10px;">This is the description of the first news item.  Feel free to put whatever you want here.  This text can contain <b>HTML</b> tags.</p>
	\';
	$newsShow1 = TRUE;

	$newsTitle2 = \'News Title 2\';
	$newsSummary2 = \'
		<div style="width:100%;height:200px;background-image: url(\\\'themes/default/images/news/news2.jpg\\\');background-repeat:no-repeat;background-size:cover;"></div>
		<p>News Description 2: <b>HTML</b> is <i>allowed</i></p>
	\';
	$newsDetails2 = \'
		<img src="themes/default/images/news/news2.jpg" style="height:300px;padding:10px" align="left"/>
		<p style="padding:10px;">This is the description of the second news item.  Feel free to put whatever you want here.  This text can contain <b>HTML</b> tags.</p>
	\';
	$newsShow2 = TRUE;

	$newsTitle3 = \'News Title 3\';
	$newsSummary3 = \'
		<div style="width:100%;height:200px;background-image: url(\\\'themes/default/images/news/news3.jpg\\\');background-repeat:no-repeat;background-size:cover;"></div>
		<p>News Description 3: <b>HTML</b> is <i>allowed</i></p>
	\';
	$newsDetails3 = \'
		<img src="themes/default/images/news/news3.jpg" style="height:300px;padding:10px" align="left"/>
		<p style="padding:10px;">This is the description of the third news item.  Feel free to put whatever you want here.  This text can contain <b>HTML</b> tags.</p>
	\';
	$newsShow3 = TRUE;

	$allowAccountRegistration = '.($newAccountRegistration ? 'TRUE' : 'FALSE').';
	$useRecaptcha = '.($useRecaptcha ? 'TRUE' : 'FALSE').';
	$recaptchaSiteKey = \''.$recaptchaSiteKey.'\';
	$recaptchaSecretKey = \''.$recaptchaSecretKey.'\';

	$install_version = '.$install_version.';

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