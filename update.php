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

    <title>掲示板の更新</title>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
      <a href="index.php" class="navbar-brand">掲示板</a>
      <a href="input.php" class="navbar-brand text-right">投稿する</a>
    </nav>
    <?php
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
      $id = $_GET['id'];
      try {
        // データベースへ接続
        $db = getDb();
        // SELECT命令の実行
        $stmt = $db->prepare('SELECT * FROM posts WHERE id=?');
        $stmt->execute(array($id));
        $row = $stmt->fetch();
      } catch(PDOException $e) {
        die("エラーメッセージ: {$e->getMessage()}");
      }
    }
    ?>

    <div class="container">
      <div class="mt-4"></div>
      <h2 class="text-center">掲示板更新</h2>
      <form method="POST" action="update_do.php">
        <div class="form-group">
          <input type="hidden" name="id" value="<?php echo e($id); ?>">
          <label for="title">タイトル</label>
          <input type="text" id="title" name="title" class="form-control" value="<?php echo e($row['title']); ?>">
        </div>
        <div class="form-group">
          <label for="content">本文</label>
          <textarea class="form-control" id="content" name="content" rows="3"><?php echo e($row['content']); ?></textarea>
        </div>

        <input type="submit" class="btn btn-primary" value="送信">
      </form>
      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>