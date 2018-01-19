<?php

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
					<button type="submit" class="btn btn-primary">Login</button>
				</form>
			</div>
		</div>
	';

?>