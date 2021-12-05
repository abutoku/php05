<?php

//---------------------ログインできるか確認------------------------------------//


// データ受け取り
// var_dump($_POST);
// exit();

// セッションの開始
session_start();
include('functions.php');

// データを変数に代入
$username = $_POST['username'];
$password = $_POST['password'];

//データの確認
// var_dump($username);
// var_dump($password);
// exit();

// DB接続
$pdo = connect_to_db();


// SQL実行
// username，password，is_deletedの3項目全てを満たすデータを抽出する

//受け取ったデータが DB にあるかどうかチェック
$sql = 'SELECT * FROM users_table WHERE username=:username AND password=:password AND is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

//処理の確認
  // var_dump($status);
  // exit();

// ユーザ有無で条件分岐
$val = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$val) { //もしユーザーがいなければ
  echo "<p>ログイン情報に誤りがあります</p>"; //エラー表示
  echo "<a href=login.php>ログイン</a>"; //ログイン画面へのリンク
  exit();
} else { 
  //一致するユーザーが見つかった場合、セッション変数にログイン情報を保持してmain.phpに移動
  $_SESSION = array(); //セッションを一旦リセット
  $_SESSION['session_id'] = session_id(); //セッションIDを取得
  $_SESSION['is_admin'] = $val['is_admin']; //管理者ユーザと一般ユーザの識別に使用
  $_SESSION['user_id'] = $val['id']; //管理者ユーザと一般ユーザの識別に使用
  $_SESSION['username'] = $val['username']; //ユーザー名を取得
  header("Location:main.php");//main.phpへ
  exit();
}
