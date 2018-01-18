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

$output .= '
    <div class="uk-panel uk-panel-box uk-align-center uk-width-1-2">
      <h3 class="uk-panel-title"><i class="uk-icon uk-icon-user-plus"></i> Create Character</h3>
      <hr class="uk-panel-divider" />
      <em class="uk-text-muted uk-text-small">All fields marked with a * are required</em>
      <br />
      <br />
      <form class="uk-form uk-form-horizontal" method="post" action="create_character.php">
        <input type="hidden" name="create_character" value="1" />
        <fieldset>
          <legend><i class="uk-icon uk-icon-info"></i> Character Information</legend>
          <div class="uk-form-row">
            <label class="uk-form-label '.(!empty($_SESSION['validation']['validation']['charname']) ? 'uk-text-danger' : '').'"">Character Name*:</label>
            <div class="uk-form-controls"><input type="text" name="character_name" placeholder="character name" '.(!empty($charname) ? 'value="'.$charname.'"' : '').' />'.(!empty($_SESSION['validation']['validation']['charname']) ? '<br /><span class="uk-form-help-inline uk-text-danger"><i class="uk-icon uk-icon-times-circle"></i> '.$_SESSION['validation']['validation']['charname'].'</span>' : '').'
            </div>
          </div>
          <div class="uk-form-row">
            <label class="uk-form-label '.(!empty($_SESSION['validation']['validation']['race']) ? 'uk-text-danger' : '').'">Race*:</label>
            <div class="uk-form-controls">
              <input type="radio" name="race" value="Hume" '.(!empty($race) && ($race == 'Hume') ? 'checked' : '').' /><label>Hume</label><br>
              <input type="radio" name="race" value="Elvaan" '.(!empty($race) && ($race == 'Elvaan') ? 'checked' : '').' /><label>Elvaan</label><br>
              <input type="radio" name="race" value="Tarutaru" '.(!empty($race) && ($race == 'Tarutaru') ? 'checked' : '').' /><label>Tarutaru</label><br>
              <input type="radio" name="race"  value="Mithra" '.(!empty($race) && ($race == 'Mithra') ? 'checked' : '').' /><label>Mithra</label><br>
              <input type="radio" name="race"  value="Galka" '.(!empty($race) && ($race == 'Galka') ? 'checked' : '').' /><label>Galka</label>
              '.(!empty($_SESSION['validation']['validation']['race']) ? '<br /><span class="uk-form-help-inline uk-text-danger"><i class="uk-icon uk-icon-times-circle"></i> '.$_SESSION['validation']['validation']['race'].'</span>' : '').'
            </div>
          </div>
          <div class="uk-form-row">
            <label class="uk-form-label '.(!empty($_SESSION['validation']['validation']['gender']) ? 'uk-text-danger' : '').'"">Gender*:</label>
            <div class="uk-form-controls">
              <input type="radio" name="gender" value="Male" '.(!empty($gender) && ($gender == 'Male') ? 'checked' : '').' /><label> Male</label><br>
              <input type="radio" name="gender" value="Female" '.(!empty($gender) && ($gender == 'Female') ? 'checked' : '').'  /><label> Female</label>
            '.(!empty($_SESSION['validation']['validation']['gender']) ? '<br /><span class="uk-form-help-inline uk-text-danger"><i class="uk-icon uk-icon-times-circle"></i> '.$_SESSION['validation']['validation']['gender'].'</span>' : '').'
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend><i class="uk-icon uk-icon-eye"></i> Appearance</legend>
          <em class="uk-text-muted"><i class="uk-icon uk-icon-info"></i> To view the face and hair combinations, please click the <i class="uk-icon uk-icon-question-circle"></i> next to the selections.</em>
          <br />
          <br />
          <div class="uk-form-row">
            <label class="uk-form-label '.(!empty($_SESSION['validation']['validation']['size']) ? 'uk-text-danger' : '').'"">Size*:</label>
            <div class="uk-form-controls">
              <input type="radio" name="size" value="Small"  '.(!empty($size) && ($size == 'Small') ? 'checked' : '').' /><label> Small</label><br>
              <input type="radio" name="size" value="Medium"  '.(!empty($size) && ($size == 'Medium') ? 'checked' : '').' /><label> Medium</label><br>
              <input type="radio" name="size" value="Large"  '.(!empty($size) && ($size == 'Large') ? 'checked' : '').' /><label> Large</label>
            '.(!empty($_SESSION['validation']['validation']['size']) ? '<br /><span class="uk-form-help-inline uk-text-danger"><i class="uk-icon uk-icon-times-circle"></i> '.$_SESSION['validation']['validation']['size'].'</span>' : '').'
            </div>
          </div>
          <div class="uk-form-row">
            <label class="uk-form-label '.(!empty($_SESSION['validation']['validation']['face']) ? 'uk-text-danger' : '').'"">Face* <a href="#faces" data-uk-modal><i class="uk-icon uk-icon-question-circle"></i></a>:</label>
            <div class="uk-form-controls">
              <div class="uk-grid">
                <div class="uk-width-1-6">
                  <input type="radio" name="face" value="1" '.(!empty($face) && ($face == '1') ? 'checked' : '').' /><label> 1</label><br>
                  <input type="radio" name="face" value="2" '.(!empty($face) && ($face == '2') ? 'checked' : '').' /><label> 2</label><br>
                  <input type="radio" name="face" value="3" '.(!empty($face) && ($face == '3') ? 'checked' : '').' /><label> 3</label><br>
                  <input type="radio" name="face" value="4" '.(!empty($face) && ($face == '4') ? 'checked' : '').' /><label> 4</label>
                </div>
                <div class="uk-width-1-6">
                  <input type="radio" name="face" value="5" '.(!empty($face) && ($face == '5') ? 'checked' : '').' /><label> 5</label><br>
                  <input type="radio" name="face" value="6" '.(!empty($face) && ($face == '6') ? 'checked' : '').' /><label> 6</label><br>
                  <input type="radio" name="face" value="7" '.(!empty($face) && ($face == '7') ? 'checked' : '').' /><label> 7</label><br>
                  <input type="radio" name="face" value="8" '.(!empty($face) && ($face == '8') ? 'checked' : '').' /><label> 8</label><br>
                </div>
              </div>
              '.(!empty($_SESSION['validation']['validation']['face']) ? '<br /><span class="uk-form-help-inline uk-text-danger"><i class="uk-icon uk-icon-times-circle"></i> '.$_SESSION['validation']['validation']['face'].'</span>' : '').'
            </div> 
          </div>
          <div class="uk-form-row">
            <label class="uk-form-label '.(!empty($_SESSION['validation']['validation']['hair']) ? 'uk-text-danger' : '').'"">Hair*:</label>
            <div class="uk-form-controls">
              <input type="radio" name="hair" value="1" '.(!empty($hair) && ($hair == '1') ? 'checked' : '').' /><label> 1</label><br>
              <input type="radio" name="hair" value="2" '.(!empty($hair) && ($hair == '2') ? 'checked' : '').' /><label> 2</label>
            '.(!empty($_SESSION['validation']['validation']['hair']) ? '<br /><span class="uk-form-help-inline uk-text-danger"><i class="uk-icon uk-icon-times-circle"></i> '.$_SESSION['validation']['validation']['hair'].'</span>' : '').'
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend><i class="uk-icon uk-icon-graduation-cap"></i> Job</legend>
          <div class="uk-form-row">
            <label class="uk-form-label '.(!empty($_SESSION['validation']['validation']['job']) ? 'uk-text-danger' : '').'"">Main Job*:</label>
            <div class="uk-form-controls">
              <div class="uk-grid">
                <div class="uk-width-1-4">
                  <input type="radio" name="job" value="Warrior" '.(!empty($job) && ($job == 'Warrior') ? 'checked' : '').' /><label> Warrior</label><br>
                  <input type="radio" name="job" value="Monk" '.(!empty($job) && ($job == 'Monk') ? 'checked' : '').' /><label> Monk</label><br>
                  <input type="radio" name="job" value="White Mage" '.(!empty($job) && ($job == 'White Mage') ? 'checked' : '').' /><label> White Mage</label>
                </div>
                <div class="uk-width-1-4">
                  <input type="radio" name="job" value="Black Mage" '.(!empty($job) && ($job == 'Black Mage') ? 'checked' : '').' /><label> Black Mage</label><br>
                  <input type="radio" name="job" value="Red Mage" '.(!empty($job) && ($job == 'Red Mage') ? 'checked' : '').' /><label> Red Mage</label><br>
                  <input type="radio" name="job" value="Thief" '.(!empty($job) && ($job == 'Thief') ? 'checked' : '').' /><label> Thief</label>
                </div>
              </div>
            '.(!empty($_SESSION['validation']['validation']['job']) ? '<br /><span class="uk-form-help-inline uk-text-danger"><i class="uk-icon uk-icon-times-circle"></i> '.$_SESSION['validation']['validation']['job'].'</span>' : '').'
            </div>
            <hr class="uk-panel-divider" />
            <br />
            <br />';
            if (!empty($allow_advanced_jobs) && ($allow_advanced_jobs = TRUE)) {
              $output .= '
            <div class="uk-form-row">
            <label class="uk-form-label '.(!empty($_SESSION['validation']['validation']['job']) ? 'uk-text-danger' : '').'"">Advanced Jobs*:</label>
            <div class="uk-form-controls">
              <div class="uk-grid uk-margin-top-remove">
                <div class="uk-width-1-4">
                  <input type="radio" name="job" value="Paladin" '.(!empty($job) && ($job == 'Paladin') ? 'checked' : '').' /><label> Paladin</label><br>
                  <input type="radio" name="job" value="Dark Knight" '.(!empty($job) && ($job == 'Dark Knight') ? 'checked' : '').' /><label> Dark Knight</label><br>
                  <input type="radio" name="job" value="Beastmaster" '.(!empty($job) && ($job == 'Beastmaster') ? 'checked' : '').' /><label> Beastmaster</label>
                </div>
                <div class="uk-width-1-4">
                  <input type="radio" name="job" value="Bard" '.(!empty($job) && ($job == 'Bard') ? 'checked' : '').' /><label> Bard</label><br>
                  <input type="radio" name="job" value="Ranger" '.(!empty($job) && ($job == 'Ranger') ? 'checked' : '').' /><label> Ranger</label><br>
                  <input type="radio" name="job" value="Samurai" '.(!empty($job) && ($job == 'Samurai') ? 'checked' : '').' /><label> Samurai</label>
                </div>
              </div>
              <div class="uk-grid uk-margin-top-remove">
                <div class="uk-width-1-4">
                  <input type="radio" name="job" value="Ninja" '.(!empty($job) && ($job == 'Ninja') ? 'checked' : '').' /><label> Ninja</label><br>
                  <input type="radio" name="job" value="Dragoon" '.(!empty($job) && ($job == 'Dragoon') ? 'checked' : '').' /><label> Dragoon</label><br>
                  <input type="radio" name="job" value="Summoner" '.(!empty($job) && ($job == 'Summoner') ? 'checked' : '').' /><label> Summoner</label>
                </div>
                <div class="uk-width-1-4">
                  <input type="radio" name="job" value="Blue Mage" '.(!empty($job) && ($job == 'Blue Mage') ? 'checked' : '').' /><label> Blue Mage</label><br>
                  <input type="radio" name="job" value="Corsair"  '.(!empty($job) && ($job == 'Corsair') ? 'checked' : '').' /><label> Corsair</label><br>
                  <input type="radio" name="job" value="Puppetmaster"  '.(!empty($job) && ($job == 'Puppetmaster') ? 'checked' : '').' /><label> Puppetmaster</label>
                </div>
              </div>
              <div class="uk-grid uk-margin-top-remove">
                <div class="uk-width-1-4">
                  <input type="radio" name="job" value="Dancer"  '.(!empty($job) && ($job == 'Dancer') ? 'checked' : '').' /><label> Dancer</label><br>
                  <input type="radio" name="job" value="Scholar"  '.(!empty($job) && ($job == 'Scholar') ? 'checked' : '').' /><label> Scholar</label><br>
                  <input type="radio" name="job" value="Geomancer"  '.(!empty($job) && ($job == 'Geomancer') ? 'checked' : '').' /><label> Geomancer</label>
                </div>
                <div class="uk-width-1-4">
                  <input type="radio" name="job" value="Rune Fencer"  '.(!empty($job) && ($job == 'Rune Fencer') ? 'checked' : '').' /><label> Rune Fencer</label>
                </div>
              </div>
              '.(!empty($_SESSION['validation']['validation']['job']) ? '<br /><span class="uk-form-help-inline uk-text-danger"><i class="uk-icon uk-icon-times-circle"></i> '.$_SESSION['validation']['validation']['job'].'</span>' : '').'
            </div>';
            }
            $output .= '
           
          </div>
        </fieldset>
        <fieldset>
          <legend><i class="uk-icon uk-icon-flag"></i> Allegiance</legend>
          <div class="uk-form-row">
            <label class="uk-form-label '.(!empty($_SESSION['validation']['validation']['nation']) ? 'uk-text-danger' : '').'"">Home Nation*:</label>
            <div class="uk-form-controls">
              <input type="radio" name="nation" value="Republic of Bastok" '.(!empty($nation) && ($nation == 'Republic of Bastok') ? 'checked' : '').' /><label> Republic of Bastok</label><br>
              <input type="radio" name="nation" value="Kingdom of San D\'Oria" '.(!empty($nation) && ($nation == 'Kingdom of San D\'Oria') ? 'checked' : '').' /><label> Kingdom of San D\'Oria</label><br>
              <input type="radio" name="nation" value="Federation of Windurst" '.(!empty($nation) && ($nation == 'Federation of Windurst') ? 'checked' : '').' /><label> Federation of Windurst</label>
            '.(!empty($_SESSION['validation']['validation']['nation']) ? '<br /><span class="uk-form-help-inline uk-text-danger"><i class="uk-icon uk-icon-times-circle"></i> '.$_SESSION['validation']['validation']['nation'].'</span>' : '').'
            </div> 
          </div>
        </fieldset>
        <br />
        <br />
        <button class="uk-button uk-button-primary" type="submit">Create Character</button> <button class="uk-button uk-button-danger" type="reset">Clear</button>
      </form>
    </div>
    <div id="faces" class="uk-modal">
      <div class="uk-modal-dialog uk-modal-dialog-large">
        <div class="uk-overflow-container">
          <a class="uk-modal-close uk-close"></a>
          <div class="uk-panel-title"><i class="uk-icon uk-icon-eye"></i> Character Faces</div>
          <hr class="uk-panel-divider" />
          <table style="width: 100%">
            <tr>
              <td><div class="style1"><strong><span>- Elvaan -<br>
                <img alt="Elvaan" src="themes/default/images/Elvaan%20Faces.jpg" width="957" height="415"></span></strong></div>
              <div><hr><br><strong><span>- Hume -<br>
                <img alt="Hume" src="themes/default/images/Hume%20Faces.jpg" width="960" height="415"></span></strong><br></div>
              <div><hr><br><strong><span>- Tarutaru -<br>
                <img alt="Tarutaru" src="themes/default/images/Tarutaru%20Faces.jpg" width="960" height="416"></span></strong><br></div>
              <div><hr><br><strong><span>- Mithra -<br>
                <img alt="Mithra" src="themes/default/images/Mithra%20Faces.jpg" width="981" height="211"></span></strong><br></div>
              <div><hr><br><strong><span>- Galka -<br>
                <img alt="Galka" src="themes/default/images/Galka%20Faces.jpg" width="984" height="212"></span></strong><br></div>
              <div><hr></div>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
';
?>
