<?php
session_start();
include "connect.php";

// print_r($_SESSION['cart']);
// echo "<br>";
// print_r($_POST);

if(!empty($_SESSION["username"])){
    $username = $_SESSION["username"];
} else {
    $username = "unknown";
}
if(!empty($_POST['promotion'])){
    $stmt=$pdo->prepare("SELECT * FROM product WHERE pid=?");
    $stmt->bindParam(1,$_POST['promotion']);
    // $stmt->execute([$_POST['promotion']]);
    $stmt->execute();
    $promotion=$stmt->fetch();
    $pid=$promotion['pid'];
// print_r($promotion);
    $cart_item = array(
    'pid' => $promotion['pid'],
   'pname' => $promotion['pname'],
   'price' => $promotion['price'],
   'qty' => 1
);
if(array_key_exists($promotion['pid'], $_SESSION['cart']))
		$_SESSION['cart'][$pid]['qty'] +=1;
else
	    $_SESSION['cart'][$pid] = $cart_item;
}
// print_r($_SESSION['cart']);
try {
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("INSERT INTO orders (username, ord_date, status) VALUES (?, ?, 'wait')");
    $ord_date = date("Y-m-d H:i:s"); 
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $ord_date);
    $stmt->execute();

    $orderid = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO item (ord_id, pid, quantity) VALUES (?, ?, ?)");

    
    foreach ($_SESSION['cart'] as $item) {
        $stmt->execute([$orderid, $item['pid'], $item['qty']]);
    }

    $stmt = $pdo->prepare("UPDATE product SET quantity = quantity - ? WHERE pid = ?");

  
    foreach ($_SESSION['cart'] as $item) {
        $stmt->execute([$item['qty'], $item['pid']]);
    }

    // Commit the transaction
    $pdo->commit();
    
    echo "Order placed successfully! Order ID: " . $orderid;
    unset($_SESSION['cart']);
    header("Location: mpage.php?order=success");
    exit();
} catch (Exception $e) {
    // Roll back the transaction if something fails
    $pdo->rollBack();
    echo "Failed to place order: " . $e->getMessage();
}
?>
