<?php

	$output .= '

		<div class="jumbotron jumbotron-fluid">
			        <div class="container">
			          <h1 class="display-3">'.$frontpage_title.'</h1>
			          <p>'.$frontpage_message.'</p>
			        </div>
			      </div>

	';

	//If there were errors, let's show them.
	if(!empty($_SESSION['errors']['account'])){
		
		foreach ($_SESSION['errors']['account'] as $error) {
     		$output .= '
				<div class="container alert alert-danger">
					'.$error.'
				</div>
			';
    	}

	}

	//If there were messages, let's show them.
	if(!empty($_SESSION['messages']['account'])){
		
		foreach ($_SESSION['messages']['account'] as $message) {
     		$output .= '
				<div class="container alert alert-success">
					'.$message.'
				</div>
			';
    	}

	}

	$output .= '

		<div class="container">
			<div class="card">
				<div class="card-header">
    				Your Account Info
  				</div>
  				<div class="card-body">
  					<form method="post" action="./myAccount.php">
  						<div class="form-group">
						    <label for="accountName">Account Name</label>
						    <input type="text" class="form-control" name="username" aria-describedby="accountNameHelp" value="'.$arrReturn[0]["login"].'" readonly>
						    <small id="accountNameHelp" class="form-text text-muted">You can not change your account name.</small>
						 </div>
						 <div class="form-group">
						    <label for="memberSince">Member Since</label>
						    <input type="text" class="form-control" name="memberSince" aria-describedby="memberSinceHelp" value="'.$arrReturn[0]["timecreate"].'" readonly>
						    <small id="memberSinceHelp" class="form-text text-muted">This is when you created your account.</small>
						 </div>
						 <div class="form-group">
						    <label for="email">E-mail Address</label>
						    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" value="'.$arrReturn[0]["email"].'">
						    <small id="emailHelp" class="form-text text-muted">This is the e-mail address associated with this account.</small>
						 </div>
						 <div class="form-group">
						    <label for="email">Current Password</label>
						    <input type="password" class="form-control" name="password" aria-describedby="passwordHelp" required>
						    <small id="passwordHelp" class="form-text text-muted">To make changes to your account, please enter your current password.</small>
						 </div>
						 <input type="hidden" name="update" value="1" />
						 <button type="submit" class="btn btn-primary">Update</button>
  					</form>
  				</div>
			</div>
		</div>

	';

?>