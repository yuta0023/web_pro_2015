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
			StaffEdit<br/>
		</div>
<?php
	try
	{
		$staff_code=$_GET['staffcode'];
		$dsn='mysql:host=localhost;dbname=shop';
		$user='root';
		$password='yypass';
		//DB接続
		$dbh=new PDO($dsn,$user,$password);
		$dbh->query('SET NAMES utf8');

		$sql='SELECT name FROM mst_staff WHERE code=?';
		$stmt=$dbh->prepare($sql);
		$data[]=$staff_code;
		$stmt->execute($data);

		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		$staff_name=$rec['name'];

		$dbh=null;
	}
	catch(Exception $e)
	{
		print'ただいま障害により大変ご迷惑をお掛けしております。<br/>';
		print $e;
		exit();
	}
	?>

	スタッフコード<br/>
	<?php print $staff_code; ?>
	<form method="post" action="staff_edit_check.php">
		<input type="hidden" name="code" value="<?php print $staff_code; ?>">
		スタッフ名<br/>
		<input type="text" name="name" style="width:200px" value="<?php print $staff_name; ?>"><br/>
		あなたの趣味は？<br/>
		<input type="text" name="hobby" style="width:200px"><br/>
		生年月日(ex.19941112)<br/>
		<input type="text" name="birth" style="width:200px"><br/>
		パスワードを入力してください。<br/>
		<input type="password" name="pass" style="width:100px"><br/>
		パスワードをもう一度入力してください。<br/>
		<input type="password" name="pass2" style="width:100px"><br/>
		<br/>
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="OK">
	</form>
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
