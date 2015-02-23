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
try
{

$pro_code=$_GET['procode'];

$dsn = 'mysql:host=127.0.0.1;dbname=nouen;';
$user = 'root';
$password = '';

$dbh = new PDO($dsn, $user, $password);

$dbh->query('SET NAMES utf8');

$sql = 'SELECT name,price,gazou FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);


$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_price=$rec['price'];
$pro_gazou_name=$rec['gazou'];

$dbh = null;

    if($pro_gazou_name=='') {
        $disp_gazou=='';
    } else {
        $disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
    }

} catch (Exception $e)
{

    print 'ただいま障害により、困り果てています。';
    exit();
}

?>

商品情報参照 <br />
<br />
商品コード <br />
<?php print $pro_code;?>
<br />
商品名<br />
<?php print $pro_name;?>
<br />
価格<br />
<?php print $pro_price;?>円
<br />
<br />
<?php print $disp_gazou;?>
<br />

<form>
<input type="button" onclick="history.back()" value="戻る">
</form>

</body>
</html>






