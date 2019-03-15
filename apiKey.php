<?php

/*
https://backend.sigfox.com

Sigfox Cloud の Group からグループを選択後、API ACCESSから認証情報を取得しておくこと。
Newで新規作成する際は「DEVICES MANAGER[R]」を設定する。

また、Webサーバーのコンフィグに当ファイルはアクセスさせないようにする事。

apache .htaccessの例

<Files ~ "^apiKey.php$">
    order deny,allow
    deny from all
</Files>

nginxの例

location = ~/apiKey.php {
	deny all;
}

*/

define('DEVICE_ID', '******'); //APIで取得したいデバイスのデバイスID
define('API_LOGIN', '*******************************'); //API ACCESSのlogin
define('API_PASSWORD', '**********************************'); //API ACCESSのpassword
