<?php

require_once('./apiKey.php');

$apiServer = 'https://api.sigfox.com/v2/devices/' . DEVICE_ID . '/messages';
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
if(!empty($data['data'][0]['time'])){
	echo "UNIX時間(ms単位):";
	echo $data['data'][0]['time'] . "<br>";
	echo "センサ値:";
	echo $data['data'][0]['data'];
}else{
	echo "データがありません。apiKey.phpの記入ミスやSigfox CloudのAPIの設定、または、MESSAGESが正しく送信されているかご確認下さい。";
}

echo "<br><br>";

echo "------------直近2件目-----------" . "<br>";
if(!empty($data['data'][1]['time'])){
	echo "UNIX時間(ms単位):";
	echo $data['data'][1]['time'] . "<br>";
	echo "センサ値:";
	echo $data['data'][1]['data'];
}else{
	echo "データがありません。1件目が正しく表示されている場合は、データ数が少ない事が理由です。";
}

echo "<br><br>";

echo "------------直近3件目-----------" . "<br>";
if(!empty($data['data'][2]['time'])){
	echo "UNIX時間(ms単位):";
	echo $data['data'][2]['time'] . "<br>";
	echo "センサ値:";
	echo $data['data'][2]['data'];
}else{
	echo "データがありません。1件目が正しく表示されている場合は、データ数が少ない事が理由です。";
}

echo "<br><br>";

echo "<h2>APIから返ってきたJSONの中身</h2>";

//JSONの中身を出力
var_dump($data);
//echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>
