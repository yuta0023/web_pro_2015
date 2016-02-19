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
    <a href="top.php">
      <img src="../images/logo.png" width="180px" height="40px">
    </a>
  </div>
  </header>
  </div>

	<!-- secoundheader -->
	  <?php
	  print '<div id="secondheader">';
	  session_start();
	  session_regenerate_id(true);
	  if (isset($_SESSION['member_login'])==false)
	  {
	    print '<a href="member_login.html"><img src="../images/login.png"><img src="../images/login.jpg" width="30px" height="30px"></a>';
	    print '<a href="member_create_form.html"><img src="../images/account.png"><img src="../images/create.png" width="30px" height="30px"></a>';
	  }
	  else
	  {
	    print '<div id="username">';
	    print $_SESSION['member_name'];
	    print '様';
	    print '</div>';
	    print '<a href="member_logout.php"><img src="../images/logout.png"><img src="../images/logout.jpeg" width="30px" height="30px"></a>';
	  }
	  print '<a href="shop_cartlook.php"><img src="../images/cart.png"><img src="../images/cart.jpg" width="30px" height="30px"></a>';
	  print '</div>';
	  ?>

		<!-- customerinfo -->
			<div id="logininfo">
			  <div id="errortext">
					Login Error<br/>
				</div>
<?php

try
{

require_once('../common/common.php');

$post=sanitize($_POST);
$member_email=$post['email'];
$member_pass=$post['pass'];

$member_pass=md5($member_pass);

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='yypass';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name FROM dat_member WHERE email=? AND password=?';
$stmt=$dbh->prepare($sql);
$data[]=$member_email;
$data[]=$member_pass;
$stmt->execute($data);

$dbh=null;

$rec=$stmt->fetch(PDO::FETCH_ASSOC);

if($rec==false)
{
	print 'メールアドレスかパスワードが間違っています。<br />';
	print '<a href="member_login.html"> 戻る</a>';
}
else
{
	session_start();
	$_SESSION['member_login']=1;
	$_SESSION['member_code']=$rec['code'];
	$_SESSION['member_name']=$rec['name'];
	header('Location:top.php');
	exit();
}

}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>
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
