# SigfoxAPI_TEST
Sigfox Cloud APIなどを叩いて情報を得るコードです

## 使い方

### こちらからAPIを叩く場合
1. apiKey.phpファイルに、「情報を取得したいデバイスのDeviceID」、「API login」、「API Password」を*のところに記入してください。  
2. apiKey.phpファイルが外部からアクセスできないように、Webサーバーの設定等を行なってください(やらないとAPIキーが漏れます)  

#### apache(.htaccess)の例

```
<Files ~ "(apiKey\.php)">
deny from all
</Files>
```

#### nginxの例

```
location = (ここにファイルまでのパス)/apiKey.php {
	deny all;
}
```

3. 「apiKey.php」と「getInfo.php」をドキュメントルートなどに配置します。(2つのファイルは、同じディレクトリに配置してください)  
4. ブラウザからgetInfo.phpにアクセスすると、直近3件のメッセージとAPIサーバーから返されたJsonデータが表示されます。

### Sigfox CloudからデータをCallbackしてもらう場合

1. ドキュメントルートに「callback.php」を配置します。  
2. [Sigfox Cloud](https://backend.sigfox.com)の「DEVICE TYPE」で「Name」を選択後、左のメニューから「CALLBACKS」を選択します。  
3. 右上にある「New」を選択後、「Custom callback」を選択。  
4. Typeを「DATA」「UPLINK」、Channelを「URL」、Url patternに先ほど設置したcallback.phpまでのURL、User HTTP Methodを「POST」、Content typeに「application/json」と入力。
5. Bodyに以下をコピペして下の「OK」を押します。  
```
{
  "device":"{device}",
  "data":"{data}",
  "time":"{time}"
}
```
6. デバイスから値を送信してあげます。  
7. callback.phpを配置したディレクトリに「日時.json」で取得した情報が保存されます。
