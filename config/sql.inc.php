<?php
//maklumat database. Sila ubah mengikut setting anda
DEFINE ('DB_USER', 'root');         //database user
DEFINE ('DB_PASSWORD', '');         // database password
DEFINE ('DB_HOST', 'localhost');    //database host
DEFINE ('DB_NAME', 'masjid');       //database nama

// sambungan ke database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

mysqli_set_charset($dbc, 'utf8');

function escape_data($data, $dbc){
if(get_magic_quotes_gpc()) $data = stripslashes($data);
return mysqli_real_escape_string($dbc, trim($data));
}
 ?>