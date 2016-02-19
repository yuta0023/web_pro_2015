<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login'])==false)
{
	print 'ログインされていません。<br/>';
	print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
	exit();
}
else
{
	print $_SESSION['staff_name'];
	print 'さんログイン中<br/>';
	print '<br/>';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<?php

try
{
require_once('../common/common.php');

$post=sanitize($_POST);

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

$sql='INSERT INTO mst_staff(name,password,birth,hobby) VALUES (?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data[]=$staff_name;
$data[]=$staff_pass;
$data[]=$staff_birth;
$data[]=$staff_hobby;
$stmt->execute($data);

$stmt=null;

print $staff_name;
print'さんを追加しました。<br/>';


}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。<br/>';
	print $e;
}
?>

<a href="staff_list.php">戻る</a>

</body>
</html>