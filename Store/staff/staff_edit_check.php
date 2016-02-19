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
			EditCheck<br/>
		</div>
<?php

require_once('../common/common.php');

$post=sanitize($_POST);

$staff_code=$post['code'];
$staff_name=$post['name'];
$staff_hobby=$post['hobby'];
$staff_birth=$post['birth'];
$staff_pass=$post['pass'];
$staff_pass2=$post['pass2'];

if($staff_name=='')
{
	print'スタッフ名が入力されていません。<br/>';
}
else
{
	print'スタッフ名:';
	print $staff_name;
	print'<br/>';
}


if($staff_hobby=='')
{
	print'趣味を入力してください。<br/>';
}
if($staff_birth=='')
{
	print'誕生日を入力してください。<br/>';
}

if($staff_pass=='')
{
	print'パスワードが入力されていません。<br/>';
}


if($staff_pass!==$staff_pass2)
{
	print'パスワードが一致しません。<br/>';
}

if($staff_name==''||$staff_hobby==''||$staff_birth==''||$staff_pass==''||$staff_pass!=$staff_pass2)
{
	print'<form>';
	print'<input type="button" onclick="history.back()" value="戻る">';
	print'</form>';
}
else
{
	$staff_pass=md5($staff_pass);
	print'<form method="post" action="staff_edit_done.php">';
	print'<input type"hidden" name="code" value="'.$staff_code.'">';
	print'<input type"hidden" name="name" value="'.$staff_name.'">';
	print'<input type"hidden" name="hobby" value="'.$staff_hobby.'">';
	print'<input type"hidden" name="birth" value="'.$staff_birth.'">';
	print'<input type"hidden" name="pass" value="'.$staff_pass.'">';
	print'<br/>';
	print'<input type="button" onclick="history.back()" value="戻る">';
	print'<input type="submit" value="OK">';
	print'</form>';
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
