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


		if(isset($_SESSION['cart'])==true)
		{
			$cart=$_SESSION['cart'];
			$kazu=$_SESSION['kazu'];
			if(in_array($pro_code,$cart)==true)
			{
				print 'その商品はすでにカートに入ってます。<br/>';
				print '<a href="top.php">商品一覧に戻る</a>';
				exit();
			}
		}

		$cart[]=$pro_code;
		$kazu[]=1;
		$_SESSION['cart']=$cart;
		$_SESSION['kazu']=$kazu;
	}
	catch(Exception $e)
	{
		print'ただいま障害により大変ご迷惑をお掛けしております。<br/>';
		print $e;
		exit();
	}
	?>

	カートに追加しました。<br/>
	<br/>
	<a href="top.php">商品一覧に戻る</a>

</body>
</html>
