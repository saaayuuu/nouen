<?php
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
    setcookie(session_name(), '',time()-42000,'/');
}
@session_destroy();
?>



<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="Content-Script-Type" content="text/javascript">

    <meta name="keywords" content="head,ヘッダ,メタ,HTML5,タグ,要素">
    <meta name="description" content="文書の説明。">
    <title>ゆさ農園</title>
  </head>
  <body>
カートを空にしました。<br/>
<br/>
<a href="../staff_login/staff_login.html">ログイン画面へ</a>
</body>
</html>




