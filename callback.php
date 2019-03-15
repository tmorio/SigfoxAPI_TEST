<?php
//ファイル待ち受け(本番環境であれば、必ずこの後にデータの検証を行う事。
$json_string = file_get_contents('php://input');

//連想配列型でJsonデコード
$data = json_decode($json_string, true);

//日時でファイル名を生成
$fileName = date('Y-m-d H:i:s', time()) . ".json";

$fileInfo = fopen($fileName, 'w+'); //書き込みモードでファイル作成しファイルを開く
fwrite($fileInfo, json_encode($data)); //Json書き込み
fclose($fileInfo); //ファイル閉じる
