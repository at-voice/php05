<?php
// 外のファイルを読み込むよ
session_start();
include('functions.php');
check_session_id();

// id受け取り

$id = $_GET['id'];
// id取得

// $pdo = connect_to_db();



// DB接続
$pdo = connect_to_db();



// SQL実行
$sql = 'SELECT * FROM voicedemo WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);

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
<h2>編集中</h2>

  <p><a href="read.php">他の人の感じ方を見てみる</a></p>

  <audio src="audio/audio.mp3" preload="auto" controls></audio>

  <form action="create.php" method="POST">
  <div class="form_wrapper">
    <div>
      <!-- <input type="text" name="gender" placeholder="性別"> -->

      <select name="gender" id="gender" value="<?= $record['gender'] ?>">
        <option value="man">男</option>
        <option value="woman">女</option>
        <option value="neither">どちらでもない</option>
      </select>
    </div>

    <div>
      <!-- <input type="text" name="age" placeholder="年齢"> -->
<select name="age" id="age" value="<?= $record['age'] ?>">
  <script>
var i;

for(i=1; i<100; i++){
document.write('<option value="'+i+'">'+i+'歳</option>');
}
</script>
</select>
<!-- for文使いつつも20歳をselectedする方法はないか -->
    </div>

  </div>

  <div class="form_wrapper">
    <div>
      <select name="preference" id="preference" value="<?= $record['preference'] ?>">
        <option value="like" >すき</option>
        <option value="dislike">きらい</option>
        <option value="neither" selected>どちらでもない</option>
      </select>
    </div>

    <div>
      <input type="text" name="reason" placeholder="理由" value="<?= $record['reason'] ?>">
    </div>

    <div>
      <input type="hidden" name="id" value="<?= $record['id'] ?>">
      <!-- idは見せなくていいからtype="hidden" -->
    </div>
  </div>

  <div>
    <button>submit</button>
  </div>
  </div>


</form>

</div>
</body>
</html>