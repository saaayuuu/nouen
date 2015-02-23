<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
    print 'ようこそゲスト様　';
    print '<a href="member_login.html">会員ログイン</a><br />';
    print '<br />';
}
else
{
    print 'ようこそ　';
    print $_SESSION['member_name'];
    print '様';
    print '<a href="member_login.php"ログアウト</a><br />';
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
try
{

    $pro_code=$_GET['procode'];

    if(isset($_SESSION['cart'])==true)
    {
        $cart=$_SESSION['cart'];
        $kazu=$_SESSION['kazu'];
        if(in_array($pro_code,$cart)==true)
        {
            print 'その商品はすでにカートに入ってます。<br />';
            print '<a href="shop_list.php">商品一覧に戻る</a>';
            exit();

        }
    }
    $cart[]=$pro_code;
    $kazu[]=1;

    $_SESSION['cart']=$cart;
    $_SESSION['kazu']=$kazu;
}

catch (Exception $e)
{

    print 'ただいま障害により、困り果てています。';
    exit();
}

?>

カートに追加しました。<br />
<br />
<a href="shop_list.php">商品一覧に戻る</a>

</body>
</html>








