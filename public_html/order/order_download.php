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
<?php
require_once('../common/common.php');
?>

ダウンロードしたい注文日を選んでください。<br />31|<br />
<form method="post" action="order_download_done.php">
<?php pulldown_year();?>
年
<?php pulldown_month();?>
月
<?php pulldown_day();?>
日<br />
<br />
<input type="submit" value="ダウンロードへ">
</form>

  </body>
</html>



