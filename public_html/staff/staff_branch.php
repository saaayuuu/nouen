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
    if(isset($_POST['staffid'])==false)
    {
        header('Location: staff_ng.php');
    }
    $staff_id=$_POST['staffid'];
    header('Location: staff_disp.php?staffid='.$staff_id);
}

if(isset($_POST['add'])==true)
{
    header('Location: staff_edit.php');
}

if(isset($_POST['edit'])==true)
{
    if(isset($_POST['staffid'])==false)
    {
        header('Location: staff_ng.php');
    }
    $staff_id=$_POST['staffid'];
    header('Location: staff_edit.php?staffid='.$staff_id);
}

if(isset($_POST['delete'])==true)
{
     {
        header('Location: staff_ng.php');
    }
    $staff_id=$_POST['staffid'];
    header('Location: staff_delete.php?staffid='.$staff_id);
}


?>
</body>
</html>
