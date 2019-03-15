<?php

require_once('./apiKey.php');

$apiServer = 'https://backend.sigfox.com/api/devices/' . DEVICE_ID . '/messages';
$curl = curl_init();
$login = API_LOGIN;
$pass = API_PASSWORD;
curl_setopt($curl, CURLOPT_URL, $apiServer);
curl_setopt($curl, CURLOPT_HTTPGET, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_USERPWD,"$login:$pass");
$data  = curl_exec ($curl);
curl_close($curl);

//JSONデコード
$data = json_decode($data, true);

echo "<h1>Sigfox APIのテスト</h1>";

echo "<h2>リクエスト情報</h2>";
echo "URL&nbsp;:&nbsp;" . $apiServer . "<br>";
echo "取得対象デバイスのID (Device ID)&nbsp;:&nbsp;" . DEVICE_ID . "<br>";

echo "<h2>直近3件のデータ</h2>";
//直近3件の値を出力
echo "------------直近1件目-----------" . "<br>";
echo "UNIX時間:";
echo $data['data'][0]['time'] . "<br>";
echo "センサ値:";
echo $data['data'][0]['data'] . "<br><br>";

echo "------------直近2件目-----------" . "<br>";
echo "UNIX時間:";
echo $data['data'][1]['time'] . "<br>";
echo "センサ値:";
echo $data['data'][1]['data'] . "<br><br>";

echo "------------直近3件目-----------" . "<br>";
echo "UNIX時間:";
echo $data['data'][2]['time'] . "<br>";
echo "センサ値:";
echo $data['data'][2]['data'] . "<br><br>";

echo "<h2>APIから返ってきたJSONの中身</h2>";

//JSONの中身を出力
echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>