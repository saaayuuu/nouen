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

$pro_code=$_POST['code'];
$pro_name=$_POST['name'];
$pro_price=$_POST['price'];

$pro_code=htmlspecialchars($pro_code);
$pro_name=htmlspecialchars($pro_name);
$pro_price=htmlspecialchars($pro_price);

if($pro_name=='')
{
    print '商品名が空欄です。<br />';
}
else
{
    print '商品名：';
    print $pro_name;
    print '<br />';
}

if(preg_match('/^[0-9]+$/',$pro_price)==0)
{
    print '商品名を半角英数で入力してください。<br />';
}
else
{
    print '価格：';
    print $pro_price;
    print '円<br />';
}

if( $pro_gazou['size']>0)
{
    if( $pro_gazou['size']>1000000)
    {
        print '画像でかすぎだぜ！';
    }
    else
    {
        move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
        print '<img src="./gazou/'.$pro_gazou['name'].'">';
        print '<br />';
    }

if($pro_name==''||preg_match('/^[0-9]+$/',$pro_price)==0||$pro_gazou['size']>1000000)
{
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
}
else
{
    print '上記のように変更します。<br />';
    print '<form method="post" action="pro_edit_done.php">';
    print '<input type="hidden" name="name" value="'.$pro_code.'">';
    print '<input type="hidden" name="name" value="'.$pro_name.'">';
    print '<input type="hidden" name="price" value="'.$pro_price.'">';
    print '<input type="hidden" name="gazou_name_old" value="'.$pro_gazou_name_old.'">';
    print '<input type="hidden" name="gazou_name" value="'.$pro_gazou_['name'].'">';


    print '<br />';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK">';
    print '</form>';
}

?>
</body>
</html>




