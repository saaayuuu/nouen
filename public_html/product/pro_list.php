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

try {

    $dsn = 'mysql:host=127.0.0.1;dbname=nouen;';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');
    $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    print ' 商品一覧<br /><br />';

    print '<form method="post" action="pro_branch.php">';

    while(true) {

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        if($rec==false) {
            break;
        }

        print'<input type="radio" name="procode" value="' . $rec['code'] . '">';
        print $rec['name'].'---';
        print $rec['price'].'円';
        print '</br>';
    }
    print '<input type="submit" name="disp" value="参照">';
    print '<input type="submit" name="add" value="追加">';
    print '<input type="submit" name="edit" value="修正">';
    print '<input type="submit" name="delete" value="削除">';
    print '</form>';

} catch (Exception $e) {
    print 'ただいま障害により、困り果てています。';
    exit();

}

?>

<br />
<a href="../staff_login/staff_top.php">トップメニューへ</a>

</body>
</html>

