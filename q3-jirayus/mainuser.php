<?php include "connect.php" ?>
<?php session_start(); 
	if (	empty($_SESSION["username"]) ) {
		header("location:login.php");
		exit();
	}
?>

<?php if(!isset($_SESSION['cart'])){
		$_SESSION['cart']=array();
	}
	$username=$_SESSION["username"];
	if($_SESSION["Admin"]==true){
		$stmt=$pdo->prepare("SELECT username, COUNT(ord_id) AS order_count FROM orders GROUP BY username;");
		$stmt->execute();
		$order=$stmt->fetchAll();
	}else{
		$stmt=$pdo->prepare("SELECT * FROM orders JOIN product JOIN item WHERE username=? AND orders.ord_id=item.ord_id AND item.pid=product.pid");
		$stmt->bindParam(1,$username);
		$stmt->execute();
		$order=$stmt->fetchAll();
	}
?>

<html>

<head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="mcss.css" rel="stylesheet" type="text/css" />
    <script src="mpage.js"></script>
</head>

<body>
    <?php include "./component/head.php" ?>
    <?php include "./component/mobile_bar.php" ?>
    <main>
        <article>
	
	<a href="cart.php?action=">สินค้าในตะกร้า (<?=sizeof($_SESSION['cart'])?>)</a>
	<div style="display:flex">	
	<?php
		$stmt = $pdo->prepare("SELECT * FROM product");
		$stmt->execute();
		while ($row = $stmt->fetch()) { ?>
		<div style="padding: 15px; text-align: center">
			<a href="detail.php?pid=<?=$row["pid"]?>">
				<img src='photo/product/<?=$row["img"]?>' width='100'></a><br>
				<?=$row ["pname"]?><br><?=$row ["price"]?> บาท<br>	
			<form method="post" action="cart.php?action=add&pid=<?=$row["pid"]?>&pname=<?=$row["pname"]?>&price=<?=$row["price"]?>">
				<input type="number" name="qty" value="1" min="1" max="<?=$row["quantity"]?>">
				<input type="submit" value="ซื้อ">	   
			</form>
		</div>
	<?php } ?>
	</div>
				
				<h3> username :<?= $_SESSION["username"] ?></h3>
				<h3>Order : </h3>
				<?php if($_SESSION["Admin"]==true){ 
					 foreach($order as $order){ ?>
						<div class="orders">
							<a href="order-list.php?username=<?= $order["username"] ?>"> ชื่อสมาชิก :<?= $order["username"] ?>
								
							จำนวน order :<?= $order["order_count"] ?> </a>
					 	</div>
					<?php } 
				}else{ ?>
					<?php foreach($order as $order){ ?>
				<div class="orders" style="text-align:start;">
					<p><?= $order["ord_id"] ?> 
					<?= $order["pname"] ?> 
					<?= $order["quantity"] ?> 
					<?= $order["price"] ?>
					<?= $order["ord_date"] ?> </p>
				</div>
				<?php }
				} ?>
        </article>
        <?php include "./component/menu.php" ?>
        <?php include "./component/aside.php" ?>
    </main>
    <?php include "./component/footer.php" ?>
</body>

</html>