<?php
if (!empty($send_error)) {
  $output .= '
    <br />
    <div class="uk-alert uk-alert-danger uk-width-1-2 uk-align-center"> 
      <i class="uk-icon uk-icon-times"></i> Error sending message:
      <ul>';
      foreach ($send_error as $error) {
        $output .= '
        <li>'.$error.'</li>';
      }
      $output .= '
      </ul>
    </div>';
}

$output .= '
    <br />
    <div class="uk-panel uk-panel-box uk-align-center uk-width-1-2">
      <h3 class="uk-panel-title"><i class="uk-icon uk-icon-envelope"></i> Send Message</h3>
      <hr class="uk-panel-divider" />
      <div class="uk-panel uk-panel-box uk-panel-box-secondary">
        <form class="uk-form uk-form-horizontal" method="post" action="messages.php?a=compose">
          <div class="uk-form-row">
            <label class="uk-form-label">To:</label>
            <div class="uk-form-controls">
              <select name="friend" '.(!empty($err_friend) ? 'class="uk-form-danger"' : '').'>
                <option '.(empty($friend) ? 'selected' : '').'></option>
                ';
                if (!empty($friends_list)) {
                  foreach ($friends_list as $fr) {
                    if ($fr['fid'] = getAccountID($_SESSION['auth']['username'])) {
                      $username = getAccountName($fr['uid']);
                    }
                    else {
                      $username = getAccountName($fr['fid']);
                    }
                    $output .= '
                  <option '.($friend == ''.$username.'' ? 'selected' : '').'>'.$username.'</option>';
                  }
                }
                $output .= '
              </select>
              <span class="uk-form-inline-help uk-text-primary"> <i class="uk-icon uk-icon-info-circle"></i> You can only send new messages to people on your friends list</span>
            </div>
            '.(!empty($err_friend) ? '<span class="uk-form-inline-help uk-text-danger"> <i class="uk-icon uk-icon-times-circle"></i> Required</i>' : '').'
          </div>
          <div class="uk-form-row">
            <label class="uk-form-label">Message:</label>
            <div class="uk-form-controls">
              <textarea cols=100 rows=10 name="message" '.(!empty($err_message) ? 'class="uk-form-danger"' : '').'>'.(!empty($message) ? $message : '').'</textarea>
            </div>
            '.(!empty($err_message) ? '<span class="uk-form-inline-help uk-text-danger"> <i class="uk-icon uk-icon-times-circle"></i> Required</i>' : '').'
          </div>
          <div class="uk-form-row">
            <div class="uk-form-controls">
              <button class="uk-button uk-button-primary" type="submit">Send Message</button> <button class="uk-button uk-button-danger" type="reset">Cancel</button>
            </div>
          </div>
          <input type="hidden" name="send" value="1" />
        </form>
      </div>
    </div>';
?>