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
    <title>ゆさ農園2</title>
  </head>
  <body>
<?php

$staff_id=$_POST['id'];
$staff_name=$_POST['name'];
$staff_pass=$_POST['pass'];
$staff_pass2=$_POST['pass2'];

$staff_name=htmlspecialchars($staff_name);
$staff_pass=htmlspecialchars($staff_pass);
$staff_pass2=htmlspecialchars($staff_pass2);

if($staff_name=='')
{
    print 'スタッフ名が空欄です。<br />';
}
else
{
    print 'スタッフ名：';
    print $staff_name;
    print '<br />';
}

if($staff_pass=='')
{
    print 'パスワードが空欄です。<br />';
}

if($staff_pass!=$staff_pass2)
{
    print 'パスワードが一致しません。<br />';
}

if($staff_name=='' ||$staff_pass=='' ||$staff_pass!=$staff_pass2)
{
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
}
else
{
$staff_pass=md5($staff_pass2);
print '<form method="post" action="staff_add_done.php">';
print '<input type="hidden" name="id" value="'.$staff_id.'">';
print '<input type="hidden" name="name" value="'.$staff_name.'">';
print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
print '<br />';
print '<input type="button" onclick="history.back()" value="戻る">';
print '<input type="submit" value="OK">';
}

?>

</body>
</html>


