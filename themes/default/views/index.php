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
      <h3 class="uk-panel-title"><i class="uk-icon uk-icon-globe"></i> Welcome</h3>
      <hr class="uk-panel-divider" />
      <article class="uk-article">
        <h1 class="uk-article-title">'.$frontpage_title.'</h1>
        '.$frontpage_message.'
      </article>
';

if (!empty($news)) {
  foreach ($news as $nw) {
    switch ($nw['type']) {
      case '1':
        $icon = 'info-circle';
        break;
      case '2':
        $icon = 'server';
        break;
      default:
        $icon = 'info-circle';
    }
    
    $output .= ' 
     <br />
      <div class="uk-panel uk-panel-box uk-panel-box-secondary">
        <h3 class="uk-panel-title"><i class="uk-icon uk-icon-'.$icon.'"></i> '.$nw['title'].'</h3>
        <span class="uk-text-small uk-text-muted">Written by '.$nw['poster'].' on '.date('m/d/Y',$nw['post_date']).'</span>
        <hr class="uk-panel-divider" />
        '.$nw['body'].'
      </div>
    ';
  }
}
$friends_list = getFriendsList(getAccountID($_SESSION['auth']['username']));
$friend_requests = getFriendRequests(getAccountID($_SESSION['auth']['username']));

var_dump($friends_list);
$output .= '
      <!-- This is the off-canvas sidebar -->
      <div id="friends-list" class="uk-offcanvas">
        <div class="uk-offcanvas-bar uk-offcanvas-bar-flip">
        <div class="uk-panel">
          <h3 class="uk-panel-title">Online Friends ('.sizeof($friends_list).')</h3>
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
          <h3 class="uk-panel-title">Friend Requests ('.sizeof($friend_requests).')</h3>
        </div>
      </div>';
?>