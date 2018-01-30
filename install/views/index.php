<?php

	$output .= '
				<main role="main">
				<p></p>
	';

	//If there were errors, let's show them.
	if(!empty($_SESSION['errors']['install'])){
		
		foreach ($_SESSION['errors']['install'] as $error) {
     		$output .= '
				<div class="container alert alert-danger">
					'.$error.'
				</div>
			';
    	}

	}

	$output .= '
				<div class="container">
					<p class="lead">Thank you for using the XIWeb FFXI Server Front-End</p>
					<p class="lead">To proceed with the installation, please fill out the information below and click the Complete Installation button.</p>
				</div>

				<div class="container" style="padding-top:20px;padding-bottom:100px;">
					<form method="post" action="index.php">
						<div class="container" style="border:5px solid;border-radius:20px;">
							<h2>FFXI Database Configuration</h2>
							<h4>These properties are needed to connect to your FFXI Server database to display information from your server.</h4>
							<div class="form-group">
								<label>FFXI Database Server Address</label>
								<input type="text" class="form-control" name="FFXIdatabaseHost" '.(!empty($FFXIdatabaseHost) ? 'value='.$FFXIdatabaseHost.'' : '').' placeholder="e.g. localhost" required>
								<small id="databaseServerAddressHelp" class="form-text text-muted">This is the address of the server on which the FFXI database is running.</small>
							</div>
							<div class="form-group">
								<label>FFXI Database Server Port</label>
								<input type="number" class="form-control" name="FFXIdatabasePort" '.(!empty($FFXIdatabasePort) ? 'value='.$FFXIdatabasePort.'' : '').' placeholder="e.g. 3306" required>
								<small id="databaseServerPortHelp" class="form-text text-muted">This is the port of the server on which the FFXI database is running.</small>
							</div>
							<div class="form-group">
								<label>FFXI Database Username</label>
								<input type="text" class="form-control" name="FFXIdatabaseUser" '.(!empty($FFXIdatabaseUser) ? 'value='.$FFXIdatabaseUser.'' : '').' placeholder="e.g. admin" required>
								<small id="databaseUserHelp" class="form-text text-muted">This is a database user that can connect to the FFXI database.</small>
							</div>
							<div class="form-group">
								<label>FFXI Database User Password</label>
								<input type="password" class="form-control" name="FFXIdatabaseUserPassword" '.(!empty($FFXIdatabaseUserPassword) ? 'value='.$FFXIdatabaseUserPassword.'' : '').' placeholder="e.g. password" required>
								<small id="databaseUserPasswordHelp" class="form-text text-muted">This is the password for the indicated FFXI database user.</small>
							</div>
							<div class="form-group">
								<label>Name of the FFXI Database</label>
								<input type="text" class="form-control" name="FFXIdatabaseName" '.(!empty($FFXIdatabaseName) ? 'value='.$FFXIdatabaseName.'' : '').' placeholder="e.g. oldschool" required>
								<small id="databaseNameHelp" class="form-text text-muted">This is the name of the database that your FFXI server is using.</small>
							</div>
						</div>
						<p></p>
						<div class="container" style="border:5px solid;border-radius:20px;">
							<h2>XIWeb Database Configuration</h2>
							<h4>These properties are needed to connect to the database specific to the XIWeb application.  It is assumed that your XIWeb database is located on the same MYSQL server as your FFXI database.</h4>
							<div class="form-group">
								<label>XIWeb Database Username</label>
								<input type="text" class="form-control" name="XIWEBdatabaseUser" '.(!empty($XIWEBdatabaseUser) ? 'value='.$XIWEBdatabaseUser.'' : '').' placeholder="e.g. admin">
								<small id="databaseUserHelp" class="form-text text-muted">This is a database user that can connect to the XIWeb database.</small>
							</div>
							<div class="form-group">
								<label>XIWeb Database User Password</label>
								<input type="password" class="form-control" name="XIWEBdatabaseUserPassword" '.(!empty($XIWEBdatabaseUserPassword) ? 'value='.$XIWEBdatabaseUserPassword.'' : '').' placeholder="e.g. password">
								<small id="databaseUserPasswordHelp" class="form-text text-muted">This is the password for the indicated XIWeb database user.</small>
							</div>
							<div class="form-group">
								<label>Name of the XIWeb Database</label>
								<input type="text" class="form-control" name="XIWEBdatabaseName" '.(!empty($XIWEBdatabaseName) ? 'value='.$XIWEBdatabaseName.'' : '').' placeholder="e.g. xiweb" required>
								<small id="databaseNameHelp" class="form-text text-muted">This is the name of the XIWeb database.</small>
							</div>
						</div>
						<p></p>
						<div class="container" style="border:5px solid;border-radius:20px;">
							<h2>FFXI Server Configuration</h2>
							<h4>These properties will connect to your FFXI Server to show its status.</h4>
							<div class="form-group">
								<label for="">Name of the FFXI Server</label>
								<input type="text" class="form-control" name="serverName" '.(!empty($serverName) ? 'value='.$serverName.'' : '').' aria-describedby="serverNameHelp" placeholder="e.g. My FFXI Server" required>
								<small id="serverNameHelp" class="form-text text-muted">This is the display name of your server.  It can be anything you want other people to call your sever.</small>
							</div>
							<div class="form-group">
								<label for="">Address of the FFXI Server</label>
								<input type="text" class="form-control" name="serverAddress" '.(!empty($serverAddress) ? 'value='.$serverAddress.'' : '').' aria-describedby="serverAddressHelp" placeholder="e.g. localhost">
								<small id="serverAddressHelp" class="form-text text-muted">This is the address of the FFXI server to check it\'s status. (Probably on the same server as the database.)</small>
							</div>
						</div>
						<p></p>
						<div class="container" style="border:5px solid;border-radius:20px;">
							<h2>XIWeb Configuration</h2>
							<h4>These are miscellaneous properties for your installation of XIWeb.</h4>
							<div class="form-check">
								<input type="checkbox" class="form-check-input" name="newAccountRegistration" '.(!empty($newAccountRegistration) ? 'value='.$newAccountRegistration.'' : '').' aria-describedby="newAccountRegistrationHelp" checked>
								<label class="form-check-label" for="nameAccountRegistration"> Allow New Account Registration</label>
								<small id="newAccountRegistrationHelp" class="form-text text-muted">If this is checked, users will see a Register link and will be able to create game accounts on your FFXI Server.</small>
							</div>
							<div class="form-check">
								<input type="checkbox" class="form-check-input" name="useRecaptcha" '.(!empty($useRecaptcha) ? 'value='.$useRecaptcha.'' : '').' aria-describedby="useRecaptchaHelp" checked>
								<label class="form-check-label" for="useRecaptcha"> Use reCAPTCHA</label>
								<small id="useRecaptchaHelp" class="form-text text-muted">Use this to prevent spam and bots from registering and logging into your site.</small>
							</div>
							<div class="form-group" style="padding-top:10px">
								<label for="">reCAPTCHA Site Key</label>
								<input type="text" class="form-control" name="recaptchaSiteKey" '.(!empty($recaptchaSiteKey) ? 'value='.$recaptchaSiteKey.'' : '').' aria-describedby="recaptchaSiteKeyHelp">
								<small id="recaptchaSiteKeyHelp" class="form-text text-muted">This is the your reCAPTCHA Site Key.  Check out <a target="_blank" href="https://www.google.com/recaptcha">https://www.google.com/recaptcha</a> to sign up for a free account.</small>
							</div>
							<div class="form-group">
								<label for="">reCAPTCHA Secret Key</label>
								<input type="text" class="form-control" name="recaptchaSecretKey" '.(!empty($recaptchaSecretKey) ? 'value='.$recaptchaSecretKey.'' : '').' aria-describedby="recaptchaSecretKeyHelp">
								<small id="recaptchaSecretKeyHelp" class="form-text text-muted">This is the your reCAPTCHA Secret Key.  Check out <a target="_blank" href="https://www.google.com/recaptcha">https://www.google.com/recaptcha</a> to sign up for a free account.</small>
							</div>
						</div>
						<p></p>
						<input type="hidden" name="install" value=1" />
						<button type="submit" class="btn btn-primary">Complete Installation</button>
					</form>
				</div>

			    </main>

				<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
				<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>
			</body>
		</html>
	';

?>