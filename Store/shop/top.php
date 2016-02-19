<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="./../images/favicon.jpg">
<meta charset="UTF-8">
<title>SNEAKER LAB.|スニーカーラボ</title>
<link rel="stylesheet" href="../css/flexslider.css" type="text/css" />
<link rel="stylesheet" href="../css/store.css" type="text/css" />
<script src="../jquery/jquery.js"></script>
<script src="../jquery/jquery.flexslider.js"></script>

<!-- sliderscript -->
<script type="text/javascript" charset="utf-8">
$(window).load(function() {
$('.flexslider').flexslider();
});
</script>

</head>


<body >
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


  <div class="flexslider">
    <ul class="slides">
      <li><img src="../images/top_00.png" /></li>
      <li><img src="../images/top_01.png" /></li>
      <li><img src="../images/top_02.png" /></li>
      <li><img src="../images/top_03.png" /></li>
      <li><img src="../images/top_04.png" /></li>
      <li><img src="../images/top_05.png" /></li>
    </ul>
  </div>

  <div id="brand">
    <table>

    </table>
  </div>

  <?php
  try
  {

  $dsn='mysql:host=localhost;dbname=shop';
  $user='root';
  $password='yypass';

  print'<!-- BrandList Section -->';
  //DB接続
  $dbh=new PDO($dsn,$user,$password);
  $dbh->query('SET NAMES utf8');

  $sql='SELECT code,name,image FROM mst_brand WHERE 1';
  $stmt=$dbh->prepare($sql);
  $stmt->execute();

  $dbh=null;

  print'<div align="center"><div id="brandlist">';
  print'Brand List<br/><br/>';
  print'</div>';

  $cnt=0;
  print'<table><tr>';
  while(true)
  {
  	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
    $disp_gazou='<img class="photo" src="../product/brand_image/'.$rec['image'].'" width="120px" height="70px">';
  	if($rec==false)
  	{
      print'</tr></table>';
  		break;
  	}
  	print'<td><a href="shop_brand.php?brandcode='.$rec['code'].'">';
    print $disp_gazou;
  	print '</a></td>';

    $cnt++;
    if($cnt%8==0){
      print'</tr><tr>';
    }
  }
  print'</div>';
  print'<br/>';
  print'<br/>';



  print'<!-- NewArraival Section -->';

  //DB接続
  $dbh=new PDO($dsn,$user,$password);
  $dbh->query('SET NAMES utf8');

  $sql='SELECT code,name,price,gazou,code_brand FROM mst_product WHERE 1';
  $stmt=$dbh->prepare($sql);
  $stmt->execute();

  $dbh=null;

  print'<div align="center" id="newarrival">';
  print'New Arrival<br/><br/>';


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
  	print'<td><a href="shop_product.php?procode='.$rec['code'].'">';
    print $disp_gazou;
  	print '</a></td>';

    $cnt++;
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
  print'</div>';
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
