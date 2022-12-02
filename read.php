<?php

$dbn ='mysql:dbname=voicedemo;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// SQL作成&実行

$sql = 'SELECT * FROM voicedemo';
$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行後の処理

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["gender"]}</td>
      <td>{$record["age"]}</td>
      <td>{$record["preference"]}</td>
      <td>{$record["reason"]}</td>
    </tr>
  ";
}


?>


<!DOCTYPE html>
<html lang="ja">
 
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Mincho&display=swap" rel="stylesheet">
<!-- さわらび明朝 -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 </head>
 
<body>
<div class="header">
  <h1>VOICEDEMO around the WORLD</h1>

</div>


  <div class="main">

    <div class="table">
    <table>
      <thead>
        <tr>
          <th>性別</th>
          <th>年齢</th>
          <th>好き嫌い</th>
          <th>その理由</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
      <?=$output?>
      </tbody>
    </table>
          <a href="input.php" class="link">入力画面</a>

    </div>



  </div>
</body>
</html>