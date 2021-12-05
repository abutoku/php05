<?php

//--------------------トップ画面-----------------------------------------------//

// セッションの開始
session_start();
//関数読み込み
include('functions.php');
//セッション状態の確認の関数
check_session_id();

$user_id = $_SESSION['user_id'];

// DB接続
$pdo = connect_to_db(); //データベース接続の関数、$pdoに受け取る

$sql = 'SELECT * FROM date_table as x join fish_table as y on x.id = y.date_id where x.user_id = :user_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);


try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($result);
// echo '</pre>';
// exit();

// //繰り返し処理を用いて，取得したデータから HTML タグを生成する
//   $output = ""; //表示のための変数
//   foreach ($result as $record) {
//     $output .= "
//     <li><a href=fish_input.php?id={$record["id"]}>{$record["date"]}</a></li>
//     ";

//     }











?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Fish Data</title>

  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">

  <!-- bootstrap css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <!-- bootstrap toggle -->
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">


</head>

<body>
  <!-- ヘッダー部分 -->
  <header>

    <!-- ヘッダー左側 -->
    <div id="header_left">
      <h1>Fish Data</h1>
      <input type="checkbox" checked data-toggle="toggle" data-on="Log" data-off="Picture" data-onstyle="primary" data-offstyle="warning">
    </div>

    <!-- ヘッダー右側 -->
    <div id="header_right">
      <img src="./img/face.JPG" id="profile_image" alt="プロフィール画像">
      <div><?=$_SESSION['username']?></div>
      <a href="logout.php" id="logout_btn">logout</a>
    </div>

  </header>

  <div id="wrapper">
    <section>
      <a href="date_input.php">
        <div>入力画面</div>
      </a>
    </section>

    <section> 
      <div>
        <?= $output ?>
      </div>
    </section>

  </div>

  <!-- jquery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  <!-- bootstrap toggle -->
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

</body>

</html>