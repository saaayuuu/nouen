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

    $title = '';
    $staff_name = '';

    if (isset($_GET['staffid']) && is_numeric($_GET['staffid'])) {

        $title = 'スタッフ修正';

        try {

            $staff_id=$_GET['staffid'];

            $dsn = 'mysql:host=127.0.0.1;dbname=nouen;';
            $user = 'root';
            $password = '';

            $dbh = new PDO($dsn, $user, $password);

            $dbh->query('SET NAMES utf8');

            $sql = 'SELECT id,name FROM mst_staff WHERE id=?';
            $stmt = $dbh->prepare($sql);
            $data[]=$staff_id;
            $stmt->execute($data);


            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $staff_name=$rec['name'];

            $dbh = null;
        }
        catch (Exception $e)
        {

            print 'ただいま障害により、困り果てています。';
            exit();
        }

    } else {

        $title = 'スタッフ追加';

    }

?>

    <?php echo $title; ?><br />
    <br />
<?php
    if (isset($staff_id)) {
?>
    スタッフコード <br />
    <?php print $staff_id;?>
<br />
<br />
<?php
    }
?>
<form method="post" action="staff_edit_check.php">
<input type="hidden" name="id" value="<?php print $staff_id;?>">
スタッフ名を入力してください。<br/>
<input type="text" name="name" style="width:200px" value="<?php print $staff_name;?>">
<br />
パスワードを入力してください。<br />
<input name="pass" type="password" style="width:100px"><br/>
パスワードをもう一度入力してください。<br/>
<input name="pass2" type="password" style="width:100px"><br/>
<br/>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">

</form>

</body>
</html>





