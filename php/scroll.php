<?php
require('../config/config.inc.php');
require(MYSQL);
$text = '';
if(isset($_POST['scroll_get']) && $_POST['scroll_get']=='0'){
  $sql = "SELECT `text` FROM `" . database_prefix ."_scroll` WHERE `paparkan`='1'";
  $result = mysqli_query($dbc, $sql);
  if (mysqli_num_rows($result) > 0) { //pernah memohon kursus. ada rekod

    while($row = mysqli_fetch_assoc($result)) {
    //  for ($x = 0; $x <= 15; $x++) {
    //    $text .= '&nbsp;';
    //  }
    $text .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      $text .= $row['text'];

    }
    $sql = "UPDATE " . database_prefix ."_status SET `scroll`='0' WHERE `status_id`='1'";
    $result = mysqli_query($dbc, $sql);
  }
  echo $text;
}else {
  echo 'failed';
}
?>
