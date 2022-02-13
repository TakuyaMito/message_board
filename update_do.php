<?php
require_once 'dbconnect.php';

try {
  // データベースへの接続を確立
  $db = getDb();
  // UPDATE命令の準備
  $stmt = $db->prepare('UPDATE posts SET title=:title, content=:content WHERE id=:id');
  // 登録するデータをセット
  $stmt->bindParam(':id', $_POST['id']);
  $stmt->bindParam(':title', $_POST['title']);
  $stmt->bindParam(':content', $_POST['content']);
  // UPDATE命令を実行
  $stmt->execute();
  // 処理後は一覧画面ににリダイレクト
  header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php');

} catch(PDOException $e) {
  ide("エラーメッセージ:{$e->getMessage()}");
}