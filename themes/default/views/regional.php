<?php

if (!empty($_SESSION['errors']['login'])) {
  $output .= '
   <div class="uk-alert uk-alert-danger uk-width-1-2 uk-align-center">
      <i class="uk-icon uk-icon-times"></i> '.$lang['error']['general']['error_message'].'
      <ul>';
  foreach ($_SESSION['errors']['login'] as $error) {
    $output .= '
        <li>'.$error.'</li>';
  }
  $output .= '
      </ul>
    </div>';
}
else {
  $output .= '    <br />';
}

if ($page == 'regional main') {
  $output .= '
      <div class="uk-panel uk-panel-box uk-align-center uk-width-1-2">
        <h3 class="uk-panel-title"><i class="uk-icon uk-icon-globe"></i> Regional</h3>
        <hr class="uk-panel-divider" />
        <dl id="gmap">
          <dd><a id="sandoria" href="regional.php?id=2">San D\'Oria<br />Regional Info<br /><br />'. getRegionCount("Sandoria") .' players online</a></dd>
          <dd><a id="ronfaure" href="regional.php?id=3">Ronfaure<br />Regional Info<br />'. getRegionCount("Ronfaure") .' players online</a></dd>
          <dd><a id="bastok" href="regional.php?id=1">Bastok<br />Regional Info<br />'. getRegionCount("Bastok") .' players online</a></dd>
          <dd><a id="zulkheim" href="regional.php?id=4">Zulkheim<br />Regional Info<br />'. getRegionCount("Zulkheim") .' players online</a></dd>
          <dd><a id="windurst" href="regional.php?id=5">Windurst<br />Regional Info<br />'. getRegionCount("Windurst") .' players online</a></dd>
          <dd><a id="valdeaunia" href="regional.php?id=6">Valdeaunia<br />Regional Info<br />'. getRegionCount("Valdeaunia") .' players online</a></dd>
          <dd><a id="norvallen" href="regional.php?id=7">Norvallen<br />Regional Info<br />'. getRegionCount("Norvallen") .' players online</a></dd>
          <dd><a id="volbow" href="regional.php?id=8">Volbow<br />Regional Info<br />'. getRegionCount("Volbow") .' players online</a></dd>
          <dd><a id="sarutabaruta" href="regional.php?id=9">Sarutabaruta<br />Regional Info<br />'. getRegionCount("Sarutabaruta") .' players online</a></dd>
          <dd><a id="elshimo" href="regional.php?id=10">Elshimo Lowlands<br />Regional Info<br />'. getRegionCount("ElshimoLL") .' players online</a></dd>
          <dd><a id="elshimo2" href="regional.php?id=11">Elshimo Uplands<br />Regional Info<br />'. getRegionCount("ElshimoUL") .' players online</a></dd>
          <dd><a id="kuzotz" href="regional.php?id=12">Kuzotz<br />Regional Info<br />'. getRegionCount("Kuzotz") .' players online</a></dd>
          <dd><a id="tavnazian" Archipelago" href="regional.php?id=13">Tavnazian Archipelago<br />Regional Info<br />'. getRegionCount("Tavnazian") .' players online</a></dd>
          <dd><a id="fauregandi" href="regional.php?id=14">Fauregandi<br />Regional Info<br />'. getRegionCount("Fauregandi") .' players online</a></dd>
          <dd><a id="qufim" href="regional.php?id=15">Qufim<br />Regional Info<br />'. getRegionCount("Qufim") .' players online</a></dd>
          <dd><a id="jeuno" href="regional.php?id=16">Jeuno<br />Regional Info<br />'. getRegionCount("Jeuno") .' players online</a></dd>
          <dd><a id="gustaberg" href="regional.php?id=17">Gustaberg<br />Regional Info<br />'. getRegionCount("Gustaberg") .' players online</a></dd>
          <dd><a id="tulia" href="regional.php?id=18">Tu\'Lia<br />Regional Info<br />'. getRegionCount("TuLia") .' players online</a></dd>
          <dd><a id="litelor" href="regional.php?id=19">Li\'Telor<br />Regional Info<br />'. getRegionCount("LiTelor") .' players online</a></dd>
          <dd><a id="kolshushu" href="regional.php?id=20">Kolshushu<br />Regional Info<br />'. getRegionCount("Kolshushu") .' players online</a></dd>
          <dd><a id="aragoneu" href="regional.php?id=21">Aragoneu<br />Regional Info<br />'. getRegionCount("Arargoneu") .' players online</a></dd>
          <dd><a id="derfland" href="regional.php?id=22">Derfland<br />Regional Info<br />'. getRegionCount("Derfland") .' players online</a></dd>
          <dd><a id="movalpolos" href="regional.php?id=23">Movalpolos<br />Regional Info<br />'. getRegionCount("Ronfaure") .' players online</a></dd>
        </dl>
        <br />
        <br />
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
          <h3 class="uk-panel-title"><i class="uk-icon uk-icon-binoculars"></i> Who\'s Online <em class="uk-text-small uk-text-muted">'.OnlineCount().' players online</em></h3>
          <hr class="uk-panel-divider" />';
  if (empty($onlineList)) {
    $output .= '
    <em class="uk-text-muted">Nobody online</em>';
  }
  else {
    $output .= '
          <div class="uk-panel uk-panel-box">
            <table class="uk-table uk-table-striped uk-table-hover uk-table-condensed uk-text-small">
              <thead>
                <tr>
                 <th>Character Name</th>
                 <th>Main Job</th>
                 <th>Location</th>
                </tr>
              </thead>
              <tbody>';
    foreach ($onlineList as $ol) {
      $output .= '
                <tr>
                  <td><a href="characters.php?id='.$ol['charid'].'">'.getCharacterName($ol['charid']).'</a></td>
                  <td>'.getJobLevel($ol['charid'],getCharMJob($ol['charid'])) .' '.strtoupper(getCharMJob($ol['charid'])).'</td>
                  <td>'.getZoneName(getCharacterZone($ol['charid'])).'</td>
                </tr>';
    }
  }
  $output .= '        
              </tbody>
            </table>
          </div>';
  if ($totalPages > 1) {
    $output .= '
          <ul class="uk-pagination">';
    for ($i = 1; $i <= $totalPages; $i++) {
      if ($i == $pg) {
        $output .= '
      <li class="uk-active"><span>'.$i.'</span></li>';
      }
      else {
        $output .= '
      <li><a href="regional.php'.(!empty($_GET['id']) ? '?id='.$_GET['id'].'&page='.$i.'' : '?page='.$i.'').'">'.$i.'</a></li>';
      }
    }
    $output .= '
          </ul>
      ';
  }
  $output .= '
        </div>	
      </div>';
}
else {
  $output .= '
      <div class="uk-panel uk-panel-box uk-align-center uk-width-1-2">
        <h3 class="uk-panel-title"><i class="uk-icon uk-icon-info"></i> Region Information - '.getRegionName($id).'</h3>
        <hr class="uk-panel-divider" />';
  if (!empty($onlineList)) {
    $output .= '
        <table class="uk-table uk-table-striped uk-table-hover uk-table-condensed uk-text-small">
          <thead>
            <tr>
             <th>Character Name</th>
             <th>Main Job</th>
             <th>Location</th>
            </tr>
          </thead>
          <tbody>';
            foreach ($onlineList as $ol) {
              $output .= '
            <tr>
             <td><a href="characters.php?id='.$ol['charid'].'">'.getCharacterName($ol['charid']).'</a></td>
             <td>'.getJobLevel($ol['charid'],getCharMJob($ol['charid'])).' '.strtoupper(getCharMJob($ol['charid'])).'</td>
             <td>'.getZoneName(getCharacterZone($ol['charid'])).'</td>
            </tr>';
            }
    $output .= '
          </tbody>
        </table>';
    if ($totalPages > 1) {
      $output .= '
        <ul class="uk-pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
          if ($i == $pg) {
            $output .= '
          <li class="uk-active"><span>'.$i.'</span></li>';
          }
          else {
            $output .= '
          <li><a href="regional.php'.(!empty($_GET['id']) ? '?id='.$_GET['id'].'&page='.$i.'' : '?page='.$i.'').'">'.$i.'</a></li>';
          }
        }
        $output .= '
        </ul>
      ';
    }
  }
  else {
    $output .= '
        <em class="uk-text-muted">Nobody online in this region</em>';
  }
  $output .= '
      </div>';
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
      </div>';
?>
