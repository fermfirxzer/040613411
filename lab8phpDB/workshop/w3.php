<?php include "connect.php"?>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php $stmt=$pdo->prepare("SELECT * FROM member");
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
    </body>
</html>