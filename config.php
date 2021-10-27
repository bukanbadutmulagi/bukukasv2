<?php

function classHeader($body){
$headers = array();
$headers[] = 'Host: api.beecash.io';
$headers[] = 'Accept: */*';
$headers[] = 'X-Token: TOKEN MU TARUH DISINI COY';
$headers[] = 'Accept-Language: id';
$headers[] = 'X-Client-Platform: android';
$headers[] = 'X-Client-Version: 0.37.1';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Content-Length: '. strlen($body);
$headers[] = 'Accept-Encoding: gzip';
$headers[] = 'User-Agent: okhttp/4.2.1';
return $headers;
}

function classHeaderb($body){
$headers = array();
$headers[] = 'Host: api.beecash.io';
$headers[] = 'Accept: */*';
$headers[] = 'X-Token: TOKEN MU TARUH DISINI COY';
$headers[] = 'Accept-Language: id';
$headers[] = 'X-Client-Platform: android';
$headers[] = 'X-Client-Version: 0.37.1';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Content-Length: '. strlen($body);
$headers[] = 'Accept-Encoding: gzip';
$headers[] = 'User-Agent: okhttp/4.2.1';
return $headers;
}

function net($body,$headers)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.beecash.io/graphql');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
return $result;
}
