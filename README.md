# php-slim-base
Webアプリケーション構築初学者向けのPHP(+Slim3)ベースアプリ

## 前提
PHP7以上、MySQLがインストールされていること。Makefileが実行できること。

## DBSetUp
事前に必要なテーブル(users,sample)を作成しておくこと

注：usersは将来変更予定
```
mysql> CREATE TABLE `samples` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data1` text NOT NULL,
  `data2` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

mysql>CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sex` int(11) NOT NULL,
  `birthday` datetime NOT NULL,
  `profile1` text,
  `profile2` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB;
```

## アプリケーションSetUp 
以下の1文でセットアップは完了。Makefile内にてcomposer、npm、bowerを叩いている
```
$ make install
```


## tips
### DB周りの接続設定
app/config.phpにDB接続(MySQL)の設定をすること
```
$ vi app/config.php
```

### BuiltInServerを利用する場合
任意のHOST、PORTを指定して起動
```
$ HOST=xxx.xxx.xxx.xxx PORT=xxxx make server
```

### cacheディレクトリのパーミッション
src/cacheはWebサーバが書き込み可能な状態にすること


