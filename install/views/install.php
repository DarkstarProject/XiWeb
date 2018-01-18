<?php
if (isset($complete)) {
  $content .= '
    <br />
    <div class="uk-alert uk-alert-success uk-align-center uk-width-1-2"><i class="uk-icon uk-icon-check"></i> Your XIWeb installation has completed:
    Click <a href="../index.php">here</a> to view your site.     
    </div>';
}
else {
  $content .= '
  <body>
  <br />';
  if (!empty($_SESSION['errors']['install'])) {
    $content .= '
    <div class="uk-alert uk-alert-danger uk-align-center uk-width-1-2"><i class="uk-icon uk-icon-times"></i> Please correct the following errors:
      <ul>';
    foreach ($_SESSION['errors']['install'] as $error) {
      $content .= ' 
        <li>'.$error.'</li>';
    }
    $content .= '
      </ul>
    </div>';
  }
  $content .= '
    <br />
    <div class="uk-panel uk-panel-box uk-align-center uk-width-1-2">
      <h3 class="uk-panel-title"><i class="uk-icon uk-icon-check"></i> Initial Checks</h3>
      <hr class="uk-panel-divider" />
      <div>Checking for existing installation '.(!defined('INSTALLED') ? '<span class="uk-text-success"><i class="uk-icon uk-icon-check"></i> Ok</span>' : '<span class="uk-text-danger"><i class="uk-icon uk-icon-times"></i> XIWeb already installed</span>').'</div>
      <div>Checking for \'config.php\' '.(file_exists('../config.php') ? '<span class="uk-text-success"><i class="uk-icon uk-icon-check"></i> Ok</span>' : '<span class="uk-text-danger"><i class="uk-icon uk-icon-times"></i> config.php file is missing</span>').'</div>
      <div>Checking write permissions for \'config.php\' '.(is_writeable('../config.php') ? '<span class="uk-text-success"><i class="uk-icon uk-icon-check"></i> File \'config.php\' is writeable</span>' :'<span class="uk-text-danger"><i class="uk-icon uk-icon-times"></i> File \'config.php\' is not writeable</span>').'</div>
      '.(!empty($_SESSION['errors']['install']) ? '<a href="index.php"><button class="uk-button uk-button-secondary">Recheck</button></a>' : '').'
    </div>
    <br />';
    if (empty($_SESSION['errors']['setup']['checked'])) {
      $content .= '
    <div class="uk-panel uk-panel-box uk-align-center uk-width-1-2">
      <h3 class="uk-panel-title"><i class="uk-icon uk-icon-server"></i> Database Configuration</h3>
      <hr class="uk-panel-divider" />
      <form class="uk-form uk-form-horizontal" method="post" action="index.php">
        <div class="uk-form-row">
          <label class="uk-form-label">Database Server:</label>
          <div class="uk-form-controls"><input type="text" name="host" placeholder="server address" '.(!empty($host) ? 'value='.$host.'' : '').' '.(!empty($_SESSION['errors']['install']['missing_host']) ? 'class="uk-form-danger"' : '').' />
            <span class="uk-form-inline-help uk-text-danger">Required</span>
          </div>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label">Server Port:</label>
          <div class="uk-form-controls"><input type="text" name="port" placeholder="server port" '.(!empty($port) ? 'value='.$port.'' : '').' /></div>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label">Database User:</label>
          <div class="uk-form-controls"><input type="text" name="user" placeholder="database user"  '.(!empty($user) ? 'value='.$user.'' : '').'  '.(!empty($_SESSION['errors']['install']['missing_user']) ? 'class="uk-form-danger"' : '').' /></div>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label">Database Password:</label>
          <div class="uk-form-controls"><input type="password" name="password" placeholder="database password"  '.(!empty($password) ? 'value='.$password.'' : '').'  '.(!empty($_SESSION['errors']['install']['missing_password']) ? 'class="uk-form-danger"' : '').' /></div>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label">Database Name:</label>
          <div class="uk-form-controls"><input type="text" name="database" placeholder="database name"  '.(!empty($database) ? 'value='.$database.'' : '').'  '.(!empty($_SESSION['errors']['install']['missing_database']) ? 'class="uk-form-danger"' : '').' />
            <span class="uk-form-inline-help uk-text-danger">Invalid database name</span>
          </div>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label">XI Database Name:</label>
          <div class="uk-form-controls"><input type="text" name="xi_database" '.(!empty($xi_database) ? 'value='.$xi_database.'' : '').' placeholder="xi database name" '.(!empty($_SESSION['errors']['install']['missing_xidatabase']) ? 'class="uk-form-danger"' : '').' />
            <span class="uk-form-inline-help uk-text-danger">Invalid database name</span>
          </div>
        </div>
        <br />
        <h3 class="uk-panel-title"><i class="uk-icon uk-icon-edit"></i> XIWeb Configuration</h3>
        <form class="uk-form uk-form-horizontal" method="post" action="index.php">
        <hr class="uk-panel-divider" />
          <div class="uk-form-row">
            <label class="uk-form-label">Server Name:</label>
            <div class="uk-form-controls"><input type="text" placeholder="server name" name="servername" '.(!empty($servername) ? 'value='.$servername.'' : '').'  '.(!empty($_SESSION['errors']['install']['missing_servername']) ? 'class="uk-form-danger"' : '').' />
              <span class="uk-form-inline-help uk-text-danger">Required</span>
            </div>
          </div>
          <div class="uk-form-row">
            <label class="uk-form-label">DSP Server Address:</label>
            <div class="uk-form-controls"><input type="text" placeholder="server address" name="serveraddress" '.(!empty($serveraddress) ? 'value='.$serveraddress.'' : '').'  '.(!empty($_SESSION['errors']['install']['missing_serveraddress']) ? 'class="uk-form-danger"' : '').' />
              <span class="uk-form-inline-help uk-text-danger">Required</span>
            </div>
          </div>
          <div class="uk-form-row">
            <label class="uk-form-label">Allow Account Registration:</label>
            <div class="uk-form-controls"><input type="checkbox" name="allow_registration" '.(!empty($allow_registration) ? 'checked' : '').' /></div>
          </div>
          <div class="uk-form-row">
            <label class="uk-form-label">Allow Character Creation:</label>
            <div class="uk-form-controls"><input type="checkbox" name="allow_creation" '.(!empty($allow_creation) ? 'checked' : '').' /></div>
          </div>
          <div class="uk-form-row">
            <label class="uk-form-label">Language:</label>
            <div class="uk-form-controls">
              <select>
                <option selected>English</option>
                <option>Spanish</option>
                <option>Russian</option>
              </select>
            </div>
          </div>
          <div class="uk-form-row">
            <label class="uk-form-label">Theme:</label>
            <div class="uk-form-controls">
              <select>
                <option selected>Default</option>
                <option>All Black</option>
                <option>All White</option>
              </select>
            </div>
          </div>
          <div class="uk-form-row">
            <input type="hidden" name="install" value=1" />
            <button type="submit" class="uk-button uk-button-secondary">Complete Installation</button>
          </div>
        </form>
    </div>
  </body>';
    }
}
?>