<?php include "connect.php" ?>
<?php
    $pid=0;
    if(!empty($_POST)){
        $stmt = $pdo->prepare("INSERT INTO product VALUES ('', ?, ?, ?)");
        $stmt->bindParam(1, $_POST["pname"]);
        $stmt->bindParam(2, $_POST["pdetail"]);
        $stmt->bindParam(3, $_POST["price"]);
        $stmt->execute(); // เริ่มเพิ่มข้อมูล
        $pid = $pdo->lastInsertId(); // ขอคีย์หลักที่เพิ่มส าเร็จ   
    }
?>
<html>
<head><meta charset="UTF-8"></head>
<body>
    <?php if($pid!=0){
        echo "<p>เพิ่มสนค้าสินค้าสำเร็จ <?=$pid?>";
    } ?>
    
<form action="insertproduct.php" method="post">
    ชื่อสินค้า  : <input type="text" name="pname"><br>
    รายละเอียดสนค้า : <br>
    <textarea name="pdetail" rows="3" cols="40"></textarea><br>
    ราคา: <input type="number" name="price"><br>
    <input type="submit" value="เพิ่มสินค้า">
</form>
</body>
</html>