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

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
    print 'ログインされてません。<br />';
    print '<a href="../stap_login/staff_login.html">ログイン画面へ</a>';
    exit();
}
if(isset($_POST['disp'])==true)
{
    if(isset($_POST['procode'])==false)
    {
        header('Location: pro_ng.php');
    }
    $pro_code=$_POST['procode'];
    header('Location: pro_disp.php?procode='.$pro_code);
}

if(isset($_POST['add'])==true)
{
    header('Location: pro_add.php');
}

if(isset($_POST['edit'])==true)
{
    if(isset($_POST['procode'])==false)
    {
        header('Location: pro_ng.php');
    }
    $pro_code=$_POST['procode'];
    header('Location: pro_edit.php?procode='.$pro_code);
}

if(isset($_POST['delete'])==true)
{
    if(isset($_POST['procode'])==false)
    {
        header('Location: pro_ng.php');
    }
    $pro_code=$_POST['procode'];
    header('Location: pro_delete.php?procode='.$pro_code);
}


?>
</body>
</html>

