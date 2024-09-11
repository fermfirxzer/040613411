<?php include "connect.php"?>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <form action="workshop4.php" method="GET">
            <input type="text" name="name" placeholder="ค้นหาด้วยชื่อ :"><br>
            <input type="submit" value="ค้นหา">
        </form>
        <?php $stmt=$pdo->prepare("SELECT * FROM member WHERE name LIKE ?");
        
        if(!empty($_GET)&&isset($_GET["name"])){
            $value='%'.$_GET["name"].'%';
        
        $stmt->bindParam(1,$value);
        $stmt->execute();
        $index=1;
        while($row=$stmt->fetch()){ ?>
            ชื่อสมาชิก : <?=$row["name"] ?> <br>
            ที่อยู่ : <?=$row["address"] ?> <br>
            อีเมล์ : <?=$row["email"] ?> <br>
            <img src='./photo/member/<?=$index?>.jpg' width="250px" height="200px"> <br>
            <?php $index++ ?>
            <hr>
        <?php } ?>
        <?php if($index=1){
            echo "ไม่พบชื่อผู้ใช้งาน";
        }
    }
    ?>
    </body>
</html>