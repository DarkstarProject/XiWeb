<?php

$lang = array();

// Authentication errors
$lang['error']['auth'] = array(
  'empty_username' => 'You must supply a username or email address',
  'empty_password' => 'You must supply a password',
  'invalid_login' => 'The username or password combination you supplied is incorrect'
);

// Account registration errors
$lang['error']['register'] = array(
  'empty_username' => 'You must supply a username',
  'empty_email' => 'You must supply an e-mail address',
  'empty_password' => 'You must supply a password',
  'empty_conf_password' => 'You must confirm your password',
  'password_mismatch' => 'The passwords you supplied do not match',
  'password_too_short' => 'The password supplied is too short. It must be between 8 and 16 characters',
  'password_too_long' => 'The password supplied is too long. It must be between 8 and 16 characters',
  'invalid_email_format' => 'The email address you specified is not in the correct format',
  'username_taken' => 'The username you supplied is already taken. Please try another one',
  'email_taken' => 'The email address you supplied is already in use'
);

// Character creation errors
$lang['error']['create_character'] = array(
  'empty_charname' => 'You must specify a character name',
  'empty_race' => 'You must specify a race',
  'empty_face' => 'You must specify a face type',
  'empty_hair' => 'You must specify a hair type',
  'empty_size' => 'You must specify a size',
  'empty_job' => 'You must specify a job',
  'empty_gender' => 'You must specify a gender',
  'empty_nation' => 'You must specify your home nation',
  'charname_toolong' => 'Your character name is too long (Must be 16 characters or less characters)',
  'charname_reserved' => 'That character name is forbidden or reserved',
  'charname_invalid' => 'Character names must only contain alpabetics',
  'character_exists' => 'That character name is already in use',
  'creation_error' => 'Unable to create character'
);

// General page errors
$lang['error']['general'] = array(
  'error_message' => 'Please correct the following errors:',
  'field_required' => 'This is a required field',
);


// Configuration file errors
$lang['error']['config'] = array(
  'missing_config' => 'Your config.php is missing, or is not readable.'
);

// Installation errors
$lang['error']['install'] = array(
  'not_installed' => 'XIWeb does not appear to be installed. Please run setup.',
  'xiweb_installed' => 'XIWeb appears to already be installed. Please remove the /install/ directory from your webroot.',
  'missing_database' => 'Your DSP database cannot be left blank.',
  'missing_xidatabase' => 'Your XIWeb database cannot be left blank.',
  'missing_user' => 'Your MySQL username cannot be left blank.',
  'missing_password' => 'Your MySQL password cannot be left blank.',
  'missing_host' => 'Your MySQL hostname cannot be left blank.',
  'missing_servername' => 'Your DSP Server name cannot be left blank.',
  'missing_serveraddress' => 'Your DSP server address cannot be left blank.'
);

$lang['text']['general'] = array(
  'unavailable' => 'Not Available',
    'ok' => 'OK',
);

$lang['error']['character'] = array(
  'no_access' => 'You do not have access to view this character, or the owner has not made this profile public.'
);