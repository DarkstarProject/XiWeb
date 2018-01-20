<?php

	$output .= '
		<div class="jumbotron jumbotron-fluid">
	        <div class="container">
	          <h1 class="display-3">'.$frontpage_title.'</h1>
	          <p>'.$frontpage_message.'</p>
	        </div>
      	</div>
	';

	$output .= '

		<div class="container" style="border:1px solid #cecece;padding:10px;margin-bottom:100px;height:100%">
			<div class="row">
				<div class="col-4">
					<div class="list-group">
						<li class="list-group-item list-group-item-secondary">Your Characters</li>';
						
						$index = 0;
						foreach ($myCharacters as $character){
							if((empty($_GET['index']) && $index == 0) || (!empty($_GET['index']) && $index == $_GET['index'])){
								$output .= '<button type="button" class="list-group-item list-group-item-action active" onclick="location.href=\'myCharacters.php?index='.$index.'\'">'.$character['charname'].'</button>';
								$bFirst = false;
							} else {
								$output .= '<button type="button" class="list-group-item list-group-item-action" onclick="location.href=\'myCharacters.php?index='.$index.'\'">'.$character['charname'].'</button>';	
							}
							$index++;
						}
						
			$output .= '
					</div>
				</div>
				<div class="col-8">
					<ul class="nav nav-pills">
				  		<li class="nav-item">
				    		<a id="buttonGeneral" class="nav-link active" href="#">General</a>
					  	</li>
					  	<li class="nav-item">
					    	<a id="buttonSkills" class="nav-link" href="#">Skills</a>
					  	</li>
					  	<li class="nav-item">
					    	<a id="buttonSpells" class="nav-link" href="#">Spells</a>
					  	</li>
					  	<li class="nav-item">
					    	<a id="buttonInventory" class="nav-link" href="#">Inventory</a>
					  	</li>
					</ul>
					<div id="viewGeneral" class="container">
						<div class="row" style="margin-top:10px">
							<div class="col-6">
								<img style="width:75%" src="themes/default/images/portraits/'.$races[$selectedCharacter['race']].getCharacterGender($selectedCharacter['race']).$faces[$selectedCharacter['face']].'.jpg"/>
							</div>
							<div class="col-6">
								<div class="row" style="margin-top:10px;height:20%;"></div>
								<div class="row" style="margin-top:10px;height:20%;">
									<h1 style="text-align:center;width:100%;">'.$selectedCharacter['charname'].'</h1>
								</div>
								<div class="row" style="margin-top:10px;height:20%;"></div>
								<div class="row" style="margin-top:10px; height:20%">
									<h2 style="text-align:center;width:100%;">'.showCharacterJobs($selectedCharacter).'</h2>
								</div>
								<div class="row" style="margin-top:10px;height:20%;"></div>
							</div>
						</div>
						<div class="row" style="margin-top:20px">
							<div class="col-12">
								Current Location: '.str_replace("_", " " , $selectedCharacter['CurrentZone']).'
							</div>
						</div>
						<div class="row" style="margin-top:20px">
							<div class="col-6">
								HP:
								<div class="progress">
  									<div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><b>'.$selectedCharacter['hp'].'</b></div>
								</div>
							</div>
							<div class="col-6">
								MP:
								<div class="progress">
  									<div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><b>'.$selectedCharacter['mp'].'</b></div>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:20px">
							<div class="col-12">
							Current Main Job Experience:
								<div class="progress">
  									<div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><b>'.$selectedCharacter[$jobAbbreviations[$selectedCharacter['mjob']]].'</b></div>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:20px">
							<div class="col-6">
								Nationality: '.$nations[$selectedCharacter['nation']].'
							</div>
							<div class="col-6">
								Playtime: '.formatPlayTime($selectedCharacter['playtime']).'
							</div>
						</div>
					</div>
					<div id="viewSkills" class="container" style="display:none;">
						<div class="row" style="margin-top:20px">
							<div class="col-12">
								Skills:
								<table class="table">
									<thead>
										<tr>
									    	<th scope="col">Skill Name</th>
									    	<th scope="col">Value</th>
									    </tr>
									</thead>
									<tbody>';

									foreach($selectedCharacterSkills as $skill){
										$output .= '<tr>';
										$output .= '<td>'.ucwords($skill['skillname']).'</td>';
										$output .= '<td>'.$skill['value'].'</td>';
										$output .= '</tr>';
									}

									$output .= '
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="themes/default/js/myCharacters.js"></script>
	';

?>