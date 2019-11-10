<?php
require('../config/config.inc.php');
require(MYSQL);

if(isset($_POST['slider_get']) && $_POST['slider_get']=='0'){
$sql = "SELECT * FROM `" . database_prefix ."_slider` WHERE `paparkan`='1'";
$result = mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) > 0) { //pernah memohon kursus. ada rekod
  ?>
  <div class="carousel-item active" style="background-image: url('images/default.png')">
    <div class="carousel-caption d-none d-md-block">
      <h3></h3>
      <p></p>
    </div>
  </div>
  <?php
  while($row = mysqli_fetch_assoc($result)) {
    ?>
<div class="carousel-item" style="background-image: url('images/<?php echo $row['url'];?>')">
      <div class="carousel-caption d-none d-md-block">
        <h3><?php //echo 'Second Slide';?></h3>
        <p><?php //echo 'This is a description for the second slide.';?></p>
    </div>
  </div>
        <?php
  }
  $sql = "UPDATE " . database_prefix ."_status SET `slider`='0' WHERE `status_id`='1'";
  $result = mysqli_query($dbc, $sql);
}else {
  echo '<div class="carousel-item active" style="background-image: url(\'images/default.png\')">
    <div class="carousel-caption d-none d-md-block">
      <h3></h3>
      <p></p>
    </div>
  </div>';
}
}else {
  echo 'failed';
}
?>
