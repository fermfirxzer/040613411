<?php
include "connect.php";
session_start();
$stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
$stmt->bindParam(1, $_POST["username"]);
$stmt->bindParam(2, $_POST["password"]);
$stmt->execute();
$row = $stmt->fetch();
// หาก username และ password ตรงกัน จะมีข้อมูลในตัวแปร $row

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
            <form action="check-login.php" method="POST">
                Username: <input type="text" name="username"><br>
                Password: <input type="password" name="password"><br>
                <input type="submit" value="Login">
            </form>
            <?php if (!empty($row)) {
            session_regenerate_id();
    
            $_SESSION["fullname"] = $row["name"];
            $_SESSION["username"] = $row["username"];
 
            echo "เข้าสูระบบส ่ าเร็จ<br>";
            echo "<a href='user-home.php'>ไปยังหน้าหลักของผู้ใช<้ /a>";
    
        } else {
            echo "ไม่ส าเร็จ ชอหรือรหัสผ่านไม่ถูกต้อง ื่ ";
            echo "<a href='login-form.php'>เข้าสูระบบอีก ่ ครัง</a>"; 
        } ?>
        </article>
        <?php include "./component/menu.php" ?>
        <?php include "./component/aside.php" ?>
    </main>
    <?php include "./component/footer.php" ?>
</body>

</html>