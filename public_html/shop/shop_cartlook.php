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
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様　';
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
    if(isset($_SESSION['cart'])==true)
    {
        $cart=$_SESSION['cart'];
        $kazu=$_SESSION['kazu'];
        $max=count($cart);
    }
    else
    {
        $max=0;
    }

    if($max==0)
    {
        print 'カートに商品が入っていません。<br />';
        print '<br />';
        print '<a href="shop_list.php">商品一覧へ戻る</a>';
        exit();
    }

    $dsn = 'mysql:host=127.0.0.1;dbname=nouen;';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');

    foreach ($cart as $key=>$val)
    {

        $sql = 'SELECT code,name,price,gazou FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[0]=$val;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $pro_name[]=$rec['name'];
        $pro_price[]=$rec['price'];
        if($rec['gazou']=='')
        {
            $pro_gazou[]='';
        }
        else
        {
            $pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'">';
        }
    }
    $dbh = null;

}
catch (Exception $e)
{

    print 'ただいま障害により、困り果てています。';
    exit();
}

?>

カートの中身<br />
<br />
<table border="1">
<tr>
<td>商品</td>
<td>商品画像</td>
<td>価格</td>
<td>数量</td>
<td>小計</td>
<td>削除</td>
</tr>


<form method="post" action="kazu_change.php">
<?php for($i=0;$i<$max;$i++)
{
?>
<tr>
          <td><?php print $pro_name[$i]; ?></td>
          <td><?php print $pro_gazou[$i]; ?></td>
          <td><?php print $pro_price[$i]; ?>円</td>
          <td><input type="text" name="kazu<?php print $i; ?>" value="<?php print $kazu[$i]; ?>"></td>
          <td><?php print $pro_price[$i]*$kazu[$i]; ?>円</td>
          <td><input type="checkbox" name="sakujo<?php print $i; ?>"></td>

</tr>
<?php
}
?>
</table>

<input type="hidden" name="max" value="<?php print $max;?>">
<input type="submit" value="数量変更"><br />
<input type="button" onclick="history.back()" value="戻る">
</form>

<br />
<a href="shop_form.html">ご購入手続きへ進む</a>
<br />

<?php
if(isset($_SESSION["member_login"])==true)
{
    print '<a href="shop_kantan_check.php">会員簡単注文へ進む</a><br />';
}
?>

</body>
</html>








