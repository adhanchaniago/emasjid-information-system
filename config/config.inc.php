<?php
if(!defined('LIVE')) DEFINE('LIVE', false);

//sila ubah di tiga bari di bawah ini sahaja

DEFINE('CONTACT_EMAIL', 'example@email.com');       //sila ubah mengikut kesesuaian
define ('BASE_URL', 'localhost/masjid/');           //sila ubah mengikut kesesuaian
define ('BASE_URI', 'C:/xampp/htdocs/emasjid_digital');      //sila ubah mengikut kesesuaian

//jangan ubah code di baris di bawah jika anda tidak tahu apa yang anda inginkan.

define ('MYSQL', BASE_URI . '/config/sql.inc.php');

define ('database_prefix', 'masjid');

date_default_timezone_set("Asia/Kuala_Lumpur");

 // checking $protocol in HTTP or HTTPS
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            // this is HTTPS
            $protocol  = "https";
        } else {
            // this is HTTP
            $protocol  = "http";
        }
$home_url = $protocol .'://'. BASE_URL;

session_start();

function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars){
  $message = "Error telah berlaku pada script '$e_file' di baris '$e_line' :
  \n$e_message\n";
  $message .="<pre>" .print_r(debug_backtrace(), 1) . "</pre>\n";

  if(!LIVE){
    echo '<div class="alert alert-danger">' . nl2br($message) . '</div>';
  }else{
    error_log($message,1,CONTACT_EMAIL,'From:mohamad.arfakhsy13@gmail.com');
    if($e_number != E_NOTICE){
      echo '<div class="alert alert-danger">A system error terjadi. Maaf atas kesulitan.</div>';
    }
  }
}

set_error_handler('my_error_handler');

// ************ REDIRECT FUNCTION ************ //

// This function redirects invalid users.
// It takes two arguments:
// - The session element to check
// - The destination to where the user will be redirected.
function redirect_invalid_user($check = 'user_id', $destination = 'index.php', $protocol = 'http://') {

	// Check for the session item:
	if (!isset($_SESSION[$check])) {
		$url = $protocol . BASE_URL . $destination; // Define the URL.
		header("Location: $url");
		exit(); // Quit the script.
	}

} // End of redirect_invalid_user() function.

// ************ REDIRECT FUNCTION ************ //
// ******************************************* //

// Omit the closing PHP tag to avoid 'headers already sent' errors!
