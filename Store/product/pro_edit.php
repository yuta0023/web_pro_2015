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
		$pro_code=$_GET['procode'];
		$dsn='mysql:host=localhost;dbname=shop';
		$user='root';
		$password='yypass';
		//DB接続
		$dbh=new PDO($dsn,$user,$password);
		//$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$dbh->query('SET NAMES utf8');
		
		$sql='SELECT name,price,gazou,producer,source FROM mst_product WHERE code=?';
		$stmt=$dbh->prepare($sql);
		$data[]=$pro_code;
		$stmt->execute($data);
		
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		$pro_name=$rec['name'];
		$pro_price=$rec['price'];
		$pro_gazou_name_old=$rec['gazou'];
		$pro_producer=$rec['producer'];
		$pro_source=$rec['source'];
		print($pro_name);

		$dbh=null;
		if ($pro_gazou_name_old=='')
		{
			$disp_gazou='';
		}
		else
		{
			$disp_gazou='<img src="./gazou/'.$pro_gazou_name_old.'">';
		}
	}
	catch(Exception $e)
	{
		print'ただいま障害により大変ご迷惑をお掛けしております。<br/>';
		print $e;
		exit();
	}
	?>
	商品修正<br/>
	<br/>
	商品コード
	<?php print $pro_code; ?>
	<form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
		<input type="hidden" name="code" value="<?php print $pro_code; ?>">
		<input type"hidden" name="gazou_name_old" value="<?php print $pro_gazou_name_old; ?>">
		<br/>商品名
		<input type="text" name="name" style="width:200px" value="<?php print $pro_name; ?>"><br/>
		価格を入力してください。<br/>
		<input type="text" name="price" style="width:50px" value="<?php print $pro_price; ?>">円<br/>
		<br/>
		<?php print $disp_gazou;?>
		<br/>
		画像を選んでください。<br/>
		<input type="file" name="gazou" style="width:400px"><br/>
		<br/>
		生産者を入力してください。<br/>
		<input type="text" name="producer" style="width:200px"><br/>
		生産地を入力してください。<br/>
		<input type="text" name="source" style="width:200px"><br/>
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="OK">
	</form>
</body>
</html>