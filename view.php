<?php

// ------------日付ごとの詳細ページ-------------------------------------//

// var_dump($_GET);
// exit();

// セッションの開始
session_start();
//関数読み込み
include('functions.php');
//セッション状態の確認の関数
check_session_id();

$date_id = $_GET['id'];


// DB接続
$pdo = connect_to_db(); //データベース接続の関数、$pdoに受け取る

$sql = 'SELECT * FROM fish_table WHERE date_id = :date_id ORDER BY fish_name ASC';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':date_id', $date_id, PDO::PARAM_STR);


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

$output = "";
foreach ($result as $record) {
  $output .= "
  <div class=fish_contatiner>

    <div id=output{$record['id']} class=fish_contents>
      <div class=fish_name>{$record['fish_name']}</div>
      <div class=infomation>
        <div>{$record['category']}</div>
        <div>水深{$record['depth']}ｍ</div>
        <div>水温{$record['temp']}℃</div>
      </div>
    </div>

  <div>
";
}



?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>fish data</title>

  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">

</head>

<body>
  <header>

    <div id="header_left">
      <h1>Fish Data</h1>
    </div>

    <div id="header_right">
      <img src="./img/face.JPG" id="profile_image" alt="プロフィール画像">
      <div id="user_name"><?= $_SESSION['username'] ?></div>
      <a href="logout.php" id="logout_btn" class="btn">logout</a>
    </div>

  </header>

  <div id="wrapper">

    <!-- トップボタン部分 -->
    <div id="top_btn_section">
      <a href="main.php" id="top_btn">
        <div id="top_btn">TOP</div>
      </a>
    </div>

    <section>
      <?= $output ?>
    </section>

  </div>



</body>

</html>