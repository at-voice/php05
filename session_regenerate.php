<?php
// セッションの開始
session_start();
// //session_start();で宣言しないと動かない
$old_session_id = session_id();

// 再生成
session_regenerate_id(true);
// //session_regenerate_id(true);→古いsession idを無効化する
$new_session_id = session_id();
// //このsession_id();は古いのを無効化したあとに再度生成されたもの

// 新旧のidを画面に表示して更新されていることを確認→確認できた
// echo "<p>旧id: {$old_session_id}</p>";
// echo "<p>新id: {$new_session_id}</p>";
// exit();

?>