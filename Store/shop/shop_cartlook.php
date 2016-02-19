<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="./../images/favicon.jpg">
<meta charset="UTF-8">
<title>SNEAKER LAB.|スニーカーラボ</title>
<link rel="stylesheet" href="../css/store.css" type="text/css" />
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
  print '</div>';
  ?>

	<!-- cartjudge -->
<?php
	try
	{
		if(isset($_SESSION['cart'])==true)
		{
			$cart=$_SESSION['cart'];
			$kazu=$_SESSION['kazu'];
			$max=count($cart);
		}
		else
		{
			$max=0;
		}


		if ($max==0)
		{
			print 'カートに商品が入っていません。<br/>';
			print '<br/>';
			print '<a href="top.php">Topへ</a>';
			exit();
		}

		//var_dump($cart);
		//exit();

		$dsn='mysql:host=localhost;dbname=shop';
		$user='root';
		$password='yypass';
		//DB接続
		$dbh=new PDO($dsn,$user,$password);
		$dbh->query('SET NAMES utf8');

		foreach ($cart as $key => $val)
		{
			$sql='SELECT code,name,price,gazou FROM mst_product WHERE code=?';
			$stmt=$dbh->prepare($sql);
			$data[0]=$val;
			$stmt->execute($data);

			$rec=$stmt->fetch(PDO::FETCH_ASSOC);

			$pro_name[]=$rec['name'];
			$pro_price[]=$rec['price'];
			if($rec['gazou']=='')
			{
				$pro_gazou[]='';
			}
			else
			{
				$pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'"width="240px" height="180px">';
			}
		}
		$dbh=null;
	}
	catch(Exception $e)
	{
		print'ただいま障害により大変ご迷惑をお掛けしております。<br/>';
		print $e;
		exit();
	}
	?>
  <div align="center">
    <div id ="carttext">
	Cart<br/>
</div>
	<br/>
	<table border="1">
		<tr>
			<th>商品</th>
			<th>商品画像</th>
			<th>価格</th>
			<th>数量</th>
			<th>小計</th>
			<th>削除</th>
		</tr>

	<form method="post" action="kazu_change.php">
	<?php
    $sum=0;
    $kosuu=0;
		for($i=0;$i<$max;$i++)
		{
	?>
	<tr>
		<td><?php print $pro_name[$i]; ?></td>
		<td><?php print $pro_gazou[$i]; ?></td>
		<td><?php print $pro_price[$i]; ?>円</td>
		<td><input type="text" name="kazu<?php print $i; ?>" value="<?php print $kazu[$i]; ?>" ></td>
		<td><?php print $pro_price[$i]*$kazu[$i]; ?>円</td>
		<td><input type="checkbox" name="sakujo<?php print $i; ?>"></td>
	</tr>
	<?php
    $kosuu = $kosuu + $kazu[$i];
    $sum = $sum + $pro_price[$i]*$kazu[$i];
		}
	?>
  <tr><td></td><td></td><td>合計</td><td><?php print $kosuu ?>点</td><td><?php print $sum ?>円</td><td></td></tr>
	</table>
  <br/>
	<input type="hidden" name="max" value="<?php print $max; ?>">
	<input type="submit" value="数量変更">
	<input type="button" onclick="history.back()" value="戻る">
</div>
	</form>
	<br/>
	<a href="shop_form.html">ご購入手続きへ進む</a><br/>
	<?php
	if(isset($_SESSION["member_login"])==true)
	{
		print '<a href="shop_kantan_check.php">会員かんたん注文へ進む</a><br />';
	}
?>
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
