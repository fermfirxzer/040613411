<?php include "connect.php" ?>
<?php $insert = false;
    $error = "";
    
    ?>

    <?php if (!empty($_POST) && isset($_POST)) {
        $stmt = $pdo->prepare("SELECT * FROM member WHERE username=?");
        $stmt->bindParam(1, $_POST["username"]);
        $stmt->execute();
        if ($stmt->fetch()) {
            $error = "Username Already Taken!";
        } else {
            $stmt = $pdo->prepare("SELECT * FROM member WHERE email=?");
            $stmt->bindParam(1, $_POST["email"]);
            $stmt->execute();
            if ($stmt->fetch()) {
                $error = "Email Already Taken!";
            } else {
                $stmt = $pdo->prepare("INSERT INTO member (username, password, name, address, mobile, email,img) VALUES (?, ?, ?, ?, ?, ?,?)");
                $stmt->bindParam(1, $_POST["username"]);
                $stmt->bindParam(2, $_POST["password"]);
                $stmt->bindParam(3, $_POST["name"]);
                $stmt->bindParam(4, $_POST["address"]);
                $stmt->bindParam(5, $_POST["mobile"]);
                $stmt->bindParam(6, $_POST["email"]);
                $stmt->bindParam(7, $_POST["img"]);
                if ($stmt->execute()) {
                    header("location:workshop6.php");
                    exit();
                } else {
                    $error = "Failed to insert data!";
                }
            }
        }
    } ?>
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
           
    <h3>เพิ่มข้อมูล User : </h3>
    <form action="workshop7.php" method="post">
        username : <input type="text" name="username" required><br>
        password : <input type="text" name="password" required><br>
        name : <input type="text" name="name" required><br>
        Address : <br>
        <textarea name="address" rows="3" cols="40"></textarea><br>
        mobile : <input type="text" name="mobile"><br>
        email : <input type="email" name="email" required><br>
        เพิ่มรูปภาพสมาชิก : <input type="file" name="img"><br>
        <input type="submit" value="ยีนยัน">
    </form>
    <?php if ($insert == true) {
        echo "<span style='color:red;'>เพิ่มข้อมูลสำเร็จ</span>";
    } ?>
    <?php if ($error != "") {
        echo "<span style='color:red;'> $error </span>";
    } ?>
    </article>
    <?php include "./component/menu.php" ?>
    <?php include "./component/aside.php" ?>
</main>
<?php include "./component/footer.php" ?>
</body>

</html>