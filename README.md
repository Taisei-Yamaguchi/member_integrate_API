# member_integrate_API
snackとchatのメンバー情報をつなぐAPI
・.envファイルにpublic IDとsecret Keyを加える。それにより、configに設定したものが利用できるようになり、APIリクエストに認証機能を加えられる。
<br>
・本番環境では、.envのdb名,public_ID,Secret_key、Modelsのdb名、を変更する。
<br>
・APIリクエスト側で、requestの際のpublic ID,secretkey,url、画像ファイルダウンロード先を変更。
