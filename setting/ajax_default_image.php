<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);

$target_dir = "../images/";
$target_file = 'utama'.round(microtime(true)) . basename($_FILES["fileToUpload"]["name"]);
$target_dir_file = $target_dir . $target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Fail ini bukan jenis gambar.<br>";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Maaf, Fail tersebut telah wujud.<br>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    echo "Maaf, saiz fail melebihi 2MB.<br>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
&& $imageFileType != "GIF") {
    echo "Maaf, hanya JPG, JPEG, PNG & GIF sahaja dibenarkan.<br>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Maaf, fail tidak berjaya di muat naik.<br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir_file)) {
			$query = "UPDATE " . database_prefix ."_umum SET slide_utama='$target_file' WHERE umum_id=1";
			if(mysqli_query($dbc,$query)){
				echo 'berjaya';
			}
    } else {
        echo "Maaf, ada masalah ketika muat naik. Mungkin fail lebih dari had yang dibenarkan (2MB).<br>";
    }
}
?>
