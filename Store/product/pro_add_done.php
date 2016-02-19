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

$pro_name=$post['name'];
$pro_price=$post['price'];
$pro_gzou_name=$_POST['gazou_name'];
$brand_code=$post['brandcode'];



$dsn='mysql:host=localhost;dbname=shop';
$user='root';
$password='yypass';


//print($dsn);
print'<br/>';

$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='INSERT INTO mst_product(name,price,gazou,code_brand) VALUES (?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data[]=$pro_name;
$data[]=$pro_price;
$data[]=$pro_gzou_name;
$data[]=$brand_code;
$stmt->execute($data);

$stmt=null;

print $pro_name;
print'を追加しました。<br/>';


}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。<br/>';
	print $e;
}
?>

<a href="pro_list.php">戻る</a>

</body>
</html>
