<?php include "connect.php" ?>
<?php
$pid = 0;
if (!empty($_POST)) {
    $stmt = $pdo->prepare("INSERT INTO product (pname,pdetail,price,img) VALUES (?, ?, ?,?)");
    $stmt->bindParam(1, $_POST["pname"]);
    $stmt->bindParam(2, $_POST["detail"]);
    $stmt->bindParam(3, $_POST["price"]);
    $stmt->bindParam(4, $_POST["img"]);
    if ($stmt->execute()) {
        header("location:Allproduct.php");
    } 
    $pid = $pdo->lastInsertId();    
}
?>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <?php if ($pid != 0) {
        echo "<p>เพิ่มสนค้าสินค้าสำเร็จ <?=$pid?>";
    } ?>

    <form action="insertproduct.php" method="post">
        ชื่อสินค้า : <input type="text" name="pname"><br>
        รายละเอียดสนค้า :
        <input type="text" name="detail"><br>
        ราคา: <input type="number" name="price"><br>
        เพิ่มรูปสินค้า : <input type="file" id="img" name="img">
        <input type="submit" value="เพิ่มสินค้า">

    </form>
</body>

</html>