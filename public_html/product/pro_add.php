<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
    print 'ログインされてません。<br />';
    print '<a href="../stap_login/staff_login.html">ログイン画面へ</a>';
    exit();
}
else
{
    print $_SESSION['staff_name'];
    print 'さんログイン中<br />';
    print '<br />';
}
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
商品追加<br/>
<br/>
<form method="post" action="pro_add_check.php" enctype="multipart/form-data">
商品名を入力してください。<br/>
<input name="name" type="text" style="width:200px"><br/>
価格を入力してください。<br/>
<input name="price" type="text" style="width:50px"><br/>
画像を選択してください。<br/>
<input name="gazou" type="file" style="width:400px"><br/>
<br/>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>


