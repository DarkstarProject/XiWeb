<?php

	$output .= '

		<div class="jumbotron jumbotron-fluid" style="background:linear-gradient(rgba(0,0,0,0.25), rgba(0,0,0,0.25)), url(\''.$bannerBackground.'\');background-repeat: no-repeat;background-size: cover;background-position: 50% 50%;">
	        <div class="container">
	        	<h1 class="display-3">'.$frontpage_title.'</h1>
	        	<p>'.$frontpage_message.'</p>
	        </div>
	    </div>
	';

	//If there were errors, let's show them.
	if(!empty($_SESSION['errors']['password_reset'])){
		
		foreach ($_SESSION['errors']['password_reset'] as $error) {
     		$output .= '
				<div class="container alert alert-danger">
					'.$error.'
				</div>
			';
    	}

	}

	//If there were messages, let's show them.
	if(!empty($_SESSION['messages']['password_reset'])){
		
		foreach ($_SESSION['messages']['password_reset'] as $message) {
     		$output .= '
				<div class="container alert alert-success">
					'.$message.'
				</div>
			';
    	}

	}

	$output .= '
		<div class="card bg-light mb-3 col-sm-6" style="margin:0 auto;float: none;margin-bottom:10px">
			<div class="card-header">Password Reset</div>
			<div class="card-body">
				<span>Please enter your account name or account e-mail address and click Reset to issue a password reset request.  You will then receive an e-mail associated with your account with a link to reset your password.  You will have 1 to 2 hours to complete the password reset.</span>
				<p></p>
				<form method="post" action="./passwordResetStart.php">
					<input type="hidden" name="resetPassword" value="1" />
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" class="form-control" name="username" placeholder="">
					</div>
					<button type="submit" class="btn btn-primary">Reset</button>
				</form>
			</div>	
		</div>
	';

?>