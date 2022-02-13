<?php
require_once 'dbconnect.php';
require_once 'encode.php';
?>
<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>掲示板詳細</title>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
      <a href="index.php" class="navbar-brand">掲示板</a>
      <a href="input.php" class="navbar-brand text-right">投稿する</a>
    </nav>
    <?php 
      // idが数字かチェック
      $id = $_GET['id'];
      if(!is_numeric($id) || $id <= 0) {
        echo('1以上の数字で入力してください');
        exit();
      }
    ?>
    <div class="container">
      <div class="mt-4"></div>
      <div class="card">
        <?php
        try {
          // データベースへ接続
          $db = getDb();
          // SELECT命令の実行
          $stmt = $db->prepare('SELECT * FROM posts WHERE id=?');
          $stmt->execute(array($_GET['id']));
          $row = $stmt->fetch();
        ?>
          <div class="card-header">
            <h5><?php echo e($row['title']); ?></h5>
          </div>
          <div class="card-body">
            <div class="card-title">
              <h5><?php echo e($row['content']); ?></h5>
            </div>
            <p class="card-text"><?php echo e($row['created_at']); ?></p>
            <a href="index.php">戻る</a>
            <div class="text-right">
              <button type="button" class="btn btn-primary" onclick="location.href='update.php?id=<?php echo e($row['id']); ?>'">更新する</button>
              <button type="button" class="btn btn-secondary" onclick="location.href='delete.php?id=<?php echo e($row['id']); ?>'">削除する</button>
            </div>
          </div>
        <?php
        } catch(PDOException $e) {
          die("エラーメッセージ: {$e->getMessage()}");
        }
        ?>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>