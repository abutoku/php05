<?php

//--------------------魚のテーブルに登録処理---------------------------//

//関数読み込み
include('functions.php');

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';
// exit();

if (
  !isset($_POST['fishname']) || $_POST['fishname'] == '' ||
  !isset($_POST['depth']) || $_POST['depth'] == '' ||
  !isset($_POST['user_id']) || $_POST['user_id'] == ''||
  !isset($_POST['date_id']) || $_POST['date_id'] == ''
) {
  exit('ParamError'); //エラーを返す
}

// データの受け取り
$fishname = $_POST['fishname'];
$depth = $_POST['depth'];
$user_id = $_POST['user_id'];
$date_id = $_POST['date_id'];

// var_dump($fishname);
// var_dump($depth);
// var_dump($user_id);
// var_dump($date_id);
// exit();

// DB接続
$pdo = connect_to_db(); //データベース接続の関数、$pdoに受け取る

//SQL 登録処理実行
$sql = 'INSERT INTO log_table(id,fishname,depth,date_id,user_id,created_at,updated_at) VALUES(NULL,:fishname,:depth,:date_id,:user_id,now(),now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':fishname', $fishname, PDO::PARAM_STR);
$stmt->bindValue(':depth', $depth, PDO::PARAM_STR);
$stmt->bindValue(':date_id', $date_id, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

//処理が終わった後のページ移動
header("Location:date_input.php");
exit();



?>