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

    <title>掲示板一覧</title>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
      <a href="index.php" class="navbar-brand">掲示板</a>
      <a href="input.php" class="navbar-brand text-right">投稿する</a>
    </nav>
    <div class="container">
      <div class="mt-4"></div>
      <table class="table">
        <thead>
          <tr>
            <th>タイトル</th><th>本文</th><th>投稿日時</th>
          </tr>
        </thead>
        <?php
        try {
          // データベースへ接続
          $db = getDb();
          // SELECT命令の実行
          $stmt = $db->prepare('SELECT * FROM posts ORDER BY created_at DESC');
          $stmt->execute();
          // 結果セットの内容を順に出力
          $stmt->setFetchMode(PDO::FETCH_ASSOC);
          foreach($stmt as $row) {    
        ?>
          <tr>
            <td>
              <a href="show.php?id=<?php echo e($row['id']); ?>"><?php echo e($row['title']); ?></a>
            </td>
            <td><?php echo e($row['content']); ?></td>
            <td><?php echo e($row['created_at']); ?></td>
          </tr>
        <?php
          }
        } catch(PDOException $e) {
          die("エラーメッセージ: {$e->getMessage()}");
        }
        ?>
      </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>