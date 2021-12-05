<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Input</title>

  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">

</head>

<body>

  <div id="wrapper">

    <h1>Data Input</h1>

    <section id="input_section">

      <form action="data_input.php" method="post">

        <div>
          <p>name</p>
          <input type="text" name="fish_name" id="fish_name" required>
        </div>

        <div>
          <select name="category" id="category" required>

          </select>
        </div>

        <div>
          <p>水温</p>
          <input type="number" name="temp" min="0" max="40" value="20" required>
        </div>

        <div>
          <p>水深</p>
          <input type="number" name="tide" min="0" max="40" value="10" required>
        </div>

        <div>
          <input type="text" id="user_id">
        </div>

        <button type="submit" id="fish_input_btn">登録</button>

      </form>

    </section>

  </div>

  <!-- jquery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  <!-- bootstrap toggle -->
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

  <script>
    const categoryArray = [
      "ベラ科",
      "ハタ科",
      "スズメダイ科",
      "ハゼ科",
      "フグ科",
      "フサカサゴ科",
      "イサキ科",
      "チョウチョウオ科",
      "アジ科",
      "ヨウジウオ科",
      "テンジクダイ科",
      "カワハギ科",
    ];

    //タグ付のための配列
    const tagArray = [];

    //繰り返し処理ための配列
    categoryArray.forEach((x) => {
      tagArray.push(`<option value="${x}">${x}</option>`);
    });
    tagArray.unshift(`<option disabled selected value>科を選択</option>`);

    //selectタグの中に作成
    $('#category').html(tagArray);
    

  </script>
</body>

</html>