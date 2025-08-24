<?php phpinfo(); ?>
<?php
$url = "https://api.razorpay.com/v1/orders";
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "❌ cURL error: " . curl_error($ch);
} else {
    echo "✅ SSL works! Response length: " . strlen($response);
}

curl_close($ch);
?>
<?php
var_dump(curl_version()['ssl_version']);
var_dump(ini_get("curl.cainfo"));
var_dump(ini_get("openssl.cafile"));
?>