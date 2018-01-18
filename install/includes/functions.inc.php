<?php

function dump_errors($errors) {
  $e = '<div class="uk-alert uk-alert-danger uk-align-center uk-width-1-2">';
  $e .= lang_error('errors_exist');
  $e .= '<ul>';
  
  foreach ($errors as $value) {
    $e .= "<li>$value</li>";
  }

  $e .= "</ul>";
  $e .= '</div>';
  return $e;
}

?>