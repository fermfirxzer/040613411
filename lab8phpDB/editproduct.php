<?php include "connect.php"?>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php if(!empty($_POST)){
            print_r($_POST);
            $stmt = $pdo->prepare("UPDATE product SET pname = ?, pdetail = ?, price = ?, img = ? WHERE pid = ?");
            $stmt->bindParam(1, $_POST["pname"]);
            $stmt->bindParam(2, $_POST["pdetail"]);
            $stmt->bindParam(3, $_POST["price"]);
            $stmt->bindParam(4, $_POST["img"]);
            $stmt->bindParam(5, $_POST["pid"]); 
            if ($stmt->execute()) {
                header("location:Allproduct.php");
            } else {
                // Error handling
            }
        } ?>
        <?php $stmt=$pdo->prepare("SELECT * FROM product WHERE pid=?");
        
        if(!empty($_GET)&&isset($_GET["pid"])){

        $stmt->bindParam(1,$_GET["pid"]);
        $stmt->execute();
        $row=$stmt->fetch();
        $old_id=$_GET["pid"];
        }
        ?>
        
        <form action="editproduct.php" method="POST">
        <input type="hidden" name="pid" value="<?=$row["pid"]?>">
        ชื่อสินค้า : <input type="text" name="pname" value="<?=$row["pname"]?>" require><br>
        รายละเอียดสินค้า : <input type="text" name="pdetail" value="<?=$row["pdetail"]?>" require><br>
        ราคา : <input type="text" name="price" value="<?=$row["price"]?>" require><br>
        เพิ่มรูปสินค้า : <input type="file" id="img" name="img" value="<?=$row["img"]?>">

        <input type="submit" value="แก้ไขสินค้า">
    </form>
    </body>
</html>