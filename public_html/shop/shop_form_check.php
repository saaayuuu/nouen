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
$pass2=$post['pass2'];
$danjo=$post['danjo'];
$birth=$post['birth'];

$okflg=true;

if($onamae=='')
{
    print 'お名前が入力されておりません。<br /><br />';
    $okflg=false;
}
else
{
    print 'お名前<br />';
    print $onamae;
    print '<br /><br />';
}

//if(preg_match('/^[#! - 9A~~]。+ @ + [-Z0-9] + + [。^] $/',$email)==0)

if(preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/', $email) == 0) {

    print 'メールアドレスを正確に入力してください。<br /><br />';
    $okflg=false;
}
else
{
    print 'メールアドレス<br />';
    print $email;
    print '<br /><br />';
}

if(preg_match('/^[0-9]+$/',$postal1)==0)
{
    print '郵便番号は半角数字で入力してください。<br /><br />';
    $okflg=false;
}
else
{
    print '郵便番号<br />';
    print $postal1;
    print '-';
    print $postal2;
    print '<br /><br />';
}

if(preg_match('/^[0-9]+$/',$postal2)==0)
{
    print '郵便番号は半角数字で入力してください。<br /><br />';
    $okflg=false;
}

if($address=='')
{
    print 'ご住所が入力されておりません。<br /><br />';
}
else
{
    print 'ご住所<br />';
    print $address;
    print '<br /><br />';
}

if(preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/',$tel)==0)
{
    print '電話番号を正確に入力してください。<br /><br />';
    $okflg=false;
}
else
{
    print '電話番号<br />';
    print $tel;
    print '<br /><br />';
}

if($chumon=='chumontouroku')
{
    if($pass=='')
    {
        print 'パスワードが入力されておりません。<br /><br />';
        $okflg=false;
    }
     if($pass!==$pass2)
    {
        print 'パスワードが一致しません。<br /><br />';
        $okflg=false;
    }
    print '性別<br />';
     if($danjo=='dan')
     {
        print '男性';
     }
     else
     {
        print '女性';
     }
     print '生まれ年<br />';
     print $birth;
     print '年代';
     print '<br /><br />';
}

if($okflg==true)
{
    print '<form method="post" action="shop_form_done.php">';
    print '<input name="onamae" type="hidden" value="'.$onamae.'"><br/>';
    print '<input name="email" type="hidden" value="'.$email.'"><br/>';
    print '<input name="postal1" type="hidden" value="'.$postal1.'"><br/>';
    print '<input name="postal2" type="hidden" value="'.$postal2.'"><br/>';
    print '<input name="address" type="hidden" value="'.$address.'"><br/>';
    print '<input name="tel" type="hidden" value="'.$tel.'"><br/>';
    print '<input name="chumon" type="hidden" value="'.$chumon.'"><br/>';
    print '<input name="pass" type="hidden" value="'.$pass.'"><br/>';
    print '<input name="danjo" type="hidden" value="'.$danjo.'"><br/>';
    print '<input name="birth" type="hidden" value="'.$birth.'"><br/>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK">';
    print '</form>';
}
else
{
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';

}
?>

</body>
</html>


