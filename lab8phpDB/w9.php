<?php include "connect.php" ?>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <?php $stmt = $pdo->prepare("SELECT * FROM member WHERE username=?");

    if (!empty($_GET) && isset($_GET["username"])) {

        $stmt->bindParam(1, $_GET["username"]);
        $stmt->execute();
        $row = $stmt->fetch();
        $old_username = $_GET["username"];
    }
    ?>
    <?php
    if (!empty($_POST)) {
        print_r($_POST);
        $stmt = $pdo->prepare("UPDATE member SET username=?,password=?,name=?,address=?,mobile=?,email=?,img=? WHERE username=?");
        $stmt->bindParam(1, $_POST["username"]);
        $stmt->bindParam(2, $_POST["password"]);
        $stmt->bindParam(3, $_POST["name"]);
        $stmt->bindParam(4, $_POST["address"]);
        $stmt->bindParam(5, $_POST["mobile"]);
        $stmt->bindParam(6, $_POST["email"]);
        $stmt->bindParam(7, $_POST["img"]);
        $stmt->bindParam(8, $_POST["old_username"]);
        if ($stmt->execute())
            header("location:workshop6.php");
    }
    ?>
    <form action="workshop9.php" method="POST">
        <input type="hidden" name="old_username" value="<?= $old_username ?>">
        username : <input type="text" name="username" value="<?= $row["username"] ?>" require><br>
        password : <input type="text" name="password" value="<?= $row["password"] ?>" require><br>
        name : <input type="text" name="name" value="<?= $row["name"] ?>" require><br>
        Address : <input type="text" name="address" size=35 value="<?= $row["address"] ?>"></textarea><br>
        mobile : <input type="text" name="mobile" value="<?= $row["mobile"] ?>"><br>
        email : <input type="email" name="email" value="<?= $row["email"] ?>" require><br>
        รูปภาพสมาชิก : <input type="file" name="img"><br>
        <input type="submit" value="ยีนยัน">
    </form>
</body>

</html>