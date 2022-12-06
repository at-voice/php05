<?php
// 入力項目のチェック
if (
  !isset($_POST['gender']) || $_POST['gender']=='' ||
  !isset($_POST['age']) || $_POST['age']=='' ||
  !isset($_POST['preference']) || $_POST['preference']==''
) {
  exit('性別・年齢・好みは必須項目です');
}
// // 入力されてなかったらエラー出します

$gender = $_POST['gender'];
$age = $_POST['age'];
$preference = $_POST['preference'];
$reason = $_POST['reason'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

// SQL実行
$sql = 'UPDATE todo_table SET todo=:todo, deadline=:deadline, updated_at=now() WHERE id=:id';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$stmt->bindValue(':preference', $preference, PDO::PARAM_STR);
$stmt->bindValue(':reason', $reason, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// 処理完了したらread.phpに戻ります
header('Location:read.php');
exit();
