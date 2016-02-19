<?php
	session_start();
	session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="./../images/favicon.jpg">
	<meta charset="UTF-8">
	<title>SNEAKER LAB.|スニーカーラボ</title>
	<link rel="stylesheet" href="../css/store.css" type="text/css" />
	<meta charset="UTF-8">
</head>
<body>
	<!-- topheader -->
	<div id="topheader">
	<header>
	  <div id="toplogo">
	  <a href="staff_login.html">
	    <img src="../images/logo.png" width="180px" height="40px">
	  </a>
	</div>
	</header>
	</div>

	<div id="stafflogin">
		<div id="stafftext">
			CreateAccount Done<br/>
		</div>
<br/>

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
$pass=$post['pass'];
$danjo=$post['danjo'];
$birth=$post['birth'];

$dsn='mysql:host=localhost;dbname=shop';
$user='root';
$password='yypass';

$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='LOCK TABLES dat_sales,dat_sales_product WRITE';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$lastmembercode=0;

	$sql='INSERT INTO dat_member (password,name,email,postal1,postal2,address,tel,danjo,born) VALUES (?,?,?,?,?,?,?,?,?)';
	$stmt=$dbh->prepare($sql);
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

	$sql='SELECT LAST_INSERT_ID()';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	$lastmembercode=$rec['LAST_INSERT_ID()'];


$dbh=null;

	print '会員登録が完了いたしました。<br />';
	print '次回からメールアドレスとパスワードでログインしてください。<br />';
	print 'ご注文が簡単にできるようになります。<br />';
	print '<br />';

}
catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	print $e;
	exit();
}

?>

<br />
<a href="member_login.html">Login画面へ</a>
</div>
<!-- footer -->
  <div id="footer">
  <footer>
    <div id="footertext">
    <p>Copyright © 2015 SNEAKER LAB. All Rights Reserved.</p>
  </div>
  </footer>
  </div>
</body>
</html>
