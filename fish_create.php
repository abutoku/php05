<?php

//関数読み込み
include('functions.php');

var_dump($_POST);
exit();

if (
  !isset($_POST['fish_name']) || $_POST['fish_name'] == '' ||
  !isset($_POST['category']) || $_POST['category'] == '' ||
  !isset($_POST['temp']) || $_POST['temp'] == '' ||
  !isset($_POST['depth']) || $_POST['depth'] == '' ||
  !isset($_POST['user_id']) || $_POST['user_id'] == ''
) {
  exit('ParamError'); //エラーを返す
}

// データの受け取り
$fish_name = $_POST['fish_name'];
$category = $_POST['category'];
$temp = $_POST['temp'];
$depth = $_POST['depth'];
$user_id = $_POST['user_id'];


?>