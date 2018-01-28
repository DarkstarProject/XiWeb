<?php

	$output .= '
		<div class="jumbotron jumbotron-fluid" style="background:linear-gradient(rgba(0,0,0,0.25), rgba(0,0,0,0.25)), url(\''.$bannerBackground.'\');background-repeat: no-repeat;background-size: cover;background-position: 50% 50%;">
	        <div class="container">
	          <h1 class="display-3">'.$frontpage_title.'</h1>
	          <p>'.$frontpage_message.'</p>
	        </div>
	      </div>
	';

	$output .= '
		<div class="container">
			<div class="page-header">
  				<h1>'.$newsTitle.'</h1>
  				'.$newsDetails.'
			</div>
		</div>
	';
?>