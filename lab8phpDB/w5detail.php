<?php include "connect.php"?>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php $stmt=$pdo->prepare("SELECT * FROM member WHERE username=?");
        
        if(!empty($_GET)&&isset($_GET["username"])){

        $stmt->bindParam(1,$_GET["username"]);
        $stmt->execute();
        $row=$stmt->fetch();
        }
        ?>
        <div style="display: flex;">
            <div>
                <img src="./photo/member/<?=$row["img"]?>" width="200">
            </div>
            <div style="padding:15px">
                <h2><?=$row["username"]?></h2>
                email : <?=$row["email"]?> <br>
                ที่อยู่ : <?=$row["address"]?><br>
            </div>
        </div>
    </body>
</html>