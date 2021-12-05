<?php

//関数読み込み
include('functions.php');

// var_dump($_POST);
// exit();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Date input</title>
</head>
<body>
  <div id="wrapper">
    <h1>Date input</h1>
  </div>
  <section>
    <form action="date_create.php">
      <input type="date" name="input_date">
    </form>
  </section>

</body>
</html>