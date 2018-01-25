<?php

	$output .= '
		<body>
				
				<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			        <span class="navbar-toggler-icon"></span>
			      </button>

			      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
			        <ul class="navbar-nav mr-auto">
			          <li class="nav-item">
			            <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
			          </li>
			          <li class="nav-item">
			            <a class="nav-link" href="roster.php">Roster<span class="sr-only"></span></a>
			          </li>
			          <li class="nav-item">
			            <a class="nav-link" href="auctionHouse.php">Auction House<span class="sr-only"></span></a>
			          </li>
			          <!--<form class="form-inline my-2 my-lg-0">
				          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
				          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				        </form>-->
			        </ul>
			        <ul class="navbar-nav ml-auto">
			        ';

	if(!empty($_SESSION['logged']) && $_SESSION['logged'] == TRUE){
		$output .= '
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i>  '.$_SESSION['auth']['username'].'</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="myAccount.php">My Account</a>
				<a class="dropdown-item" href="myCharacters.php">My Characters</a>
				</div>
			</li>
		';
		$output .= '
				        <a class="nav-link text-danger" href="logout.php">Logout<span class="sr-only">(current)</span></a>
				        </ul>
				      </div>
				    </nav>
		';
	} else {

		$output .= '
				        <a class="nav-link" href="login.php">Login<span class="sr-only">(current)</span></a>
				        '.($allowAccountRegistration ? '<a class="nav-link" href="register.php"><i>Register</i></a>' : '' ).'
				        </ul>
				      </div>
				    </nav>
		';

	}

	

?>
