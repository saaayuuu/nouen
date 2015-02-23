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

    $staff_id=$_POST['id'];
    $staff_pass=$_POST['pass'];

    $staff_id=htmlspecialchars($staff_id);
    $staff_pass=htmlspecialchars($staff_pass);

    $staff_pass=md5($staff_pass);

    $dsn = 'mysql:host=127.0.0.1;dbname=nouen;';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');

    $sql = 'SELECT name FROM mst_staff WHERE name=? AND password=?';
    $stmt = $dbh->prepare($sql);
    $data[]=$staff_id;
    $data[]=$staff_pass;
    $stmt->execute($data);

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rec==false)
    {
        print 'スタッフコードかパスワードが間違ってます。<br />';
        print '<a href="staff_login.html">戻る</a>';
    }
    else
    {
        session_start();
        $_SESSION['login']=1;
        $_SESSION['staff_id']=$staff_id;
        $_SESSION['staff_name']=$rec['name'];
        header('Location: staff_top.php');
    }
}
catch (Exception $e) 
{
    print 'ただいま障害により、困り果てています。';
    exit();

}

?>




    </body>
</html>



