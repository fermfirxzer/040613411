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
        <div style="padding:15px;">
            <a href="workshop5detail.php?username=<?= $row["username"] ?>">
            <img src='./photo/member/<?=$index?>.jpg' width="250px" height="200px">
            </a>
            
            <br>
            Username : <?=$row["username"]?><br>
            Email : <?=$row["email"]?><br>
            Address :<?=$row["address"]?><br>
            <hr>
            <?php $index++ ?>
        </div>
        <?php } ?>
    </body>
</html>