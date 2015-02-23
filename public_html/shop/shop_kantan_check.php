<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
    print 'ログインされていません。<br />';
    print '<a href="shop_list.php">商品一覧へ</a>';
    exit();
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
$code=$_SESSION['member_code'];

$dsn = 'mysql:host=127.0.0.1;dbname=nouen;';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');
$sql = 'SELECT name,email,postal1,postal2,address,tel FROM dat_member WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[]=$code;
$stmt->execute($data);
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$dbh=null;


$onamae=$rec['name'];
$email=$rec['email'];
$postal1=$rec['postal1'];
$postal2=$rec['postal2'];
$address=$rec['address'];
$tel=$rec['tel'];

print 'お名前<br />';
print $onamae;
print '<br /><br />';

print 'メールアドレス<br />';
print $email;
print '<br /><br />';

print '郵便番号<br />';
print $postal1;
print '-';
print $postal2;
print '<br /><br />';

print 'ご住所<br />';
print $address;
print '<br /><br />';

print '電話番号<br />';
print $tel;
print '<br /><br />';

print '<form method="post" action="shop_kantan_done.php">';
print '<input name="onamae" type="hidden" value="'.$onamae.'"><br/>';
print '<input name="email" type="hidden" value="'.$email.'"><br/>';
print '<input name="postal1" type="hidden" value="'.$postal1.'"><br/>';
print '<input name="postal2" type="hidden" value="'.$postal2.'"><br/>';
print '<input name="address" type="hidden" value="'.$address.'"><br/>';
print '<input name="tel" type="hidden" value="'.$tel.'"><br/>';

print '<input type="button" onclick="history.back()" value="戻る">';
print '<input type="submit" value="OK">';
print '</form>';
?>

</body>
</html>



