<?php

header('Content-Type: application/json');

$apikey = $_GET['key'];
$fromnum = $_GET['from'];
$message = $_GET['msg'];
$to = $_GET['to'];

$ch = curl_init ("https://www.anveo.com/api/v1.asp?apikey=".$apikey."&action=sms&destination=".$to."&from=".$fromnum."&message=".urlencode($message));
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$chh = curl_init ("https://www.anveo.com/api/v2.asp?userkey=".$apikey."&action=ACCOUNT.GETBALANCE");
curl_setopt($chh, CURLOPT_TIMEOUT, 10);
curl_setopt($chh, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($chh, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chh, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($chh, CURLOPT_SSL_VERIFYPEER, false);
$rzlt = curl_exec($chh);
curl_close($chh);
$Balance = explode("<RESULT>", $rzlt);
$Balance = explode("</RESULT>", $Balance[1]);
$RemainingMessagesCount = $Balance[0] / 0.010; # For USA Sending SMS
$RemainingMessagesCount = intval($RemainingMessagesCount);

if (strpos($result, 'result=error') !== false) {
	echo '{"Status":"0", "Key":"'.$apikey.'", "RemainingMessages":"'.$RemainingMessagesCount.'"}';
} else {
    echo '{"Status":"1", "Key":"'.$apikey.'", "RemainingMessages":"'.$RemainingMessagesCount.'"}';
}

?>
