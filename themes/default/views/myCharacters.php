<?php

	$output .= '
		<div class="jumbotron jumbotron-fluid" style="background:linear-gradient(rgba(0,0,0,0.25), rgba(0,0,0,0.25)), url(\''.$bannerBackground.'\');background-repeat: no-repeat;background-size: cover;background-position: 50% 50%;">
	        <div class="container">
	          <h1 class="display-3">'.$frontpage_title.'</h1>
	          <p>'.$frontpage_message.'</p>
	        </div>
      	</div>
	';

	if(empty($selectedCharacter)){

		$output .= '

			<div class="container" style="border:1px solid #cecece;text-align:center;">
				<h3>Your account has no characters associated with it.</h3>
				<h4>Log into the game to create a character.</h4>
			</div>

		';

	} else {

		$output .= '

			<div class="container-fluid" style="border:1px solid #cecece;padding:10px;margin-bottom:100px;margin-left:10px;width:99%">
				<div class="row" style="height:100%;">
					<div class="col-sm-2">
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

					<div class="col-sm-10" style="height:100%">
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
						  	<li class="nav-item">
						    	<a id="buttonJobs" class="nav-link" href="#">Jobs</a>
						  	</li>
						  	<li class="nav-item">
						    	<a id="buttonCurrencies" class="nav-link" href="#">Currencies</a>
						  	</li>
						</ul>
						<div id="viewGeneral" class="container-fluid">
							<div class="row align-items-center" style="margin-top:10px">
								<div class="col-6">
									<img style="width:50%;border: #000000 8px solid;" src="themes/default/images/portraits/'.$races[$selectedCharacter['race']].getCharacterGender($selectedCharacter['race']).$faces[$selectedCharacter['face']].'.jpg"/>
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
						<div id="viewSkills" class="container-fluid" style="height:90%;overflow:scroll;display:none;">
							<div class="row" style="margin-top:20px">
								<div class="col-12">
									<table class="table">
										<thead>
											<tr>
										    	<th scope="col">Skill Name</th>
										    	<th scope="col">Value</th>
										    	<th scope="col">Link</th>
										    </tr>
										</thead>
										<tbody>';

										foreach($selectedCharacterSkills as $skill){
											$output .= '<tr>';
											$output .= '<td>'.ucwords($skill['skillname']).'</td>';
											$output .= '<td>'.floor($skill['value']/10).'</td>';
											$output .= '<td><a target="_blank" href="http://ffxiclopedia.wikia.com/wiki/'.ucwords($skill['skillname']).'"">FFXIClopedia</a></td>';
											$output .= '</tr>';
										}

										$output .= '
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="viewSpells" class="container-fluid" style="height:90%;overflow:scroll;display:none;">
							<div class="row" style="margin-top:20px">
								<div class="col-12">
									<table class="table">
										<thead>
											<tr>
										    	<th scope="col">Spell Name</th>
										    	<th scope="col">Link</th>
										    </tr>
										</thead>
										<tbody>';

										foreach($selectedCharacterSpells as $spell){
											$output .= '<tr>';
											$output .= '<td>'.ucwords(ucromans(str_replace("_", " ", $spell['name']))).'</td>';
											$output .= '<td><a target="_blank" href="http://ffxiclopedia.wikia.com/wiki/'.ucwords(ucromans(str_replace("_", " ", $spell['name']))).'"">FFXIClopedia</a></td>';
											$output .= '</tr>';
										}
										$output .= '
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="viewInventory" class="container-fluid" style="height:90%;overflow:scroll;display:none;">
							<div class="row" style="margin-top:20px;">
								<div class="col-sm-3" style="padding:10px;">
									<table style="margin-left:auto;margin-right:auto">
										<tr>
											<td>
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_MAIN").'
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_SUB").'
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_RANGED").'
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_AMMO").'
											</td>
										</tr>
										<tr>
											<td>
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_HEAD").'
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_NECK").'
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_EAR1").'
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_EAR2").'
											</td>
										</tr>
										<tr>
											<td>
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_BODY").'
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_HANDS").'
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_RING1").'
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_RING2").'
											</td>
										</tr>
										<tr>
											<td>
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_BACK").'
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_WAIST").'
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_LEGS").'
												'.getEquipmentSlotIMG($selectedCharacterEquipment, "SLOT_FEET").'
											</td>
										</tr>
									</table>
									<p class="small" style="width:100%;text-align:center;margin-bottom:0px;"><i>Hover to see name.</i></p>
									<p class="small" style="width:100%;text-align:center;"><i>Click to see in inventory.</i></p>
									<p style="width:100%;text-align:center;">Gil: '.number_format(getCharacterGil($selectedCharacter['charid'])).' <img src="themes/default/images/gil.jpg" style="width:16px"/></p>
								</div>
								<div class="col-sm-9" style="padding:10px;">
									<table id="characterEquipment" class="display" cellspacing="0" width="100%">
										<thead>
											<th>Icon</th>
											<th>Name</th>
											<!--<th>Type</th>-->
											<th>Quantity</th>
											<th>Location</th>
											<th></th>
											<th></th>
										</thead>
										<tfoot>
											<th>Icon</th>
											<th>Name</th>
											<!--<th>Type</th>-->
											<th>Quantity</th>
											<th>Location</th>
											<th></th>
											<th></th>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<div id="viewJobs" class="container-fluid" style="height:90%;overflow:scroll;display:none;">
							<div class="row" style="margin-top:20px;">
								<div class="col-12">
									<table class="table">
										<thead>
											<tr>
										    	<th scope="col">Job</th>
										    	<th scope="col">Level</th>
										    	<th scope="col">Experience</th>
										    </tr>
										</thead>
										<tbody>
											<tr><td>Warrior (WAR)</td><td>'.$selectedCharacter['warlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['war'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['warlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['warlvl']) != 0 ? (($selectedCharacter['war'] / getJobExpToLevel($selectedCharacter['warlvl'])) * 100) : 0).'%;">'.$selectedCharacter['war'].'</div></div></td></tr>
											<tr><td>Monk (MNK)</td><td>'.$selectedCharacter['mnklvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['mnk'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['mnklvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['mnklvl']) != 0 ? (($selectedCharacter['mnk'] / getJobExpToLevel($selectedCharacter['mnklvl'])) * 100) : 0).'%;">'.$selectedCharacter['mnk'].'</div></div></td></tr>
											<tr><td>White Mage (WHM)</td><td>'.$selectedCharacter['whmlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['whm'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['whmlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['whmlvl']) != 0 ? (($selectedCharacter['whm'] / getJobExpToLevel($selectedCharacter['whmlvl'])) * 100) : 0).'%;">'.$selectedCharacter['whm'].'</div></div></td></tr>
											<tr><td>Black Mage (BLM)</td><td>'.$selectedCharacter['blmlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['blm'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['blmlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['blmlvl']) != 0 ? (($selectedCharacter['blm'] / getJobExpToLevel($selectedCharacter['blmlvl'])) * 100) : 0).'%;">'.$selectedCharacter['blm'].'</div></div></td></tr>
											<tr><td>Red Mage (RDM)</td><td>'.$selectedCharacter['rdmlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['rdm'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['rdmlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['rdmlvl']) != 0 ? (($selectedCharacter['rdm'] / getJobExpToLevel($selectedCharacter['rdmlvl'])) * 100) : 0).'%;">'.$selectedCharacter['rdm'].'</div></div></td></tr>
											<tr><td>Thief (THF)</td><td>'.$selectedCharacter['thflvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['thf'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['thflvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['thflvl']) != 0 ? (($selectedCharacter['thf'] / getJobExpToLevel($selectedCharacter['thflvl'])) * 100) : 0).'%;">'.$selectedCharacter['thf'].'</div></div></td></tr>
											<tr><td>Paladin (PLD)</td><td>'.$selectedCharacter['pldlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['pld'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['pldlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['pldlvl']) != 0 ? (($selectedCharacter['pld'] / getJobExpToLevel($selectedCharacter['pldlvl'])) * 100) : 0).'%;">'.$selectedCharacter['pld'].'</div></div></td></tr>
											<tr><td>Dark Knight (DRK)</td><td>'.$selectedCharacter['drklvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['drk'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['drklvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['drklvl']) != 0 ? (($selectedCharacter['drk'] / getJobExpToLevel($selectedCharacter['drklvl'])) * 100) : 0).'%;">'.$selectedCharacter['drk'].'</div></div></td></tr>
											<tr><td>Beastmaster (BST)</td><td>'.$selectedCharacter['bstlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['bst'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['bstlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['bstlvl']) != 0 ? (($selectedCharacter['bst'] / getJobExpToLevel($selectedCharacter['bstlvl'])) * 100) : 0).'%;">'.$selectedCharacter['bst'].'</div></div></td></tr>
											<tr><td>Bard (BRD)</td><td>'.$selectedCharacter['brdlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['brd'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['brdlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['brdlvl']) != 0 ? (($selectedCharacter['brd'] / getJobExpToLevel($selectedCharacter['brdlvl'])) * 100) : 0).'%;">'.$selectedCharacter['brd'].'</div></div></td></tr>
											<tr><td>Ranger (RNG)</td><td>'.$selectedCharacter['rnglvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['rng'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['rnglvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['rnglvl']) != 0 ? (($selectedCharacter['rng'] / getJobExpToLevel($selectedCharacter['rnglvl'])) * 100) : 0).'%;">'.$selectedCharacter['rng'].'</div></div></td></tr>
											<tr><td>Samurai (SAM)</td><td>'.$selectedCharacter['samlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['sam'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['samlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['samlvl']) != 0 ? (($selectedCharacter['sam'] / getJobExpToLevel($selectedCharacter['samlvl'])) * 100) : 0).'%;">'.$selectedCharacter['sam'].'</div></div></td></tr>
											<tr><td>Ninja (NIN)</td><td>'.$selectedCharacter['ninlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['nin'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['ninlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['ninlvl']) != 0 ? (($selectedCharacter['nin'] / getJobExpToLevel($selectedCharacter['ninlvl'])) * 100) : 0).'%;">'.$selectedCharacter['nin'].'</div></div></td></tr>
											<tr><td>Dragoon (DRG)</td><td>'.$selectedCharacter['drglvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['drg'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['drglvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['drglvl']) != 0 ? (($selectedCharacter['drg'] / getJobExpToLevel($selectedCharacter['drglvl'])) * 100) : 0).'%;">'.$selectedCharacter['drg'].'</div></div></td></tr>
											<tr><td>Summoner (SMN)</td><td>'.$selectedCharacter['smnlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['smn'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['smnlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['smnlvl']) != 0 ? (($selectedCharacter['smn'] / getJobExpToLevel($selectedCharacter['smnlvl'])) * 100) : 0).'%;">'.$selectedCharacter['smn'].'</div></div></td></tr>
											<tr><td>Blue Mage (BLU)</td><td>'.$selectedCharacter['blulvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['blu'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['blulvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['blulvl']) != 0 ? (($selectedCharacter['blu'] / getJobExpToLevel($selectedCharacter['blulvl'])) * 100) : 0).'%;">'.$selectedCharacter['blu'].'</div></div></td></tr>
											<tr><td>Corsair (COR)</td><td>'.$selectedCharacter['corlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['cor'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['corlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['corlvl']) != 0 ? (($selectedCharacter['cor'] / getJobExpToLevel($selectedCharacter['corlvl'])) * 100) : 0).'%;">'.$selectedCharacter['cor'].'</div></div></td></tr>
											<tr><td>Puppetmaster (PUP)</td><td>'.$selectedCharacter['puplvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['pup'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['puplvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['puplvl']) != 0 ? (($selectedCharacter['pup'] / getJobExpToLevel($selectedCharacter['puplvl'])) * 100) : 0).'%;">'.$selectedCharacter['pup'].'</div></div></td></tr>
											<tr><td>Dancer (DNC)</td><td>'.$selectedCharacter['dnclvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['dnc'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['dnclvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['dnclvl']) != 0 ? (($selectedCharacter['dnc'] / getJobExpToLevel($selectedCharacter['dnclvl'])) * 100) : 0).'%;">'.$selectedCharacter['dnc'].'</div></div></td></tr>
											<tr><td>Scholar (SCH)</td><td>'.$selectedCharacter['schlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['sch'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['schlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['schlvl']) != 0 ? (($selectedCharacter['sch'] / getJobExpToLevel($selectedCharacter['schlvl'])) * 100) : 0).'%;">'.$selectedCharacter['sch'].'</div></div></td></tr>
											<tr><td>Geomancer (GEO)</td><td>'.$selectedCharacter['geolvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['geo'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['geolvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['geolvl']) != 0 ? (($selectedCharacter['geo'] / getJobExpToLevel($selectedCharacter['geolvl'])) * 100) : 0).'%;">'.$selectedCharacter['geo'].'</div></div></td></tr>
											<tr><td>Rune Fencer (RUN)</td><td>'.$selectedCharacter['runlvl'].'</td><td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="'.$selectedCharacter['run'].'" aria-valuemin="0" aria-valuemax="'.getJobExpToLevel($selectedCharacter['runlvl']).'" style="width:'.(getJobExpToLevel($selectedCharacter['runlvl']) != 0 ? (($selectedCharacter['run'] / getJobExpToLevel($selectedCharacter['runlvl'])) * 100) : 0).'%;">'.$selectedCharacter['run'].'</div></div></td></tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="viewCurrencies" class="container-fluid" style="height:90%;overflow:scroll;display:none;">
							<div class="row" style="margin-top:20px;">
								<div class="col-12">
									<table class="table">
										<thead>
											<tr>
										    	<th scope="col">Name</th>
										    	<th scope="col">Amount</th>
										    </tr>
										</thead>
										<tbody>
											<tr><td>Conquest Points (San d\'Oria)</td><td>'.$selectedCharacterCurrencies['sandoria_cp'].'</td></tr>
											<tr><td>Conquest Points (Bastok)</td><td>'.$selectedCharacterCurrencies['bastok_cp'].'</td></tr>
											<tr><td>Conquest Points (Windurst)</td><td>'.$selectedCharacterCurrencies['windurst_cp'].'</td></tr>
											<tr><td>Beastmen\'s Seals Stored</td><td>'.$selectedCharacterCurrencies['beastman_seal'].'</td></tr>
											<tr><td>Kindred\'s Seals Stored</td><td>'.$selectedCharacterCurrencies['kindred_seal'].'</td></tr>
											<tr><td>Kindred\'s Crests Stored</td><td>'.$selectedCharacterCurrencies['kindred_crest'].'</td></tr>
											<tr><td>High Kindred\'s Crests Stored</td><td>'.$selectedCharacterCurrencies['high_kindred_crest'].'</td></tr>
											<tr><td>Sacred Kindred\'s Crests Stored</td><td>'.$selectedCharacterCurrencies['sacred_kindred_crest'].'</td></tr>
											<tr><td>Ancient Beastcoins Stored</td><td>'.$selectedCharacterCurrencies['ancient_beastcoin'].'</td></tr>
											<tr><td>Valor Points</td><td>'.$selectedCharacterCurrencies['valor_point'].'</td></tr>
											<tr><td>Scylds</td><td>'.$selectedCharacterCurrencies['scyld'].'</td></tr>
											<tr><td>Guild Points (Fishing)</td><td>'.$selectedCharacterCurrencies['guild_fishing'].'</td></tr>
											<tr><td>Guild Points (Woodworking)</td><td>'.$selectedCharacterCurrencies['guild_woodworking'].'</td></tr>
											<tr><td>Guild Points (Smithing)</td><td>'.$selectedCharacterCurrencies['guild_smithing'].'</td></tr>
											<tr><td>Guild Points (Goldsmithing)</td><td>'.$selectedCharacterCurrencies['guild_goldsmithing'].'</td></tr>
											<tr><td>Guild Points (Weaving)</td><td>'.$selectedCharacterCurrencies['guild_weaving'].'</td></tr>
											<tr><td>Guild Points (Leathercraft)</td><td>'.$selectedCharacterCurrencies['guild_leathercraft'].'</td></tr>
											<tr><td>Guild Points (Bonecraft)</td><td>'.$selectedCharacterCurrencies['guild_bonecraft'].'</td></tr>
											<tr><td>Guild Points (Alchemy)</td><td>'.$selectedCharacterCurrencies['guild_alchemy'].'</td></tr>
											<tr><td>Guild Points (Cooking)</td><td>'.$selectedCharacterCurrencies['guild_cooking'].'</td></tr>
											<tr><td>Cinders</td><td>'.$selectedCharacterCurrencies['cinder'].'</td></tr>
											<tr><td>Synergy Fewell (Fire)</td><td>'.$selectedCharacterCurrencies['fire_fewell'].'</td></tr>
											<tr><td>Synergy Fewell (Ice)</td><td>'.$selectedCharacterCurrencies['ice_fewell'].'</td></tr>
											<tr><td>Synergy Fewell (Wind)</td><td>'.$selectedCharacterCurrencies['wind_fewell'].'</td></tr>
											<tr><td>Synergy Fewell (Earth)</td><td>'.$selectedCharacterCurrencies['earth_fewell'].'</td></tr>
											<tr><td>Synergy Fewell (Lightning)</td><td>'.$selectedCharacterCurrencies['lightning_fewell'].'</td></tr>
											<tr><td>Synergy Fewell (Water)</td><td>'.$selectedCharacterCurrencies['water_fewell'].'</td></tr>
											<tr><td>Synergy Fewell (Light)</td><td>'.$selectedCharacterCurrencies['light_fewell'].'</td></tr>
											<tr><td>Synergy Fewell (Dark)</td><td>'.$selectedCharacterCurrencies['dark_fewell'].'</td></tr>
											<tr><td>Ballista Points</td><td>'.$selectedCharacterCurrencies['ballista_point'].'</td></tr>
											<tr><td>Fellow Points</td><td>'.$selectedCharacterCurrencies['fellow_point'].'</td></tr>
											<tr><td>Chocobucks (San d\'Oria Team)</td><td>'.$selectedCharacterCurrencies['chocobuck_sandoria'].'</td></tr>
											<tr><td>Chocobucks (Bastok Team)</td><td>'.$selectedCharacterCurrencies['chocobuck_bastok'].'</td></tr>
											<tr><td>Chocobucks (Windurst Team)</td><td>'.$selectedCharacterCurrencies['chocobuck_windurst'].'</td></tr>
											<tr><td>Research Marks</td><td>'.$selectedCharacterCurrencies['research_mark'].'</td></tr>
											<tr><td>Wizened Tunnel Worms</td><td>'.$selectedCharacterCurrencies['tunnel_worm'].'</td></tr>
											<tr><td>Wizened Morion Worms</td><td>'.$selectedCharacterCurrencies['morion_worm'].'</td></tr>
											<tr><td>Wizened Phantom Worms</td><td>'.$selectedCharacterCurrencies['phantom_worm'].'</td></tr>
											<tr><td>Moblin Marbles</td><td>'.$selectedCharacterCurrencies['moblin_marble'].'</td></tr>
											<tr><td>Infamy</td><td>'.$selectedCharacterCurrencies['infamy'].'</td></tr>
											<tr><td>Prestige</td><td>'.$selectedCharacterCurrencies['prestige'].'</td></tr>
											<tr><td>Legion Points</td><td>'.$selectedCharacterCurrencies['legion_point'].'</td></tr>
											<tr><td>Sparks of Eminence</td><td>'.$selectedCharacterCurrencies['spark_of_eminence'].'</td></tr>
											<tr><td>Shining Stars</td><td>'.$selectedCharacterCurrencies['shining_star'].'</td></tr>
											<tr><td>Imperial Standing</td><td>'.$selectedCharacterCurrencies['imperial_standing'].'</td></tr>
											<tr><td>Assault Points (L. Sanctum)</td><td>'.$selectedCharacterCurrencies['leujaoam_assault_point'].'</td></tr>
											<tr><td>Assault Points (M.J.T.G.)</td><td>'.$selectedCharacterCurrencies['mamool_assault_point'].'</td></tr>
											<tr><td>Assault Points (L. Cavern)</td><td>'.$selectedCharacterCurrencies['lebros_assault_point'].'</td></tr>
											<tr><td>Assault Points (Periqia)</td><td>'.$selectedCharacterCurrencies['periqia_assault_point'].'</td></tr>
											<tr><td>Assault Points (Ilrusi Atoll)</td><td>'.$selectedCharacterCurrencies['ilrusi_assault_point'].'</td></tr>
											<tr><td>Zeni</td><td>'.$selectedCharacterCurrencies['zeni_point'].'</td></tr>
											<tr><td>Jettons</td><td>'.$selectedCharacterCurrencies['jetton'].'</td></tr>
											<tr><td>Therion Ichor</td><td>'.$selectedCharacterCurrencies['therion_ichor'].'</td></tr>
											<tr><td>Allied Notes</td><td>'.$selectedCharacterCurrencies['allied_notes'].'</td></tr>
											<tr><td>Cruor</td><td>'.$selectedCharacterCurrencies['cruor'].'</td></tr>
											<tr><td>Resistance Credits</td><td>'.$selectedCharacterCurrencies['resistance_credit'].'</td></tr>
											<tr><td>Dominion Notes</td><td>'.$selectedCharacterCurrencies['dominion_note'].'</td></tr>
											<tr><td>5th Echelon Battle Trophies</td><td>'.$selectedCharacterCurrencies['fifth_echelon_trophy'].'</td></tr>
											<tr><td>4th Echelon Battle Trophies</td><td>'.$selectedCharacterCurrencies['fourth_echelon_trophy'].'</td></tr>
											<tr><td>3rd Echelon Battle Trophies</td><td>'.$selectedCharacterCurrencies['third_echelon_trophy'].'</td></tr>
											<tr><td>2nd Echelon Battle Trophies</td><td>'.$selectedCharacterCurrencies['second_echelon_trophy'].'</td></tr>
											<tr><td>1st Echelon Battle Trophies</td><td>'.$selectedCharacterCurrencies['first_echelon_trophy'].'</td></tr>
											<tr><td>Traverser Stones</td><td>'.$selectedCharacterCurrencies['traverser_stones'].'</td></tr>
											<tr><td>Voidstones</td><td>'.$selectedCharacterCurrencies['voidstones'].'</td></tr>
											<tr><td>Kupofried\'s Corundums</td><td>'.$selectedCharacterCurrencies['kupofried_corundums'].'</td></tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script src="themes/default/js/myCharacters.js"></script>
			<script>
				$(document).ready(function() {
	    			var characterEquipmentTable = $("#characterEquipment").DataTable({
	    				"processing": true,
	        			"serverSide": true,
	        			"ajax": "services/getCharacterInventory.php?charid='.$selectedCharacter['charid'].'",
						"order": [[ 1, "asc" ]],
						scrollY: 300,
	        			scrollCollapse: true,
	        			"columns": [
							{"orderable": false, "width": "10%"},
							null,
							null,
							null,
							{"orderable": false},
							{"orderable": false}
						]
				    });
				} );
			</script>
		';

	}

?>