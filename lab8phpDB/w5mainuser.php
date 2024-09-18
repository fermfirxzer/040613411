<?php include "connect.php"?>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
    
        <?php $stmt=$pdo->prepare("SELECT * FROM member");
        $index=1;
        $stmt->execute();
        while($row=$stmt->fetch()){ ?>
        <div style="padding:15px;text-align:center;">
            <a href="detailuser.php?username=?<?= $row["username"] ?>">
            <img src='./photo/member/<?=$index?>.jpg' width="250px" height="200px">
            </a>
            <br>
            Username : <?=$row["username"]?><br>
        </div>
        <?php } ?>
    </body>
</html>