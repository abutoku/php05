<?php

//--------------------トップ画面-----------------------------------------------//

// セッションの開始
session_start();
//関数読み込み
include('functions.php');
//セッション状態の確認の関数
check_session_id();

//変数にユーザーIDとユーザータイプを取得
$user_id = $_SESSION['user_id'];
$admin = $_SESSION['is_admin'];

//管理者ユーザであれば編集ボタンを表示
if($admin === '1'){
  $settings ="<a href=user_list.php>ユーザー管理</a>";
}

// DB接続
$pdo = connect_to_db(); //データベース接続の関数、$pdoに受け取る

//date-tableからuserIDが一致しているものを取得
$sql = 'SELECT * FROM date_table WHERE user_id = :user_id ORDER BY date DESC';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id',$user_id, PDO::PARAM_STR);

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

//繰り返し処理を用いて，取得したデータから HTML タグを生成する
$output = ""; //表示のための変数
foreach ($result as $record) {
    $output .= "
    <a href=date_view.php?id={$record["id"]}><li>{$record["date"]}</li></a>
";
}

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
      <div><?= $settings?></div>
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
      <ul>
        <?= $output ?>
      <ul>
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