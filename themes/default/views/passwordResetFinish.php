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

	if($showPasswordReset){
		$output .= '
			<div class="card bg-light mb-3 col-sm-6" style="margin:0 auto;float: none;margin-bottom:10px">
				<div class="card-header">Password Reset</div>
				<div class="card-body">
					<span>Please enter your new password.</span>
					<p></p>
					<form method="post" action="./passwordResetFinish.php?account='.$accountID.'&token='.$token.'">
						<input type="hidden" name="resetPassword" value="1" />
						<input type="hidden" name="account" value="'.$accountID.'" />
						<input type="hidden" name="token" value="'.$token.'" />
						<div class="form-group">
							<label for="">New Password</label>
							<input type="password" class="form-control" name="newPassword" placeholder="">
						</div>
						<div class="form-group">
							<label for="">Confirm New Password</label>
							<input type="password" class="form-control" name="newPasswordConfirm" placeholder="">
						</div>
						<button type="submit" class="btn btn-primary">Reset</button>
					</form>
				</div>	
			</div>
		';
	}

?>