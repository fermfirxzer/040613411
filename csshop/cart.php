<?php
include "connect.php";
session_start();
// เพิ่มสินค้า
if ($_GET["action"]=="add") {

	$pid = $_GET['pid'];

	$cart_item = array(
 		'pid' => $pid,
		'pname' => $_GET['pname'],
		'price' => $_GET['price'],
		'qty' => $_POST['qty']
	);

	// ถ้ายังไม่มีสินค้าใดๆในรถเข็น
	if(empty($_SESSION['cart']))
    	$_SESSION['cart'] = array();
 
	// ถ้ามีสินค้านั้นอยู่แล้วให้บวกเพิ่ม
	if(array_key_exists($pid, $_SESSION['cart']))
		$_SESSION['cart'][$pid]['qty'] += $_POST['qty'];
 
	// หากยังไม่เคยเลือกสินค้นนั้นจะ
	else
	    $_SESSION['cart'][$pid] = $cart_item;

// ปรับปรุงจำนวนสินค้า
} else if ($_GET["action"]=="update") {
	$pid = $_GET["pid"];     
	$qty = $_GET["qty"];
	$_SESSION['cart'][$pid]['qty'] = $qty;

} else if ($_GET["action"]=="delete") {
	
	$pid = $_GET['pid'];
	unset($_SESSION['cart'][$pid]);
	
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
	<script>
	// ใช้สำหรับปรับปรุงจำนวนสินค้า
	function update(pid) {
		var qty = document.getElementById(pid).value;
		// ส่งรหัสสินค้า และจำนวนไปปรับปรุงใน session
		document.location = "cart.php?action=update&pid=" + pid + "&qty=" + qty; 
	}
</script>
<style>
	p{
		margin:0;
	}
	</style>
</head>
<body>
    <?php include "./component/head.php" ?>
    <?php include "./component/mobile_bar.php" ?>
    <main>
        <article>
	<form>
	<p> <?php if(empty($_SESSION['cart'])){echo "ไม่มีสินค้าในตะกร้า";} ?></p> 
	<table border="1">
<?php 
	print_r($_SESSION['cart']);
	
	$sum = 0;
	foreach ($_SESSION["cart"] as $item) {
		$sum += $item["price"] * $item["qty"];
	?>
	<tr>
		<td><?=$item["pname"]?></td>
		<td><?=$item["price"]?></td>
		<td>			
			<input type="number" id="<?=$item["pid"]?>" value="<?=$item["qty"]?>" min="1" max="9">
			<a href="#" onclick="update(<?=$item["pid"]?>)">แก้ไข</a>
			<a href="?action=delete&pid=<?=$item["pid"]?>">ลบ</a>
		</td>
	</tr>
<?php } ?>
	<tr><td colspan="3" align="right">รวม <?=$sum?> บาท</td></tr>
	</table>
	</form>
	
		<?php 
		$maxprice=0;
		$sumprice=0;
		if(!empty($_SESSION['cart'])){
			foreach($_SESSION['cart']as $item){
				
				if($item['price']>$maxprice){
					$maxprice=$item['price'];
				}
			}
		} 
		$promotion="";
		if (!empty($_SESSION['cart']) && empty($_SESSION['username']) && $sum >= 500) {
			$stmt=$pdo->prepare("SELECT * FROM product WHERE price<=500");
			
			$stmt->execute();
			$pro=$stmt->fetchAll();
			$promotion="คุณได้สามารถเลือกสินค้าที่มีมูลค่าน้อยกว่า 500 บาทได้";
		} else if (!empty($_SESSION['cart']) && !empty($_SESSION['username'])) {
			$stmt=$pdo->prepare("SELECT * FROM product WHERE price<=?");
			$stmt->bindParam(1,$maxprice);
			$stmt->execute();
			$pro=$stmt->fetchAll();
			$promotion="คุณได้สามารถเลือกสินค้าที่มีมูลค่าน้อยกว่า $maxprice บาทได้";
		} else {
			$promotion = "คุณไม่สามารถใช้ promotion ได้";
		}
		
		?> <h5><?php echo $promotion?></h5>
		
		<form method="post" action="buyproduct.php">
		<div style="display:flex;gap:10px">	
		<?php foreach($pro as $product){ ?>
			<div>
				<img src="./photo/product/<?=$product['img']?>" style="width:100px;"></img>
			<p>ชื่อสินค้า :<?=$product["pname"]?></p>
			<p>ราคา : <?=$product["price"]?></p>
			เลือก :<input type="radio" name="promotion" value="<?=$product['pid']?>" id="product-<?=$pro['pid']?>">
			</div>
		<?php } ?>
		
		</div>
		<button type="submit" value="ซื้อสินค้า">ซื้อสินค้า</button>
		</form>
		
		<!-- <select name="promotion">	
			<?php foreach($pro as $pro){ ?>
				<option value="<?= $pro["pname"]?>"><?= $pro["pname"] ?></option>
			<?php } ?>
		</select> -->
		
	<br>
<a href="mpage.php"><เลือกสินค้าต่อ</a>
			<br>

        </article>
        <?php include "./component/menu.php" ?>
        <?php include "./component/aside.php" ?>
    </main>
    <?php include "./component/footer.php" ?>
</body>

</html>
