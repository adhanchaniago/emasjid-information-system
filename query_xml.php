<?php
if(isset($_GET['zon'])){
$zon = $_GET['zon'];
rss_feed($zon);
}

function httpPost($zon='KDH02')
{
  $zon = $_GET['zon'];
  $qry_str = "?zon=".$zon;
  $ch = curl_init();

  // Set query data here with the URL
  curl_setopt($ch, CURLOPT_URL, 'http://www2.e-solat.gov.my/xml/today/'.$qry_str);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 3);
  $content = (curl_exec($ch));
  curl_close($ch);
  return $content;
}

function rss_feed($zon='KDH02'){
  $xmlDoc = new DOMDocument();
$xmlDoc->load('http://www2.e-solat.gov.my/xml/today/?zon='.$zon);
$arr = array();

//get elements from "<channel>"
/*
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;

//output elements from "<channel>"
echo("<p><a href='" . $channel_link . "'>" . $channel_title . "</a>");
echo("<br>");
echo($channel_desc . "</p>");
*/
//get and output "<item>" elements
$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<=6; $i++) {
  $item_title=$x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
  /*
  echo ("<p><a href='" . "'>" . $item_title . "</a>");
  echo ("<br>");
  echo ($item_desc . "</p>");
  */
  $arr[$item_title] = $item_desc;

}
//$arr = array($a[0]=>$b[0], $a[1]=>$b[1], $a[2]=>$b[2], $a[3]=>$b[3], $a[4]=>$b[4], $a[5]=>$b[5], $a[6]=>$b[6]);
echo json_encode($arr);
}
