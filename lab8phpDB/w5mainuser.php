<?php include "connect.php" ?>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>

    <?php $stmt = $pdo->prepare("SELECT * FROM member");
    $index = 1;
    $stmt->execute();
    while ($row = $stmt->fetch()) { ?>
        <div style="padding:15px;">

            <?php if ($row["img"] != "") { ?>
                <a href="workshop5detail.php?username=<?= $row["username"] ?>">
                    <img src='./photo/member/<?= $row["img"] ?>' width="250px" height="200px">
                </a>
            <?php }else{ ?>
                <div>don't have image : </div>
            <?php } ?>

            <br>
            Username : <?= $row["username"] ?><br>
            Email : <?= $row["email"] ?><br>
            Address :<?= $row["address"] ?><br>
            <hr>
            <?php $index++ ?>
        </div>
    <?php } ?>
</body>

</html>