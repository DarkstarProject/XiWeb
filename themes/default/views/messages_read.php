<?php
if (!empty($message_error)) {
  $output .= '
    <br />
    <div class="uk-alert uk-alert-danger uk-width-1-2 uk-align-center"> 
      <i class="uk-icon uk-icon-times"></i> Error retrieving message:
      <ul>';
      foreach ($message_error as $error) {
        $output .= '
        <li>'.$error.'</li>';
      }
      $output .= '
      </ul>
    </div>';
}
else {
  $output .= '
    <br />
    <div class="uk-panel uk-panel-box uk-align-center uk-width-1-2">
      <h3 class="uk-panel-title"><i class="uk-icon uk-icon-envelope"></i> Message</h3>
      <hr class="uk-panel-divider" />
      <div class="uk-panel uk-panel-box uk-panel-box-secondary">
        <span><strong>From:</strong> '.getAccountName($message[0]['sender_id']).'</span>
        <hr class="uk-panel-divider" />
        <span><strong>Message:</strong></span><br />
        <span>'.$message[0]['message_body'].'</span>
      </div>
      <br />
      <a href="messages.php?a=compose"><button class="uk-button uk-button-success">Reply</button></a>
    </div>';
}
?>