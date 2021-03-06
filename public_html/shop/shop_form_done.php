<?php
session_start();
session_regenerate_id(true);
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

    require_once('../common/common.php');

    $post=sanitize($_POST);

    $onamae=$post['onamae'];
    $email=$post['email'];
    $postal1=$post['postal1'];
    $postal2=$post['postal2'];
    $address=$post['address'];
    $tel=$post['tel'];
    $chumon=$post['chumon'];
    $pass=$post['pass'];
    $danjo=$post['danjo'];
    $birth=$post['birth'];

    print $onamae.'様<br />';
    print 'ご注文ありやーす！！！！<br />';
    print $email.'にメールを送らせていただきました。<br />';
    print '商品は以下の住所に送らせていただきます。<br />';
    print $postal1.' - '.$postal2.'<br />';
    print $address.'<br />';
    print $tel.'<br />';

    $honbun='';
    $honbun.=$onamae."様¥n¥n この度はご注文ありがとうございました。¥n";
    $honbun.="¥n";
    $honbun.="ご注文の商品¥n";
    $honbun.="--------------------¥n";

    $cart=$_SESSION['cart'];
    $kazu=$_SESSION['kazu'];
    $max=count($cart);

    $dsn = 'mysql:host=127.0.0.1;dbname=nouen;';
    $user = 'root';
    $password = '';

    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');
    for($i=0;$i<$max;$i++)
    {
        $sql = 'SELECT name,price FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[0]=$cart[$i];
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = $rec['name'];
        $price = $rec['price'];
        $kakaku[]=$price;
        $suryo = $kazu[$i];
        $shokei = $price*$suryo;

        $honbun.=$name.'';
        $honbun.=$price.'円 x ';
        $honbun.=$suryo.'個 = ';
        $honbun.=$shokei."円 ¥n";
    }
    $sql = 'LOCK TABLES dat_sales,datsales_product WRITE';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

$lastmembercode=0;

if($chumon=='chumontouroku')
{
    // $sql = 'INSERT INTO dat_member (password,name,email,postal1,postal2,address,tel,danjo,born) VALUES(?,?,?,?,?,?,?)';

    $sql  = '';
    $sql .= 'INSERT INTO';
    $sql .= '  dat_member';
    $sql .= '(';
    $sql .= '  password,';
    $sql .= '  name,';
    $sql .= '  email,';
    $sql .= '  postal1,';
    $sql .= '  postal2,';
    $sql .= '  address,';
    $sql .= '  tel,';
    $sql .= '  danjo,';
    $sql .= '  born';
    $sql .= ') VALUES (';
    $sql .= '  ?,';
    $sql .= '  ?,';
    $sql .= '  ?,';
    $sql .= '  ?,';
    $sql .= '  ?,';
    $sql .= '  ?,';
    $sql .= '  ?,';
    $sql .= '  ?,';
    $sql .= '  ?';
    $sql .= ')';


    $stmt = $dbh->prepare($sql);
    $data=array();
    $data[]=md5($pass);
    $data[]=$onamae;
    $data[]=$email;
    $data[]=$postal1;
    $data[]=$postal2;
    $data[]=$address;
    $data[]=$tel;
    if($danjo=='dan')
    {
        $data[]=1;
    }
    else
    {
        $data[]=2;
    }
    $data[]=$birth;
    $stmt->execute($data);

    $sql = 'SELECT LAST_INSERT_ID()';
    $stmt= $dbh->prepare($sql);
    $stmt->execute();
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastcode=$rec['LAST_INSERT_ID()'];
}
    $sql = 'INSERT INTO dat_sales(code_member,name, email, postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data=array();
    $data[]=$lastmembercode;
    $data[]=$onamae;
    $data[]=$email;
    $data[]=$postal1;
    $data[]=$postal2;
    $data[]=$address;
    $data[]=$tel;
    $stmt->execute($data);

    $sql = 'SELECT LAST_INSERT_ID()';
    $stmt= $dbh->prepare($sql);
    $stmt->execute();
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastcode=$rec['LAST_INSERT_ID()'];

    for($i=0;$i<$max;$i++)
    {
        $sql = 'INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) VALUES(?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $data=array();
        $data[]=$lastmembercode;
        $data[]=$cart[$i];
        $data[]=$kakaku[$i];
        $data[]=$kazu[$i];
        $stmt->execute($data);
    }

    $sql = 'UNLOCK TABLES';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh=null;
    if($chumon=='chumontouroku')
    {
        print ' 会員登録が完了しました。<br />';
        print ' 次回からメールアドレスとパスワードでログインしてください。<br />';
        print ' ご注文が簡単にできるようになります。<br />';
        print '<br />';
    }

    $honbun.="送料は無料です。¥n";
    $honbun.="--------------------¥n";
    $honbun.="¥n";
    $honbun.="代金は下記にお振り込みください";
    $honbun.="YUSJ銀行 ぜの支店 普通 １２３４５６７¥n";
    $honbun.="入金確認がとれ次第、梱包、発送させていただきます。¥n";
    $honbun.="¥n";
    $honbun.="oooooooooooooooooooooo¥n";
    $honbun.=" 〜安心安全のゆさ農園〜¥n";
    $honbun.="¥n";
    $honbun.="ゆさ県ゆさ市歌舞伎町２−２−５¥n";
    $honbun.="0901122xxxx¥n";
    $honbun.="¥n";
    if($chumon=='chumontouroku')
    {
        $honbun.=" 会員登録が完了しました。¥n";
        $honbun.=" 次回からメールアドレスとパスワードでログインしてください。¥n";
        $honbun.=" ご注文が簡単にできるようになります。¥n";
        $honbun.="¥n";
    }
    $honbun.="oooooooooooooooooooooo¥n";
//print '<br />'
//print nl2br($honbun);

    $title ='ごちゅうもんありがとうございます。';
    $header ='Form:info@yusanouen.co.jp';
    $honbun =html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    mb_send_mail($email,$title,$honbun,$header);

    $title ='ごちゅうもんいただきました。';
    $header ='.$email';
    $honbun =html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    mb_send_mail($email,$title,$honbun,$header);
}
catch(Exception $e)
{
    print 'ただいま障害により苦戦してます。';
    exit();
}

?>
<br />
<a href="shop_list.php">商品画面へ</a>

</body>
</html>



