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
		$brand_code=$_GET['brandcode'];
		$dsn='mysql:host=localhost;dbname=shop';
		$user='root';
		$password='yypass';
		//DB接続
		$dbh=new PDO($dsn,$user,$password);
		$dbh->query('SET NAMES utf8');

		$sql='SELECT code,name,image FROM mst_brand WHERE code=?';
		$stmt=$dbh->prepare($sql);
		$data[]=$brand_code;
		$stmt->execute($data);

		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
    $brand=$rec['code'];
		$brand_name=$rec['name'];
		$brand_image_name=$rec['image'];


		$dbh=null;
		if ($brand_image_name=='')
		{
			$disp_image='';
		}
		else
		{
			$disp_image='<img src="../product/brand_image/'.$brand_image_name.'">';
		}
	}
	catch(Exception $e)
	{
		print'ただいま障害により大変ご迷惑をお掛けしております。<br/>';
		print $e;
		exit();
	}
	?>


	<div align="center" id="shopproduct">
	<div id="productdetail">
	BrandName<br/>
	<?php print $disp_image; ?><br/>
  <br/>
</div>
<?php

try
{

$dsn='mysql:host=localhost;dbname=shop';
$user='root';

//Applications/XAMPP/xamppfiles/phpmyadmin/config.inc.php
$password='yypass';

//DB接続
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='SELECT code,name,price,gazou,code_brand FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;
print'<div id="productlist">';
print'Product List<br/>';
print'</div>';


$cnt=0;
print'<table><tr>';
while(true)
{
  $rec=$stmt->fetch(PDO::FETCH_ASSOC);
  $disp_gazou='<img class="photo" src="../product/gazou/'.$rec['gazou'].'" width="160px" height="120px">';
  if($rec==false)
  {
    print'</tr></table>';
    break;
  }
  if($rec['code_brand']==$brand){
    print'<td><a href="shop_product.php?procode='.$rec['code'].'">';
      print $disp_gazou;
      print '</a></td>';
      $cnt++;
    }
    if($cnt%6==0){
      print'</tr><tr>';
      }
    }



}
catch(Exception $e)
{
  print'ただいま障害により大変ご迷惑をお掛けしております。<br/>';
  print $e;
  exit();
}
?>

	<form>
		<input type="button" onclick="history.back()" value="戻る">
	</form>
</div>
</body>
</html>
