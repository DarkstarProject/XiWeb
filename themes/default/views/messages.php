<?php

if (!empty($success)) {
  $output .= '
  <div class="uk-alert uk-alert-success uk-width-1-2 uk-align-center"><i class="uk-icon uk-icon-check"></i> '.$success.'</div>';
}
$output .= '
    <br />
    <div class="uk-panel uk-panel-box uk-align-center uk-width-1-2">
      <h3 class="uk-panel-title"><i class="uk-icon uk-icon-envelope"></i> Messages</h3>
      <hr class="uk-panel-divider" />
      <i class="uk-icon uk-icon-plus"></i> <a href="messages.php?a=compose">Send Message</a>
      <hr class="uk-panel-divider" />
      <div class="uk-panel uk-panel-box uk-panel-box-secondary">';
if (!empty($messages)) {
  $output .= '
        <script language="JavaScript">
          function toggle(source) {
            checkboxes = document.getElementsByName(\'deleted[]\');
            for(var i=0, n=checkboxes.length;i<n;i++) {
              checkboxes[i].checked = source.checked;
            }
          }
        </script>
        <form method="post" action="messages.php">
          <span><i class="uk-icon uk-icon-envelope"></i> = Unread</span>
          <table class="uk-table uk-table-hover uk-table-striped uk-text-small">
            <thead>
              <tr>
                <th><input type="checkbox" onClick="toggle(this)" /></th>
                <th>From</th>
                <th>Message</th>
                <th class="uk-text-center">Sent</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($messages as $msg) {
              $output .= '
              <tr class="uk-text-bold">
                <td><input type="checkbox" name="deleted[]" value="'.$msg['message_id'].'" /></td>
                <td>'.($msg['status'] == 0 ? '<i class="uk-icon uk-icon-envelope"></i> ': ' ').getAccountName($msg['sender_id']).'</td>
                <td><strong><a href="messages.php?id='.$msg['message_id'].'">'.$msg['message_body'].'</a></strong></td>
                <td class="uk-text-center">'.date('D M j, Y',$msg['timestamp']).'<br />'.date('g:i a',$msg['timestamp']).'</td>
              </tr>';
            }
            $output .= '
            </tbody>
            <tfoot>
              <tr>
                <td colspan=5>
                <button class="uk-button uk-button-danger">Delete Selected</button>
                </td>
              </tr>
            </tfoot>
          </table>
          <input type="hidden" name="delete" value="1" />
        </form>';
}
else {
  $output .= '
        <span class="uk-text-small">You have no messages</span>';
}
$output .= '
      </div>
    </div>';
?>