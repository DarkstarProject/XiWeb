<?php

if (!empty($_SESSION['errors'])) {
  $output .= '
   <div class="uk-alert uk-alert-danger uk-width-1-2 uk-align-center">
      <i class="uk-icon uk-icon-times"></i> '.$lang['error']['general']['error_message'].'
      <ul>
  ';
  foreach ($_SESSION['errors'] as $error) {
    $output .= '
        <li>'.$error.'</li>
    ';
  }
  $output .= '
      </ul>
    </div>
';
}
else {
  $output .= '    <br />';
}

if ($page == 'characters') {
  $output .= '
  <div class="uk-panel uk-panel-box uk-align-center uk-width-1-2">
      <h3 class="uk-panel-title"><i class="uk-icon uk-icon-lock"></i> Character List</h3>
      <hr class="uk-panel-divider" />
      '.($enable_creation ? '<i class="uk-icon uk-icon-plus"></i> <a href="create_character.php">Create Character</a>
      <hr class="uk-panel-divider" />' : '').'
      <div class="uk-panel uk-panel-box uk-panel-box-secondary">
        <table class="uk-table uk-table-hover uk-table-striped uk-text-small">
          <thead>
              <tr>
                <th>&nbsp;</th>
                <th>Character Name</th>
                <th>Main Job</th>
                <th>Support Job</th>
                <th>Current Location</th>
                <th>&nbsp;</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                <td colspan=6>
                 <span>The character highlighted in <strong>bold</strong> is your favorite character, and will be used as default in all transactions.</span>
                </td>
              </tr>
          </tfoot>
          <tbody>
  ';
  if (!empty($characters)) {
    foreach ($characters as $char) {
      $output .= '
              <tr class="uk-text-bold">
                  <td><i class="uk-icon uk-icon-carat-up"></i></td>
                  <td><a href="characters.php?id='.$char['charid'].'">'.$char['charname'].'</a></td>
                  <td>'.getJobLevel($char['charid'],getCharMJob($char['charid'])).strtoupper(getCharMJob($char['charid'])).'</td>
                  <td>'.getJobLevel($char['charid'],getCharSJob($char['charid'])).strtoupper(getCharSJob($char['charid'])).'</td>
                  <td>'.getZoneName(getCharacterZone($char['charid'])).'</td>
                  <td><i class="uk-icon uk-icon-times uk-text-danger"></i></td>
              </tr>
      ';
    }
  }
  else {
    $output .= '
              <tr>
                <td colspan=6>No characters</td>
              </tr>
    ';
  }
  $output .= '
          </tbody>
        </table>
      </div>
    </div>
';
}
else {
  $char = $character[0];
  $output .= '
  <div class="uk-panel uk-panel-box uk-align-center uk-width-1-2">
      <h3 class="uk-panel-title"><i class="uk-icon uk-icon-user"></i> Character Sheet - '.$char['charname'].'</h3>
      <hr class="uk-panel-divider" />
      <ul class="uk-tab uk-width-1-1" data-uk-tab data-uk-switcher="{connect:\'#my-id\'}">
        <li><a href="#">Character</a></li>
        <li><a href="#">Stats</a></li>
        <li><a href="#">Reputation</a></li>
        '.($show_currencies ? '<li><a href="#">Currency & Points</a></li>' : '').'
      </ul>
      
      <div class="uk-panel uk-panel-box" style="border-top: 0px; border-top-left-radius: 0px; border-top-right-radius: 0px;">
        <ul id="my-id" class="uk-switcher">
          <li>
            <br />
            <div class="uk-panel uk-panel-box uk-panel-box-secondary">
              <h3 class="uk-panel-title"><i class="uk-icon uk-icon-user"></i> '.$char['charname'].' - <em class="uk-text-muted">'.getTitle($char['charid']).'</em></h3>
              <hr class="uk-panel-divider" />
  ';
  // Need to generate the code to make the correct image display here based on the characters race/gender and face/hair combination.
  $output .= '
              <div class="uk-text-center"><img src="/themes/default/images/portraits/'.getCharacterRace($char['charid']).getCharacterGender($char['charid']).getCharacterAppearance($char['charid']).'.jpg" /></div>
  ';
  $output .= '
              <h3 class="uk-panel-title uk-text-center">'.strtoupper(getCharMJob($char['charid'])).getJobLevel($char['charid'],getCharMJob($char['charid'])).(getCharSJob($char['charid']) == true ? '/'.strtoupper(getCharSJob($char['charid'])).getJobLevel($char['charid'],getCharSJob($char['charid'])).'' : '') .'</h3><br />
              <div class="uk-grid">
                <div class="uk-width-1-2">
                  <div class="uk-text-bold">HP</div>
                  <div class="uk-progress uk-progress-striped uk-active uk-progress-success">
                    <div class="uk-progress-bar" style="width: 100%;">'.getCharacterHP($char['charid']).'</div>
                  </div>
                </div>
                <div class="uk-width-1-2">
                  <div class="uk-text-bold">MP</div>
                  <div class="uk-progress uk-progress-striped uk-active uk-progress-primary">
                    <div class="uk-progress-bar" style="width: 100%;">'.getCharacterMP($char['charid']).'</div>
                  </div>
                </div>
              </div>
              <div class="uk-text-bold" style="padding-top: 10px;">Experience</div>
              <div class="uk-progress uk-progress-striped uk-active uk-progress-warning">
                <div class="uk-progress-bar" style="width: 100%;">'.getCharacterExp($char['charid'],getCharMJob($char['charid'])).'/'.getCharacterMaxExp($char['charid']).'</div>
              </div>
            </div>
            <br />
            <div class="uk-panel uk-panel-box uk-panel-box-secondary">
              <h3 class="uk-panel-title"><i class="uk-icon uk-icon-shield"></i> Equipment</h3>
              <hr class="uk-panel-divider" />
              <div class="uk-panel uk-text-center">
                '.(getCharacterEquipment($char['charid'],'SLOT_MAIN') == 0 ? '<img src="http://static.ffxiah.com/images/eq1.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_MAIN').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' )
                .(getCharacterEquipment($char['charid'],'SLOT_SUB') == 0 ? '<img src="http://static.ffxiah.com/images/eq2.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_SUB').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' )
                .(getCharacterEquipment($char['charid'],'SLOT_RANGED') == 0 ? '<img src="http://static.ffxiah.com/images/eq3.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_RANGED').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' )
                .(getCharacterEquipment($char['charid'],'SLOT_AMMO') == 0 ? '<img src="http://static.ffxiah.com/images/eq4.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_AMMO').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' ).'<br />
                '.(getCharacterEquipment($char['charid'],'SLOT_HEAD') == 0 ? '<img src="http://static.ffxiah.com/images/eq5.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_HEAD').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' )
                .(getCharacterEquipment($char['charid'],'SLOT_NECK') == 0 ? '<img src="http://static.ffxiah.com/images/eq6.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_NECK').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' )
                .(getCharacterEquipment($char['charid'],'SLOT_EAR1') == 0 ? '<img src="http://static.ffxiah.com/images/eq7.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_EAR1').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' )
                .(getCharacterEquipment($char['charid'],'SLOT_EAR2') == 0 ? '<img src="http://static.ffxiah.com/images/eq8.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_EAR2').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' ).'<br />
                '.(getCharacterEquipment($char['charid'],'SLOT_BODY') == 0 ? '<img src="http://static.ffxiah.com/images/eq9.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_BODY').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' )
                .(getCharacterEquipment($char['charid'],'SLOT_HANDS') == 0 ? '<img src="http://static.ffxiah.com/images/eq10.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_HANDS').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' )
                .(getCharacterEquipment($char['charid'],'SLOT_RING1') == 0 ? '<img src="http://static.ffxiah.com/images/eq11.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_RING1').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' )
                .(getCharacterEquipment($char['charid'],'SLOT_RING2') == 0 ? '<img src="http://static.ffxiah.com/images/eq12.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_RING2').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' ).'<br />
                '.(getCharacterEquipment($char['charid'],'SLOT_BACK') == 0 ? '<img src="http://static.ffxiah.com/images/eq13.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_BACK').'.png" />' )
                .(getCharacterEquipment($char['charid'],'SLOT_WAIST') == 0 ? '<img src="http://static.ffxiah.com/images/eq14.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_WAIST').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' )
                .(getCharacterEquipment($char['charid'],'SLOT_LEGS') == 0 ? '<img src="http://static.ffxiah.com/images/eq15.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_LEGS').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' )
                .(getCharacterEquipment($char['charid'],'SLOT_FEET') == 0 ? '<img src="http://static.ffxiah.com/images/eq16.gif" />' : '<img src="http://static.ffxiah.com/images/icon/'.getCharacterEquipment($char['charid'],'SLOT_FEET').'.png" style="background: url(\'http://static.ffxiah.com/images/equip_box.gif\');" />' ).'<br />
              </div>
            </div>
            <br />
            <div class="uk-panel uk-panel-box uk-panel-box-secondary">
              <h3 class="uk-panel-title"><i class="uk-icon uk-icon-briefcase"></i> Storage</h3>
              <hr class="uk-panel-divider" />
              <div class="uk-grid uk-text-small">
                <div class="uk-width-1-4"><span class="uk-text-bold">Inventory:</span> '.getCharacterInventory($char['charid'],'inventory').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Mog Satchel:</span> '.getCharacterInventory($char['charid'],'satchel').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Mog Locker:</span> '.getCharacterInventory($char['charid'],'locker').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Mog Safe:</span> '.getCharacterInventory($char['charid'],'safe').'</div>
              </div>
              <div class="uk-grid uk-text-small">
                <div class="uk-width-1-4"><span class="uk-text-bold">Case:</span> '.getCharacterInventory($char['charid'],'case').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Mog Sack:</span> '.getCharacterInventory($char['charid'],'sack').'</div>
                <div class="uk-width-1-4">&nbsp;</div>
                <div class="uk-width-1-4">&nbsp;</div>
              </div>
            </div>
          </li>
          <li>
            <br />
            <div class="uk-panel">
              <br />
            <div class="uk-panel uk-panel-box uk-panel-box-secondary">
              <h3 class="uk-panel-title"><i class="uk-icon uk-icon-graduation-cap"></i> Jobs</h3>
              <hr class="uk-panel-divider" />
              <div class="uk-grid uk-text-small">
                <div class="uk-width-1-4"><span class="uk-text-bold">Warrior:</span> '.getJobLevel($char['charid'],'war').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Monk:</span> '.getJobLevel($char['charid'],'mnk').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">White Mage:</span> '.getJobLevel($char['charid'],'whm').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Black Mage:</span> '.getJobLevel($char['charid'],'blm').'</div>
              </div>
              <div class="uk-grid uk-text-small">
                <div class="uk-width-1-4"><span class="uk-text-bold">Red Mage:</span> '.getJobLevel($char['charid'],'rdm').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Thief:</span> '.getJobLevel($char['charid'],'thf').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Paladin:</span> '.getJobLevel($char['charid'],'pld').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Dark Knight:</span> '.getJobLevel($char['charid'],'drk').'</div>
              </div>
              <div class="uk-grid uk-text-small">
                <div class="uk-width-1-4"><span class="uk-text-bold">Beastmaster:</span> '.getJobLevel($char['charid'],'bst').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Bard:</span> '.getJobLevel($char['charid'],'brd').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Ranger:</span> '.getJobLevel($char['charid'],'rng').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Samurai:</span> '.getJobLevel($char['charid'],'sam').'</div>
              </div>
              <div class="uk-grid uk-text-small">
                <div class="uk-width-1-4"><span class="uk-text-bold">Ninja:</span> '.getJobLevel($char['charid'],'nin').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Dragoon:</span> '.getJobLevel($char['charid'],'drg').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Summoner:</span> '.getJobLevel($char['charid'],'smn').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Blue Mage:</span> '.getJobLevel($char['charid'],'blu').'</div>
              </div>
              <div class="uk-grid uk-text-small">
                <div class="uk-width-1-4"><span class="uk-text-bold">Corsair:</span> '.getJobLevel($char['charid'],'cor').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Puppetmaster:</span> '.getJobLevel($char['charid'],'pup').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Dancer:</span> '.getJobLevel($char['charid'],'dnc').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Scholar:</span> '.getJobLevel($char['charid'],'sch').'</div>
              </div>
              <div class="uk-grid uk-text-small">
                  <div class="uk-width-1-4"><span class="uk-text-bold">Geomancer:</span> '.getJobLevel($char['charid'],'geo').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Rune Fencer:</span> '.getJobLevel($char['charid'],'run').'</div>
                  <div class="uk-width-1-4">&nbsp;</div>
                  <div class="uk-width-1-4">&nbsp;</div>
                </div>
            </div>
            <br />
            <div class="uk-panel uk-panel-box uk-panel-box-secondary">
              <h3 class="uk-panel-title"><i class="uk-icon uk-icon-shield"></i> Combat Skills</h3>
              <hr class="uk-panel-divider" />
              <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title"><i class="uk-icon uk-icon-gavel"></i> Weapon Skills</h3>
                <hr class="uk-panel-divider" />
                <div class="uk-grid uk-text-small">
                  <div class="uk-width-1-4"><span class="uk-text-bold">Axe:</span> '.getCharacterSkill($char['charid'],'axe').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Great Axe:</span> '.getCharacterSkill($char['charid'],'gax').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Club:</span> '.getCharacterSkill($char['charid'],'clb').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Dagger:</span> '.getCharacterSkill($char['charid'],'dag').'</div>
                </div>
                <div class="uk-grid uk-text-small">
                <div class="uk-width-1-4"><span class="uk-text-bold">Hand-to-Hand:</span> '.getCharacterSkill($char['charid'],'h2h').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Katana:</span> '.getCharacterSkill($char['charid'],'kat').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Great Katana:</span> '.getCharacterSkill($char['charid'],'gkt').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Polearm:</span> '.getCharacterSkill($char['charid'],'pol').'</div>
                </div>
                <div class="uk-grid uk-text-small">
                  <div class="uk-width-1-4"><span class="uk-text-bold">Scythe:</span> '.getCharacterSkill($char['charid'],'syh').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Staff:</span> '.getCharacterSkill($char['charid'],'stf').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Sword:</span> '.getCharacterSkill($char['charid'],'swd').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Great Sword:</span> '.getCharacterSkill($char['charid'],'gsd').'</div>
                </div>
              </div>
              <br />
              <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title"><i class="uk-icon uk-icon-bullseye"></i> Ranged Skills</h3>
                <hr class="uk-panel-divider" />
                <div class="uk-grid uk-align-center uk-text-small">
                  <div class="uk-width-1-3"><span class="uk-text-bold">Archery:</span> '.getCharacterSkill($char['charid'],'arc').'</div>
                  <div class="uk-width-1-3"><span class="uk-text-bold">Marksmanship:</span> '.getCharacterSkill($char['charid'],'mrk').'</div>
                  <div class="uk-width-1-3"><span class="uk-text-bold">Throwing:</span> '.getCharacterSkill($char['charid'],'thr').'</div>
                </div>
              </div>
              <br />
              <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title"><i class="uk-icon uk-icon-shield"></i> Defensive Skills</h3>
                <hr class="uk-panel-divider" />
                <div class="uk-grid uk-text-small">
                  <div class="uk-width-1-4"><span class="uk-text-bold">Evasion:</span> '.getCharacterSkill($char['charid'],'eva').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Guarding:</span> '.getCharacterSkill($char['charid'],'grd').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Parrying:</span> '.getCharacterSkill($char['charid'],'par').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Shield:</span> '.getCharacterSkill($char['charid'],'shl').'</div>
                </div>
              </div>
              <br />
              <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title"><i class="uk-icon uk-icon-flask"></i> Magic Skills</h3>
                <hr class="uk-panel-divider" />
                <div class="uk-grid uk-text-small">
                  <div class="uk-width-1-4"><span class="uk-text-bold">Blue:</span> '.getCharacterSkill($char['charid'],'blu').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Dark:</span> '.getCharacterSkill($char['charid'],'drk').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Divine:</span> '.getCharacterSkill($char['charid'],'div').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Elemental:</span> '.getCharacterSkill($char['charid'],'ele').'</div>
                </div>
                <div class="uk-grid uk-text-small">
                <div class="uk-width-1-4"><span class="uk-text-bold">Enfeebling:</span> '.getCharacterSkill($char['charid'],'enf').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Enhancing:</span> '.getCharacterSkill($char['charid'],'enh').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Healing:</span> '.getCharacterSkill($char['charid'],'hea').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Summoning:</span> '.getCharacterSkill($char['charid'],'sum').'</div>
                </div>
                <div class="uk-grid uk-text-small">
                  <div class="uk-width-1-4"><span class="uk-text-bold">Ninjutsu:</span> '.getCharacterSkill($char['charid'],'nin').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Singing:</span> '.getCharacterSkill($char['charid'],'sng').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">String:</span> '.getCharacterSkill($char['charid'],'str').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Wind:</span> '.getCharacterSkill($char['charid'],'wnd').'</div>
                </div>
                <div class="uk-grid uk-text-small">
                  <div class="uk-width-1-4"><span class="uk-text-bold">Geomancy:</span> '.getCharacterSkill($char['charid'],'geo').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Handbell:</span> '.getCharacterSkill($char['charid'],'hnd').'</div>
                  <div class="uk-width-1-4">&nbsp;</div>
                  <div class="uk-width-1-4">&nbsp;</div>
                </div>
              </div>
            </div>
            <br />
            <div class="uk-panel uk-panel-box uk-panel-box-secondary">
              <h3 class="uk-panel-title"><i class="uk-icon uk-icon-cutlery"></i> Crafting Skills</h3>
              <hr class="uk-panel-divider" />
              <div class="uk-grid uk-text-small">
                <div class="uk-width-1-4"><span class="uk-text-bold">Alchemy:</span> '.getCharacterSkill($char['charid'],'alc').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Bonecraft:</span> '.getCharacterSkill($char['charid'],'bon').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Clothcraft:</span> '.getCharacterSkill($char['charid'],'clt').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Cooking:</span> '.getCharacterSkill($char['charid'],'cok').'</div>
              </div>
              <div class="uk-grid uk-text-small">
                <div class="uk-width-1-4"><span class="uk-text-bold">Fishing:</span> '.getCharacterSkill($char['charid'],'fsh').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Goldsmithing:</span> '.getCharacterSkill($char['charid'],'gld').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Leathercraft:</span> '.getCharacterSkill($char['charid'],'lth').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Smithing:</span> '.getCharacterSkill($char['charid'],'smt').'</div>
              </div>
              <div class="uk-grid uk-text-small">
                <div class="uk-width-1-4"><span class="uk-text-bold">Woodworking:</span> '.getCharacterSkill($char['charid'],'wdw').'</div>
                <div class="uk-width-1-4"><span class="uk-text-bold">Synergy:</span> '.getCharacterSkill($char['charid'],'syn').'</div>
                <div class="uk-width-1-4">&nbsp;</div>
                <div class="uk-width-1-4">&nbsp;</div>
              </div>
            </div>
          </li>
          <li>
            <br />
            <div class="uk-panel">
              <br />
            <div class="uk-panel uk-panel-box uk-panel-box-secondary">
              <h3 class="uk-panel-title"><i class="uk-icon uk-icon-signal"></i> Reputation</h3>
              <hr class="uk-panel-divider" />
              <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title"><i class="uk-icon uk-icon-wifi"></i> Ranks</h3>
                <hr class="uk-panel-divider" />
                <div class="uk-grid uk-align-center uk-text-small">
                  <div class="uk-width-1-3"><span class="uk-text-bold">San D\'Oria:</span> '.getCharacterRank($char['charid'],'sandoria').'</div>
                  <div class="uk-width-1-3"><span class="uk-text-bold">Bastok:</span> '.getCharacterRank($char['charid'],'bastok').'</div>
                  <div class="uk-width-1-3"><span class="uk-text-bold">Windurst:</span> '.getCharacterRank($char['charid'],'windurst').'</div>
                </div>
              </div>
              <br />
              <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title"><i class="uk-icon uk-icon-signal"></i> Fame</h3>
                <hr class="uk-panel-divider" />
                <div class="uk-grid uk-align-center uk-text-small">
                  <div class="uk-width-1-5"><span class="uk-text-bold">San D\'Oria:</span> '.getCharacterFame($char['charid'],'sandoria').'</div>
                  <div class="uk-width-1-5"><span class="uk-text-bold">Bastok:</span> '.getCharacterFame($char['charid'],'bastok').'</div>
                  <div class="uk-width-1-5"><span class="uk-text-bold">Windurst:</span> '.getCharacterFame($char['charid'],'windurst').'</div>
                  <div class="uk-width-1-5"><span class="uk-text-bold">Norg:</span> '.getCharacterFame($char['charid'],'norg').'</div>
                  <div class="uk-width-1-5"><span class="uk-text-bold">Jeuno:</span> '.getCharacterFame($char['charid'],'jeuno').'</div>
                </div>
              </div>
            </div> 
          </li>
          <li>
            <br />
            <div class="uk-panel">
              <br />
            <div class="uk-panel uk-panel-box uk-panel-box-secondary">
              <h3 class="uk-panel-title"><i class="uk-icon uk-icon-money"></i> Currency and Points</h3>
              <hr class="uk-panel-divider" />
              <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title"><i class="uk-icon uk-icon-dollar"></i> Currencies</h3>
                <hr class="uk-panel-divider" />
                <div class="uk-grid uk-align-center uk-text-small">
                  <div class="uk-width-1-4"><span class="uk-text-bold">Beastman Seal:</span> '.getCharacterCurrency($char['charid'],'beastman_seal').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Kindred Seal:</span> '.getCharacterCurrency($char['charid'],'kindred_seal').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Ancient Beastcoin:</span> '.getCharacterCurrency($char['charid'],'ancient_beastcoin').'</div>
                  <div class="uk-width-1-4"><span class="uk-text-bold">Jetton:</span> '.getCharacterCurrency($char['charid'],'jetton').'</div>
                </div>
              </div>
              <br />
              <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title"><i class="uk-icon uk-icon-dot-circle-o"></i> Points</h3>
                <hr class="uk-panel-divider" />
                <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                  <h3 class="uk-panel-title"><i class="uk-icon uk-icon-dot-circle-o"></i> Conquest Points</h3>
                  <hr class="uk-panel-divider" />
                  <div class="uk-grid uk-align-center uk-text-small">
                    <div class="uk-width-1-3"><span class="uk-text-bold">San D\'Oria Conquest:</span> '.getCharacterCurrency($char['charid'],'sandoria_cp').'</div>
                    <div class="uk-width-1-3"><span class="uk-text-bold">Bastok Conquest:</span> '.getCharacterCurrency($char['charid'],'bastok_cp').'</div>
                    <div class="uk-width-1-3"><span class="uk-text-bold">Windurst Conquest:</span> '.getCharacterCurrency($char['charid'],'windurst_cp').'</div>
                  </div>
                </div>
                <br />
                <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                  <h3 class="uk-panel-title"><i class="uk-icon uk-icon-cutlery"></i> Guild Points</h3>
                  <hr class="uk-panel-divider" />
                  <div class="uk-grid uk-align-center uk-text-small">
                    <div class="uk-width-1-3"><span class="uk-text-bold">Fishing:</span> '.getCharacterCurrency($char['charid'],'guild_fishing').'</div>
                    <div class="uk-width-1-3"><span class="uk-text-bold">Woodworking:</span> '.getCharacterCurrency($char['charid'],'guild_woodworking').'</div>
                    <div class="uk-width-1-3"><span class="uk-text-bold">Smithing:</span> '.getCharacterCurrency($char['charid'],'guild_smithing').'</div>
                  </div>
                  <div class="uk-grid uk-align-center uk-text-small">
                    <div class="uk-width-1-3"><span class="uk-text-bold">Goldsmithing:</span> '.getCharacterCurrency($char['charid'],'guild_goldsmithing').'</div>
                    <div class="uk-width-1-3"><span class="uk-text-bold">Weaving:</span> '.getCharacterCurrency($char['charid'],'guild_weaving').'</div>
                    <div class="uk-width-1-3"><span class="uk-text-bold">Leathercraft:</span> '.getCharacterCurrency($char['charid'],'guild_leathercraft').'</div>
                  </div>
                  <div class="uk-grid uk-align-center uk-text-small">
                    <div class="uk-width-1-3"><span class="uk-text-bold">Bonecraft:</span> '.getCharacterCurrency($char['charid'],'guild_bonecraft').'</div>
                    <div class="uk-width-1-3"><span class="uk-text-bold">Alchemy:</span> '.getCharacterCurrency($char['charid'],'guild_alchemy').'</div>
                    <div class="uk-width-1-3"><span class="uk-text-bold">Cooking:</span> '.getCharacterCurrency($char['charid'],'guild_cooking').'</div>
                  </div>
                </div>
                <br />
                <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                  <h3 class="uk-panel-title"><i class="uk-icon uk-icon-anchor"></i> Assault Points</h3>
                  <hr class="uk-panel-divider" />
                  <div class="uk-grid uk-align-center uk-text-small">
                    <div class="uk-width-1-3"><span class="uk-text-bold">Mamool Ja:</span> '.getCharacterCurrency($char['charid'],'mamool_assault_point').'</div>
                    <div class="uk-width-1-3"><span class="uk-text-bold">Leujaoam Sanctum:</span> '.getCharacterCurrency($char['charid'],'leujaoam_assault_point').'</div>
                    <div class="uk-width-1-3"><span class="uk-text-bold">Lebros Cavern:</span> '.getCharacterCurrency($char['charid'],'lebros_assault_point').'</div>
                  </div>
                  <div class="uk-grid uk-align-center uk-text-small">
                    <div class="uk-width-1-3"><span class="uk-text-bold">Periqia:</span> '.getCharacterCurrency($char['charid'],'periqia_assault_point').'</div>
                    <div class="uk-width-1-3"><span class="uk-text-bold">Ilrusi Atoll:</span> '.getCharacterCurrency($char['charid'],'ilrusi_assault_point').'</div>
                    <div class="uk-width-1-3"><span class="uk-text-bold">Nyzul Isle:</span> '.getCharacterCurrency($char['charid'],'nzul_isle_assault_point').'</div>
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>  
      </div>
    </div>
    
    <!-- This is the modal -->
    <div id="my-modal" class="uk-modal">
        <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close"></a>
            <div class="uk-panel">
              <div class="uk-panel-title">Friend 1</div>
              <hr class="uk-panel-divider" />
              <h3 class="uk-panel-title uk-text-right">You</h3>
              <div class="uk-panel uk-panel-box uk-panel-box-primary uk-text-right">
                Hey there!
              </div>
              <br />
              <h3 class="uk-panel-title">Friend 1</h3>
              <div class="uk-panel uk-panel-box uk-panel-box-secondary uk-text-left">
                Hi! Thanks for contacting me!
                
                What is up with you ?
              </div>
              <br />
              <div class="uk-panel uk-width-1-1 uk-align-left">
                <form class="uk-form-horizontal">
                  <div class="uk-form-row">
                    <div style="width: 100%;"><input type="text" placeholder="username or email" style="width: 90%;" /><button style="width: 10%;">Send</button></div>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
    
    <!-- This is the off-canvas sidebar -->
    <div id="my-id" class="uk-offcanvas">
      <div class="uk-offcanvas-bar uk-offcanvas-bar-flip">
      <div class="uk-panel">
        <h3 class="uk-panel-title">Online Friends (1)</h3>
        <span><a href="#" class="uk-text-primary"><i class="uk-icon uk-icon-user-plus"></i> Add friend</a></span>
        <hr class="uk-panel-divider" />
        <i class="uk-icon uk-icon-toggle-on uk-text-success"></i> <a href="#my-modal"  data-uk-modal>Friend 1</a> <i class="uk-icon uk-icon-times uk-text-danger"></i>
        <hr class="uk-panel-divider" />
        <h3 class="uk-panel-title">Offline Friends (4)</h3>
        <hr class="uk-panel-divider" />
        <em class="uk-text-muted"><i class="uk-icon uk-icon-toggle-off"></i> Friend 2 <i class="uk-icon uk-icon-times uk-text-danger"></i></em><br />
        <em class="uk-text-muted"><i class="uk-icon uk-icon-toggle-off"></i> Friend 3 <i class="uk-icon uk-icon-times uk-text-danger"></i></em><br />
        <em class="uk-text-muted"><i class="uk-icon uk-icon-toggle-off"></i> Friend 4 <i class="uk-icon uk-icon-times uk-text-danger"></i></em><br />
        <em class="uk-text-muted"><i class="uk-icon uk-icon-toggle-off"></i> Friend 5 <i class="uk-icon uk-icon-times uk-text-danger"></i></em><br />
        <hr class="uk-panel-divider" />
      </div>
    </div>
  ';
}
$output .= '
    
    <!-- This is the modal -->
    <div id="my-modal" class="uk-modal">
        <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close"></a>
            <div class="uk-panel">
              <div class="uk-panel-title">Friend 1</div>
              <hr class="uk-panel-divider" />
              <h3 class="uk-panel-title uk-text-right">You</h3>
              <div class="uk-panel uk-panel-box uk-panel-box-primary uk-text-right">
                Hey there!
              </div>
              <br />
              <h3 class="uk-panel-title">Friend 1</h3>
              <div class="uk-panel uk-panel-box uk-panel-box-secondary uk-text-left">
                Hi! Thanks for contacting me!
                
                What is up with you ?
              </div>
              <br />
              <div class="uk-panel uk-width-1-1 uk-align-left">
                <form class="uk-form-horizontal">
                  <div class="uk-form-row">
                    <div style="width: 100%;"><input type="text" placeholder="username or email" style="width: 90%;" /><button style="width: 10%;">Send</button></div>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
    
    <!-- This is the off-canvas sidebar -->
    <div id="my-id" class="uk-offcanvas">
      <div class="uk-offcanvas-bar uk-offcanvas-bar-flip">
      <div class="uk-panel">
        <h3 class="uk-panel-title">Online Friends (1)</h3>
        <span><a href="#" class="uk-text-primary"><i class="uk-icon uk-icon-user-plus"></i> Add friend</a></span>
        <hr class="uk-panel-divider" />
        <i class="uk-icon uk-icon-toggle-on uk-text-success"></i> <a href="#my-modal"  data-uk-modal>Friend 1</a> <i class="uk-icon uk-icon-times uk-text-danger"></i>
        <hr class="uk-panel-divider" />
        <h3 class="uk-panel-title">Offline Friends (4)</h3>
        <hr class="uk-panel-divider" />
        <em class="uk-text-muted"><i class="uk-icon uk-icon-toggle-off"></i> Friend 2 <i class="uk-icon uk-icon-times uk-text-danger"></i></em><br />
        <em class="uk-text-muted"><i class="uk-icon uk-icon-toggle-off"></i> Friend 3 <i class="uk-icon uk-icon-times uk-text-danger"></i></em><br />
        <em class="uk-text-muted"><i class="uk-icon uk-icon-toggle-off"></i> Friend 4 <i class="uk-icon uk-icon-times uk-text-danger"></i></em><br />
        <em class="uk-text-muted"><i class="uk-icon uk-icon-toggle-off"></i> Friend 5 <i class="uk-icon uk-icon-times uk-text-danger"></i></em><br />
        <hr class="uk-panel-divider" />
      </div>
    </div>
';
?>
