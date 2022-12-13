<?php
session_start();
include('functions.php');

// データ受け取り
// var_dump($_POST);
// exit();
$username = $_POST['username'];
$password = $_POST['password'];


// DB接続
$pdo = connect_to_db();
// // 外部読み込みファイル編集忘れないで


// SQL実行

// // username，password，is_deletedの3項目全てを満たすデータを抽出する．
$sql = 'SELECT * FROM users_table WHERE username=:username AND password=:password AND is_deleted=0';
// // is_deleted = 0/1でユーザーデータの有無を記録している

// // バインド関数の設定
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}



// ユーザ有無で条件分岐
$val = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$val) {
  echo "<p>ログイン情報に誤りがあります</p>";
  echo "<a href=login.php>ログイン</a>";
  exit();
} else {
  $_SESSION = array();
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['session_id'] = session_id();
  $_SESSION['is_admin'] = $val['is_admin'];
  $_SESSION['username'] = $val['username'];
  header("Location:read.php");
  exit();
}
// // 「パスワードが誤っています」のように具体的な情報を与えると不正ログインにもつながる

