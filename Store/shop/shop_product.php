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
  print '<a href="shop_cartlook.php"><img src="../images/cart.png"><img src="../images/cart.jpg" width="30px" height="30px"></a>';
  print '</div>';
  ?>

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

		$sql='SELECT name,price,gazou,code_brand FROM mst_product WHERE code=?';
		$stmt=$dbh->prepare($sql);
		$data[]=$pro_code;
		$stmt->execute($data);

		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		$pro_name=$rec['name'];
		$pro_price=$rec['price'];
		$pro_gazou_name=$rec['gazou'];


		$dbh=null;
		if ($pro_gazou_name=='')
		{
			$disp_gazou='';
		}
		else
		{
			$disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
		}
	}
	catch(Exception $e)
	{
		print'ただいま障害により大変ご迷惑をお掛けしております。<br/>';
		print $e;
		exit();
	}
	?>
	<div align="center" id='shopproduct'>
	<div id='productdetail'>
    <br/>
    ProductDetail
  </div>
  <br/>
    <table border="1px">
      <tr>
        <th width="100px">商品名</th>
        <th width="100px">価格</th>
        <th>商品画像</th>
      </tr>
      <tr>
        <td align="center"><?php print $pro_name; ?></td>
        <td align="center"><?php print $pro_price; ?>円</td>
        <td><?php print $disp_gazou; ?></td>
      </tr>
    </table>
<br/>
  <?php print'<a href="shop_brand.php?brandcode='.$rec['code_brand'].'">関連商品</a>'; ?>
	<?php print'<a href="shop_cartin.php?procode='.$pro_code.'"> カートに入れる</a><br/><br/>'; ?>
	<form>
		<input type="button" onclick="history.back()" value="戻る">
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
