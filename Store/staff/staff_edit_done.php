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
	<?php
	session_start();
	session_regenerate_id(true);
	if (isset($_SESSION['login'])==false)
	{
		print 'ログインしてください。<br/>';
		print '<a href="../staff_login/staff_login.html"><img src="../images/login.png"><img src="../images/login.jpg" width="30px" height="30px"></a>';
		exit();
	}
	//add2
	else
	{
		print '<a href="staff_logout.php"><img src="../images/logout.png"><img src="../images/logout.jpeg" width="30px" height="30px"></a>';
		print '<br/>';
		print $_SESSION['staff_name'];
		print 'さんログイン中';
		print '<br/>';
	}
	?>

	<div id="stafflogin">
		<div id="stafftext">
			StaffEditDone<br/>
		</div>
<?php

try
{

require_once('../common/common.php');

$post=sanitize($_POST);

$staff_code=$post['code'];
$staff_name=$post['name'];
$staff_hobby=$post['hobby'];
$staff_birth=$post['birth'];
$staff_pass=$post['pass'];

$dsn='mysql:host=localhost;dbname=shop';
$user='root';
$password='yypass';


//print($dns);
print'<br/>';

$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='UPDATE mst_staff SET name=?,password=?,hobby=?,birth=? WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$staff_name;
$data[]=$staff_pass;
$data[]=$staff_birth;
$data[]=$staff_hobby;
$data[]=$staff_code;
$stmt->execute($data);

$stmt=null;

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。<br/>';
	print $e;
}
?>
修正しました。</br>
</br>
<a href="staff_list.php">戻る</a>
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
