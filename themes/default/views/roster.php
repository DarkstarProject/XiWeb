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

		<div class="jumbotron jumbotron-fluid" style="background:linear-gradient(rgba(0,0,0,0.25), rgba(0,0,0,0.25)), url(\''.$bannerBackground.'\');background-repeat: no-repeat;background-size: cover;background-position: 50% 50%;">
        <div class="container">
          <h1 class="display-3">'.$frontpage_title.'</h1>
          <p>'.$frontpage_message.'</p>
        </div>
      </div>

		<div class="container">
			<h2 id="onlineH2">There are 0 characters online.</h2>
			<p></p>
			<table id="onlineCharacters" class="display" cellspacing="0" width="100%">
				<thead>
					<th>Character Name</th>
					<th>Area</th>
					<th>Job</th>
					<th>Bazaar Message</th>
				</thead>
				<tfoot>
					<th>Character Name</th>
					<th>Area</th>
					<th>Job</th>
					<th>Bazaar Message</th>
				</tfoot>
			</table>
		</div>
		<p style="padding:50px;">
		<script type="text/javascript" src="themes/default/js/roster.js"></script>
	';

?>