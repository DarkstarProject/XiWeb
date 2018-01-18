<?php

function dump_errors($errors) {
  $e = lang('errors_exist');
  $e .= "<ul>";
  
  foreach ($errors as $value) {
    $e .= "<li>$value</li>";
  }

  $e .= "</ul>";
  return $e;
}

?>