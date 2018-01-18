<?php
include('./nav.php');

// TODO: Setup the navigation menu, including populating the characters, the tickets, and the messages
if (!empty($_SESSION['auth'])) {
  $output .= '
      <nav class="uk-navbar uk-navbar-attached">
        <ul class="uk-navbar-nav">
            <li class="uk-active"> <a href="index.php"><i class="uk-icon uk-icon-home"></i> Home</a></li>
            <li class="uk-parent" data-uk-dropdown>
              <a href="characters.php"><i class="uk-icon uk-icon-users"></i> Characters <i class="uk-icon-caret-down"></i></a>
              <div class="uk-dropdown uk-dropdown-navbar">
                <ul class="uk-nav uk-nav-navbar">
                    '.($enable_creation ? '<li><a href="create_character.php"><i class="uk-icon uk-icon-plus"></i> Create Character</a></li>
                    <li class="uk-nav-divider"></li>' : '').'
                    <li class="uk-nav-header">CHARACTERS</li>';

  if (!empty($characters)) {
    foreach($characters as $chars) {
      $output .= '
                    <li><a href="characters.php?id='.$chars['charid'].'"><i class="uk-icon uk-icon-user"></i> '.$chars['charname'].'</a></li>';
    }
  }
  else {
    $output .= '<li>No characters</li>';
  }

  $output .= '
                </ul>
              </div>
            </li>
            <li class="uk-parent" data-uk-dropdown>
              <a href=""><i class="uk-icon uk-icon-compass"></i> Regional Info <i class="uk-icon-caret-down"></i></a>
              <div class="uk-dropdown uk-dropdown-navbar">
                <ul class="uk-nav uk-nav-navbar">
                    <li class="uk-nav-header">ONLINE TOTALS</li>
                    <li><a href="#"><i class="uk-icon uk-icon-user"></i> '.onlineCount().' players online</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="regional.php"><i class="uk-icon uk-icon-compass"></i> Region Map</a></li>
                </ul>
              </div>
            </li>
            '.($ah ? '<li> <a href="auctionhouse.html"><i class="uk-icon uk-icon-gavel"></i> Auction House</a></li>' : '').'
            '.($items ? '<li> <a href=""><i class="uk-icon uk-icon-eye"></i> Items</a></li>' : '').'
            '.($bestiary ? '<li> <a href="bestiary.html"><i class="uk-icon uk-icon-crosshairs"></i> Bestiary</a></li>' : '').'
            '.($tickets ? '
            <li class="uk-parent" data-uk-dropdown>
              <a href=""><i class="uk-icon uk-icon-ticket"></i> Support <i class="uk-icon-caret-down"></i></a>
              <div class="uk-dropdown uk-dropdown-navbar">
                <ul class="uk-nav uk-nav-navbar">
                    <li class="uk-nav-header">TICKETS</li>
                    <li><a href="#"><i class="uk-icon uk-icon-ticket"></i> 0 Open Tickets</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#"><i class="uk-icon uk-icon-plus"></i> New Ticket</a></li>
                    <li><a href="#"><i class="uk-icon uk-icon-list"></i> View All Tickets</a></li>
                </ul>
              </div>
            </li>' : '' ).'
        </ul>
        <div class="uk-navbar-flip">
          <ul class="uk-navbar-nav">
            <li class="uk-parent" data-uk-dropdown>
              <a href="messages.php"><i class="uk-icon uk-icon-envelope"></i> Messages <i class="uk-icon-caret-down"></i></a>
              <div class="uk-dropdown uk-dropdown-navbar">
                <ul class="uk-nav uk-nav-navbar">
                    <li><a href="messages.php?a=compose"><i class="uk-icon uk-icon-plus"></i> New Message</a></li>
                    <li class="uk-nav-divider"></li>
                    <li class="uk-nav-header">MESSAGING</li>
                    <li><a href="messages.php"><i class="uk-icon uk-icon-envelope-o"></i> '.getNewMessageCount(getAccountID($_SESSION['auth']['username'])).' new messages</a></li>
                </ul>
              </div>
            </li>
            <li><a href="#friends-list" data-uk-offcanvas><i class="uk-icon uk-icon-heart"></i> Friends</a></li>
          </ul>
        </div>
      </nav>';
}
?>
