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

				<div class="container" style="padding-top:20px">
					<form method="post" action="index.php">
						<div class="form-group">
							<label for="">Database Server Address</label>
							<input type="text" class="form-control" name="databaseHost" '.(!empty($databaseHost) ? 'value='.$databaseHost.'' : '').' aria-describedby="databaseServerAddressHelp" placeholder="e.g. localhost" required>
							<small id="databaseServerAddressHelp" class="form-text text-muted">This is the address of the server on which the database is running.</small>
						</div>
						<div class="form-group">
							<label for="">Database Server Port</label>
							<input type="number" class="form-control" name="databasePort" '.(!empty($databasePort) ? 'value='.$databasePort.'' : '').' aria-describedby="databaseServerPortHelp" placeholder="e.g. 3306" required>
							<small id="databaseServerPortHelp" class="form-text text-muted">This is the port of the server on which the database is running.</small>
						</div>
						<div class="form-group">
							<label for="">Database Username</label>
							<input type="text" class="form-control" name="databaseUser" '.(!empty($databaseUser) ? 'value='.$databaseUser.'' : '').' aria-describedby="databaseUserHelp" placeholder="e.g. admin">
							<small id="databaseUserHelp" class="form-text text-muted">This is a database user that can connect to the database.</small>
						</div>
						<div class="form-group">
							<label for="">Database User Password</label>
							<input type="password" class="form-control" name="databaseUserPassword" '.(!empty($databaseUserPassword) ? 'value='.$databaseUserPassword.'' : '').' aria-describedby="databaseUserPasswordHelp" placeholder="e.g. password">
							<small id="databaseUserPasswordHelp" class="form-text text-muted">This is the password for the indicated database user.</small>
						</div>
						<div class="form-group">
							<label for="">Name of the Database</label>
							<input type="text" class="form-control" name="databaseName" '.(!empty($databaseName) ? 'value='.$databaseName.'' : '').' aria-describedby="databaseNameHelp" placeholder="e.g. oldschool" required>
							<small id="databaseNameHelp" class="form-text text-muted">This is the name of the database that your FFXI server is using.</small>
						</div>
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