<?php include "connect.php" ?>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <?php $stmt = $pdo->prepare("SELECT * FROM product WHERE pname=?");

    if (!empty($_GET) && isset($_GET["pname"])) {

        $stmt->bindParam(1, $_GET["pname"]);
        $stmt->execute();
        $row = $stmt->fetch();
    }
    ?>
    <div>
        <?php if ($row["img"] != "") { ?>
           
            <img src="./photo/product/<?= $row["img"] ?>" width="250" height="200"><br>
        <?php } else { ?>
            <div>don't have image : </div><br>
        <?php } ?>
        <div style="padding:15px">
            <h2><?= $row["pname"] ?></h2>
            รายละเอียดสนค้า : <?= $row["pdetail"] ?> <br>
            ราคา : <?= $row["price"] ?><br>
        </div>
    </div>
</body>

</html>