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
	if(!empty($_SESSION['errors']['registration'])){
		foreach ($_SESSION['errors']['registration'] as $error) {
     		$output .= '
				<div class="container alert alert-danger">
					'.$error.'
				</div>
			';
    	}

	}

	//If there were errors, let's show them.
	if(!empty($_SESSION['messages']['registration'])){
		
		foreach ($_SESSION['messages']['registration'] as $error) {
     		$output .= '
				<div class="container alert alert-success">
					'.$error.'
				</div>
			';
    	}

	}

	$output .= '
			<div class="container">
			<div class="card">
				<div class="card-header">
    				Register a new account
  				</div>
  				<div class="card-body">
					<form method="post" action="./register.php">
						<div class="form-group">
							<label for="">Username</label>
							<input type="text" class="form-control" name="username" value="'.$username.'"" placeholder="" required>
						</div>
						<div class="form-group">
							<label for="">Password</label>
							<input type="password" class="form-control" name="password1" placeholder="" required>
						</div>
						<div class="form-group">
							<label for="">Confirm Password</label>
							<input type="password" class="form-control" name="password2" placeholder="" required>
						</div>
						<div class="form-group">
							<label for="">E-mail Address</label>
							<input type="email" class="form-control" name="email" value="'.$email.'" placeholder="" required>
						</div>
						<div class="form-group">
							<!--<div class="g-recaptcha" data-sitekey="6LcwLkIUAAAAAHqDgYX_XhCNGj1GIIr5u_ukLA5i"></div>-->
						</div>
						<input type="hidden" name="register" value="1" />
						<button type="submit" class="btn btn-primary">Register Account</button>
					</form>
				</div>
			</div>
		</div>

	';

?>