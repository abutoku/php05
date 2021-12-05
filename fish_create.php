<?php

//--------------------魚のテーブルに登録処理---------------------------//

//関数読み込み
include('functions.php');

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';
// exit();

if (
  !isset($_POST['fish_name']) || $_POST['fish_name'] == '' ||
  !isset($_POST['category']) || $_POST['category'] == '' ||
  !isset($_POST['temp']) || $_POST['temp'] == '' ||
  !isset($_POST['depth']) || $_POST['depth'] == '' ||
  !isset($_POST['user_id']) || $_POST['user_id'] == ''||
  !isset($_POST['date_id']) || $_POST['date_id'] == ''
) {
  exit('ParamError'); //エラーを返す
}

// データの受け取り
$fish_name = $_POST['fish_name'];
$category = $_POST['category'];
$temp = $_POST['temp'];
$depth = $_POST['depth'];
$user_id = $_POST['user_id'];
$date_id = $_POST['date_id'];

// DB接続
$pdo = connect_to_db(); //データベース接続の関数、$pdoに受け取る

//SQL 登録処理実行
$sql = 'INSERT INTO fish_table(id,date_id,fish_name,category,temp,depth,created_at,updated_at,user_id) VALUES(NULL, :date_id,:fish_name,:category,:temp,:depth,now(),now(),:user_id)';


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':date_id', $date_id, PDO::PARAM_STR);
$stmt->bindValue(':fish_name', $fish_name, PDO::PARAM_STR);
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':temp', $temp, PDO::PARAM_STR);
$stmt->bindValue(':depth', $depth, PDO::PARAM_STR);
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