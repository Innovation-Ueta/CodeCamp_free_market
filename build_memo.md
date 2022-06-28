https://www.engilaboo.com/how-to-use-docker-for-laravel/


https://laraweb.net/environment/8652/


# ファイル役割
**php.ini**
PHPの設定ファイル
[php.iniの設定項目一覧](https://www.xfree.ne.jp/manual/man_server_phpini_setting_item.php)

内容
- [Date]でタイムゾーンを日本時間に設定
- [mbstring]は文字コードの設定
    - mbstring.languageでは言語を日本語に設定
    - mbstring.internal_encodingでは内部文字エンコーディングを設定
- opcacheとは、ものすごく簡単に言うと、PHPの処理を高速にする手法


**default.conf**
Nginxの設定ファイル

内容
- {}で囲まれた部分はコンテキストと言います。この{}で囲まれた部分がモジュール・ディレクティブが作るスコープの範囲を表しています。
- rootは、ドキュメントルート（サーバの公開ディレクトリ）を指定している
    - [注意]Laravelの場合は、publicディレクトリのindex.phpに全HTTPリクエストが集まるようになってるため、ここをきちんと指定できていなかったら、そもそも何も表示されません  
- listenではポート番号を指定（Webサーバーは、大抵の場合80番)
- indexは、インデックスとして使われるファイルを指定（今回の場合は、リクエストがきたら/var/www/laravel-project/public/index.phpをレスポンスとして返します。）
- locationでは、それぞれのurlに対するrootを指定
- fastcgi_passでは、Nginxがリクエストを流すPHPコンテナのサービス名（docker-compose.ymlに設定してあるやつ）とポート番号を指定
    - 今回の場合だと、Nginxの80番portにアクセスしたら、php-laravelコンテナの9000ポート（php-fpmのデフォルトポート番号）にproxyするように設定してあります。

