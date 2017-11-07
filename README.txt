フィルタリングをかけて特定のツイートを取得する。
ボット対策のため、1日前のツイートと同じツイートがされていないか探し、同じツイートがあったら空白にする。
顔文字含む日本語のテキストファイルのためと、mysqlの仕様上　複数のステージを踏んでいる。

cronapp.php
cronsite.php
cronsys.php
cronservise.php

の各includeを消去し、
サーバにおいて
cronを
cronapp.php
cronsite.php
cronsys.php
cronservise.php
optimize_app.php
optimize_service.php
optimize_sys.php
optimize_site.phpに設定する
