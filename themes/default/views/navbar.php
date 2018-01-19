<?php

	$output .= '
		<body>
				
				<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			        <span class="navbar-toggler-icon"></span>
			      </button>

			      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
			        <ul class="navbar-nav mr-auto">
			          <li class="nav-item active">
			            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
			          </li>
			          <form class="form-inline my-2 my-lg-0">
				          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
				          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				        </form>
			        </ul>
			        <ul class="navbar-nav ml-auto">
			        ';

	if($_SESSION['logged'] == TRUE){
		$output .= '<span class="navbar-text">'.$_SESSION['auth']['username'].'</span>';
		$output .= '
				        <a class="nav-link text-danger" href="logout.php">Logout<span class="sr-only">(current)</span></a>
				        </ul>
				      </div>
				    </nav>
		';
	} else {

		$output .= '
				        <a class="nav-link" href="login.php">Login<span class="sr-only">(current)</span></a>
				        </ul>
				      </div>
				    </nav>
		';

	}

	

?>