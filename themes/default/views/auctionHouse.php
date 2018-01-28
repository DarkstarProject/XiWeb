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
			<h2 id="auctionH2">There are 0 items in the Auction House.</h2>
			<p></p>
			<table id="auctionHouse" class="display" cellspacing="0" width="100%">
				<thead>
					<th>Icon</th>
					<th>Item Name</th>
					<th>Type</th>
					<th>Stack</th>
					<th>Price</th>
					<th></th>
					<th></th>
				</thead>
				<tfoot>
					<th>Icon</th>
					<th>Item Name</th>
					<th>Type</th>
					<th>Stack</th>
					<th>Price</th>
					<th></th>
					<th></th>
				</tfoot>
			</table>
		</div>
		<p style="padding:50px;">
		<script type="text/javascript" src="themes/default/js/auctionHouse.js"></script>
	';

?>