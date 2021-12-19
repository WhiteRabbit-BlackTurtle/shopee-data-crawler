<?php

function fill_options($arr, $default) {
  foreach($arr as $val) {
    echo '<option value = \'' . $val . '\'';
    if ($val == $default) echo ' selected';
    echo '>' . $val . '</option>';
  }
}

function checkSunday($sel_month, $day) {
  return date('w', strtotime($sel_month . '-' . sprintf("%02d", $day))) == 0 ? true : false;
}


?>