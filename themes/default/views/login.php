<?php

if (!empty($_SESSION['errors']['login'])) {
  $output .= '
   <div class="uk-alert uk-alert-danger uk-width-1-2 uk-align-center">
      <i class="uk-icon uk-icon-times"></i> '.$lang['error']['general']['error_message'].'
      <ul>
  ';
  foreach ($_SESSION['errors']['login'] as $error) {
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
  $output .= '
    <br />';
}

$output .= '
    <div class="uk-panel uk-panel-box uk-align-center uk-width-1-2">
      <h3 class="uk-panel-title"><i class="uk-icon uk-icon-lock"></i> Login</h3>
      <hr class="uk-panel-divider" />
      <em class="uk-text-muted uk-text-small">All fields marked with a * are required</em>
      <br />
      <br />
      <form class="uk-form uk-form-horizontal" action="login.php" method="post">
        <input type="hidden" name="login" value="1" />
        <div class="uk-form-row">
          <label class="uk-form-label uk-text-right">Username or Email*:</label>
          <div class="uk-form-controls">
            <input '.(!empty($_SESSION['errors']['validation']['username']) ? 'class="uk-form-danger"' : '').' type="text" placeholder="username or email" name="username" '.(!empty($_POST['username']) ? 'value="'.$_POST['username'].'"' : '').' />
            '.(!empty($_SESSION['errors']['validation']['username']) ? '<br />
            <span class="uk-form-help-block uk-text-danger"><i class="uk-icon uk-icon-times"></i> '.$lang['error']['general']['field_required'].'</span>' : '').'
          </div>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label uk-text-right">Password*:</label>
          <div class="uk-form-controls">
            <div class="uk-form-password">
              <input '.(!empty($_SESSION['errors']['validation']['password']) ? 'class="uk-form-danger"' : '').' type="password" placeholder="password" name="password" '.(!empty($_POST['password']) ? 'value="'.$_POST['password'].'"' : '').' />
              <a href="" class="uk-form-password-toggle" data-uk-form-password>Show</a>
            </div>
            '.(!empty($_SESSION['errors']['validation']['password']) ? '<br />
            <span class="uk-form-help-block uk-text-danger"><i class="uk-icon uk-icon-times"></i> '.$lang['error']['general']['field_required'].'</span>' : '').'
          </div>
        </div>
        <div class="uk-form-row">
          <div class="uk-form-controls">
            <button class="uk-button uk-button-primary" type="submit">Login</button>
          </div>
          <br />
          <div class="uk-text-center uk-text-small"><a href="register.php"><i class="uk-icon uk-icon-pencil-square"></i> Create Account</a></div>
          <div class="uk-text-center uk-text-small"><a href="#"><i class="uk-icon uk-icon-question-circle"></i> Forgot Password</a></div>
        </div>
      </form>
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
?>
