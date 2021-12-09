<?php

//--------------------魚のテーブルに登録フォーム---------------------------//

// セッションの開始
session_start();
//関数読み込み
include('functions.php');
//セッション状態の確認の関数
check_session_id();


$date_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// var_dump($date_id);
// exit();


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fish Input</title>

  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">

</head>

<body>

  <!-- ヘッダー部分 -->
  <header>

    <!-- ヘッダー左側部分 -->
    <div id="header_left">
      <h1>FISH Input</h1>
    </div>

    <!-- ヘッダー右側部分 -->
    <div id="header_right">
      <img src="./img/face.JPG" id="profile_image" alt="プロフィール画像">
      <div id="user_name"><?= $_SESSION['username'] ?></div>
      <a href="logout.php" id="logout_btn">logout</a>
    </div>

  </header>

  <div id="wrapper">

    <!-- トップボタン部分 -->
    <div id="top_btn_section">
      <a href="main.php" id="top_btn">
        <div id="top_btn">TOP</div>
      </a>
    </div>

    <section id="input_section">

      <form action="log_create.php" method="post">
        <!-- 魚の名前 -->
        <div>
          <p>name</p>
          <input type="text" name="fishname" id="fish_name" required>
        </div>

        <!-- 水深を選択 -->
        <div>
          <p>水深</p>
          <input type="number" name="depth" min="0" max="40" value="10" required>
        </div>

        <div>
          <!-- ユーザーIDを取得しておく部分 -->
          <input type="hidden" name="user_id" value=<?= $user_id ?>>
          <!-- 日付のIDを取得しておく部分 -->
          <input type="hidden" name="date_id" value=<?= $date_id ?>>
        </div>

        <!-- 登録ボタン -->
        <button type="submit" id="fish_input_btn">登録</button>
      </form>

      <img src="https://api.tide736.net/tide_image.php?pc=40&hc=19&yr=2021&mn=12&dy=6&rg=day&w=640&h=512&lc=lightslategray&gcs=deepskyblue&gcf=blue&ld=on&ttd=on&tsmd=on">

    </section><!-- input_sectionここまで -->

  </div><!-- wrapperここまで -->

  <!-- jquery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  <!-- bootstrap toggle -->
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


    
</body>

</html>