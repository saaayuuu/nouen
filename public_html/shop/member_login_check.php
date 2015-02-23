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

    require_once('../common/common.php');

    $post=sanitize($_POST);
    $member_email=$_POST['email'];
    $member_pass=$_POST['pass'];

    $member_pass=md5($member_pass);

    $dsn = 'mysql:host=127.0.0.1;dbname=nouen;';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');

    $sql = 'SELECT code,name FROM dat_member WHERE email=? AND password=?';
    $stmt = $dbh->prepare($sql);
    $data[]=$member_email;
    $data[]=$member_pass;
    $stmt->execute($data);

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rec==false)
    {
        print 'メールアドレスが間違ってます。<br />';
        print '<a href="member_login.html">戻る</a>';
    }
    else
    {
        session_start();
        $_SESSION['member_login']=1;
        $_SESSION['member_code']=$rec['code'];
        $_SESSION['member_name']=$rec['name'];
        header('Location: shop_list.php');
        exit();
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




