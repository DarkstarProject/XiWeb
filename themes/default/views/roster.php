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
		<div class="container">
			<h2>There are '.onlineCount().' characters online.</h2>
			<p></p>
			<table id="onlineCharacters" class="display" cellspacing="0" width="100%">
				<thead>
					<th>Character Name</th>
					<th>Area</th>
					<th>Main Job</th>
					<th>Sub Job</th>
					<!--<th>Bazaar Message</th>-->
				</thead>
				<tfoot>
					<th>Character Name</th>
					<th>Area</th>
					<th>Main Job</th>
					<th>Sub Job</th>
					<!--<th>Bazaar Message</th>-->
				</tfoot>
			</table>
		</div>
		<script type="text/javascript" src="themes/default/js/roster.js"></script>
	';

?>