<?php
	include "connect.php";
    session_start();
    if(!empty($_GET)){
        $stmt=$pdo->prepare("SELECT * FROM orders WHERE username=?");
        $stmt->bindParam(1,$_GET["username"]);
        $stmt->execute();

    }
?>
<html>

<head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="mcss.css" rel="stylesheet" type="text/css" />
    <script src="mpage.js"></script>
</head>

<body>
    <?php include "./component/head.php" ?>
    <?php include "./component/mobile_bar.php" ?>
    <main>
        <article>
            <div>
            <?php while($row=$stmt->fetch()){ ?>
                <p> order :<?= $row["ord_id"] ?> 
                        <?= $row["username"] ?>
                        <?= $row["ord_date"] ?>
                        <?= $row["status"] ?>
                     </p>

                <?php } ?>
            </div>
        </article>
        <?php include "./component/menu.php" ?>
        <?php include "./component/aside.php" ?>
    </main>
    <?php include "./component/footer.php" ?>
</body>

</html>