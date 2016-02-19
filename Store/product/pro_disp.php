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
		$dbh->query('SET NAMES utf8');
		
		$sql='SELECT name,price,gazou,producer,source FROM mst_product WHERE code=?';
		$stmt=$dbh->prepare($sql);
		$data[]=$pro_code;
		$stmt->execute($data);
		
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		$pro_name=$rec['name'];
		$pro_price=$rec['price'];
		$pro_gazou_name=$rec['gazou'];
		$pro_producer=$rec['producer'];
		$pro_source=$rec['source'];
		print($pro_name);

		$dbh=null;
		if ($pro_gazou_name=='')
		{
			$disp_gazou='';
		}
		else
		{
			$disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
		}
	}
	catch(Exception $e)
	{
		print'ただいま障害により大変ご迷惑をお掛けしております。<br/>';
		print $e;
		exit();
	}
	?>
	商品情報参照<br/>
	<br/>
	商品コード<br/>
	<?php print $pro_code; ?><br/>
	商品名<br/>
	<?php print $pro_name; ?><br/>
	価格<br/>
	<?php print $pro_price; ?><br/>
	<br/>
	<?php print $disp_gazou; ?><br/>
	生産者<br/>
	<?php print $pro_producer; ?><br/>
	生産地<br/>
	<?php print $pro_source; ?>
	<form>
		<input type="button" onclick="history.back()" value="戻る">
	</form>
</body>
</html>