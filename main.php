<?php

// セッションの開始
//session_start();
//関数読み込み
include('functions.php');

//セッション状態の確認の関数
//check_session_id();

//var_dump($_SESSION);

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

</head>

<body>
  <header>
    <h1>Fish Data</h1>
    <div id="header_right">
      <img src="./img/face.JPG" id="profile_image" alt="プロフィール画像">
      <div>username</div>
      <a href="logout.php" id="logout_btn">logout</a>
    </div>
  </header>
  <div id="wrapper">
    <section>

    </section>
  </div>
  <!-- jquery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>

</html>