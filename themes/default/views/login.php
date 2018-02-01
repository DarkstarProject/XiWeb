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
	if(!empty($_SESSION['errors']['login'])){
		
		foreach ($_SESSION['errors']['login'] as $error) {
     		$output .= '
				<div class="container alert alert-danger">
					'.$error.'
				</div>
			';
    	}

	}

	$output .= '
		<p style="padding:10px;">
		<div class="card bg-light mb-3" style="max-width: 18rem;margin:0 auto;float: none;margin-bottom:10px">
			<div class="card-header">Login</div>
			<div class="card-body">
				<form method="post" action="./login.php">
					<input type="hidden" name="login" value="1" />
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" class="form-control" name="username" placeholder="">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" class="form-control" name="password" placeholder="">
					</div>
					<div class="row">
						<div class="col-6" style="text-align:center">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
						<div class="col-6">
							'.($allowAccountRegistration ? '<a class="nav-link" style="margin:auto;text-align:center;" href="register.php"><i>Register</i></a>' : '' ).'
						</div>
					</div>
					<a class="nav-link" style="margin:auto;text-align:center;" href="passwordResetStart.php"><i>Forgot Password</i></a>
				</form>
			</div>
		</div>
		<p style="padding:50px;">
	';

?>