<?php include "connect.php" ?>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
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
</body>

</html>