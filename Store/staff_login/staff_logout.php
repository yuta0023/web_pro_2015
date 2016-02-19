<?php
$_SESSION=array();
session_regenerate_id(true);
if (isset($_COOKIE[session_name()])==true)
{
	setcookie(session_name(),'',time()-42000,'/');
}
@session_destroy();

header('Location:staff_login.html');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
ログアウトしました。<br/>
<br/>
<a href="../staff_login/staff_login.html">ログイン画面へ</a>
</body>
</html>
