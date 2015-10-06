<?php
include('./RaiseNowSignature.php');

$algorithm = "sha256";
$secret = "secretyoumustbe";

$signature = new RaiseNowSignature($secret, $algorithm);
$hmac = $signature->signData($_GET);

$validationResult = ($hmac === $_GET['response_hmac'])? 'passed' : 'failed';


echo "<h1>HMAC Validation: " . $validationResult ."</h1>";
echo "</p>returned hmac: " .$_GET['response_hmac'];
echo "<br />calculated hmac: " .$hmac ."</p>";

echo "<br /><p>Payment Response:";
foreach ($_GET as $name => $value) {
    echo "<br />" .$name .": " .$value;
}
echo "</p>";

?>
