<?php

include('functions.php');
// 外部読み込む

$user_id = $_GET['user_id'];
$todo_id = $_GET['todo_id'];

$pdo = connect_to_db();

// Like状態を調べる（Likeが何個入ってる？）
$sql = 'SELECT COUNT(*) FROM like_table WHERE user_id=:user_id AND todo_id=:todo_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':todo_id', $todo_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$like_count = $stmt->fetchColumn();

// まずはデータ確認→取れてました
// var_dump($like_count);
// exit();

// Like状態を調べる（Likeが何個入ってる？）終了


// Like数でその後の動作を変えます
if ($like_count != 0) {
  // いいねされている状態
  $sql = 'DELETE FROM like_table WHERE user_id=:user_id AND todo_id=:todo_id';
} else {
  // いいねされていない状態
  $sql = 'INSERT INTO like_table (id, user_id, todo_id, created_at) VALUES (NULL, :user_id, :todo_id, sysdate())';
}
// 終了


// Like情報を登録
// $sql = 'INSERT INTO like_table (id, user_id, todo_id, created_at) VALUES (NULL, :user_id, :todo_id, now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':todo_id', $todo_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:read.php");
exit();
// Like情報登録終了




?>
