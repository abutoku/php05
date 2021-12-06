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
    <a href=view.php?id={$record["id"]}><li class=date_txt>{$record["date"]}</li></a>
";
}

//タグづけ
//<a href=view.php?id=date_id><li class=btn date_txt>date</li></a>

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Fish LOG</title>

  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">

</head>

<body>
  <!-- ヘッダー部分 -->
  <header>

    <!-- ヘッダー左側 -->
    <div id="header_left">
      <h1>FISH Log</h1>
      <div><?= $settings?></div>
    </div>

    <!-- ヘッダー右側 -->
    <div id="header_right">
      <img src="./img/face.JPG" id="profile_image" alt="プロフィール画像">
      <div id="user_name"><?=$_SESSION['username']?></div>
      <a href="logout.php" id="logout_btn" class="btn">logout</a>
    </div>

  </header>

  <div id="wrapper">

    <!-- データ追加ボタン -->
    <section id="top_btn_section">
      <a href="date_input.php">
        <div id="add_btn" class="add">add</div>
      </a>
    </section>

    <!-- 日付とポイント名出力部分 -->
    <section> 
      <ul id="date_list">
        <?= $output ?>
      <ul>
    </section>

  </div>

  <!-- jquery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</body>
</html>