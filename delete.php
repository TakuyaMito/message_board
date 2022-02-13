<?php
require_once 'dbconnect.php';

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  try {
    $db = getDb();
    $stmt = $db->prepare('DELETE FROM posts WHERE id=?');
    $stmt->execute(array($id));
    // 一覧画面にリダイレクト
    header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php');
  } catch(PDOException $e) {
    ide("エラーメッセージ:{$e->getMessage()}");
  }
}
