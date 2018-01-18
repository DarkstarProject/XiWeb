<?php
$output = '
<html>
  <head>
    <title>XIWeb - '.$site_name.'</title>
    <link type="text/css" rel="stylesheet" href="themes/default/css/uikit.gradient.css" media="all" />
    <link type="text/css" rel="stylesheet" href="themes/default/css/components/progress.css" media="all" />
    <link type="text/css" rel="stylesheet" href="themes/default/css/components/form-password.css" media="all" />
    <link type="text/css" rel="stylesheet" href="themes/default/css/regionmap.css" media="all" />
    <script src="themes/default/js/jquery.js"></script>
    <script src="themes/default/js/uikit.min.js"></script>
    <script src="themes/default/js/components/form-password.js"></script>
  </head>
  <body>
    <div class="uk-grid">
      <div  class="uk-width-1-2" style="background-color: #d8d8d8; border-bottom: 1px solid #c0c0c0; color: #444444; height: 20px;" class="uk-text-left">Server Status: '.(serverStatus() == '1' ? '<i class="uk-icon uk-icon-circle uk-text-success"></i> Online <em class="uk-text-small uk-text-muted">('.getServerUptime().')</em>' : '<i class="uk-icon uk-icon-circle uk-text-danger"></i> Offline').' Server Address: <em class="uk-text-muted">'. $server_address.'</em></div>
      <div class="uk-width-1-2 uk-text-right" style="background-color: #d8d8d8; border-bottom: 1px solid #c0c0c0; color: #444444; height: 20px;">'.(!empty($_SESSION['auth']) ? 'Welcome back, '.getAccountName(getAccountId($_SESSION['auth']['username'])).'. [<i class="uk-icon uk-icon-cog"></i> Account | <i class="uk-icon uk-icon-sign-out"></i> Logout]&nbsp;&nbsp;' : '').'</div>
    </div>
    <div style="height: 200px; border-bottom: 1px solid rgba(0, 0, 0, 0.3);"><img src="themes/default/images/banner.png" style="height: 100%; width: 100%; position: top center;"></div>';

?>
