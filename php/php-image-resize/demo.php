<?php
include '/src/ImageResize.php';
use \Eventviva\ImageResize;
$image = new ImageResize('image.jpg');
$image->scale(50);
$image->save('image2.jpg');
