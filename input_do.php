<?php
require_once 'dbconnect.php';
require_once 'encode.php';

try {
  // データベースへの接続を確立
  $db = getDb();
  // INSERT命令の準備
  $date = new DateTime('now');
  $stmt = $db->prepare('INSERT INTO posts(title, content) VALUES(:title, :content)');
  // 登録するデータをセット
  $stmt->bindValue(':title', $_POST['title']);
  $stmt->bindValue(':content', $_POST['content']);
  // INSERT命令を実行
  $stmt->execute();
  // 処理後は一覧画面ににリダイレクト
  header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php');

} catch(PDOException $e) {
  ide("エラーメッセージ:{$e->getMessage()}");
}
?>