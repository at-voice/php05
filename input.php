<?php
session_start();
include('functions.php');
check_session_id();
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
      <p>
<a href="read.php">感想一覧</a> / <a href="invitation.html">ユーザーの声</a>
</p>
		</div>


  <div class="main">
  <p><a href="read.php">他の人の感じ方を見てみる</a></p>

  <audio src="audio/audio.mp3" preload="auto" controls></audio>

  <form action="create.php" method="POST">
  <div class="form_wrapper">
    <div>
      <!-- <input type="text" name="gender" placeholder="性別"> -->

      <select name="gender" id="gender">
        <option value="man">男</option>
        <option value="woman">女</option>
        <option value="neither">どちらでもない</option>
      </select>
    </div>

    <div>
      <!-- <input type="text" name="age" placeholder="年齢"> -->
<select name="age" id="age">
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
      <select name="preference" id="preference">
        <option value="like" >すき</option>
        <option value="dislike">きらい</option>
        <option value="neither" selected>どちらでもない</option>
      </select>
    </div>

    <div>
      <input type="text" name="reason" placeholder="理由">
    </div>
  </div>

  <div>
    <button>submit</button>
  </div>
  </div>


</form>

<div>
      <a href="logout.php">logout</a>
</div>

<ul>
  <li>編集のときに、変更した部分の色を変えたい（一覧表示のときは不要）</li>
  <li>年齢プルダウンでデフォルト表示を18くらいにしたい</li>
  <li>deleteクリック時にアラートを出したい</li>
  <li>ぬるっとした感じに動いて欲しい</li>
</ul>

</div>
</body>
</html>