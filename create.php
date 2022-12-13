<?php
session_start();
check_session_id();

// var_dump($_POST);
// exit(); POSTは受け取れている


// 入力がない場合データを受け付けません→作動確認済み
if (
  !isset($_POST['gender']) || $_POST['gender']=='' ||
  !isset($_POST['age']) || $_POST['age']=='' ||
  !isset($_POST['preference']) || $_POST['preference']==''
) {
  exit('性別・年齢・好みは必須項目です');
}

// データ受け取り→作動確認済み
$gender = $_POST['gender'];
$age = $_POST['age'];
$preference = $_POST['preference'];
$reason = $_POST['reason'];

// // 各種項目設定
// $dbn ='mysql:dbname=voicedemo;charset=utf8mb4;port=3306;host=localhost';
// $user = 'root';
// $pwd = '';

// // DB接続
// try {
//   $pdo = new PDO($dbn, $user, $pwd);
//   // exit('ok');
// } catch (PDOException $e) {
//   echo json_encode(["db error" => "{$e->getMessage()}"]);
//   exit();
// } 外部ファイル読み込み

// 外のファイルを読み込むよ
include('functions.php');
$pdo = connect_to_db();

// 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる．

// SQL作成&実行
$sql = 'INSERT INTO voicedemo (id, gender, age, preference, reason, created_at) VALUES (NULL,:gender,:age,:preference,:reason,NOW())';
$stmt = $pdo->prepare($sql);

// あとでモどす→VALUES (NULL,:gender,:age,:preference,:reason,:when_hear,:where_hear,:whom_hear,:comment,now())';


// バインド変数を設定
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$stmt->bindValue(':preference', $preference, PDO::PARAM_STR);
$stmt->bindValue(':reason', $reason, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:input.php');
exit();


?>

<!DOCTYPE html>
<html lang="ja">
 
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 </head>
 
<body>
  
</body>
</html>