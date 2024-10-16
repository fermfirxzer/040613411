<?php include "connect.php" ?>
<?php
if(!empty($_POST)){
$stmt = $pdo->prepare("UPDATE member SET name=?,address=?,mobile=?,email=? WHERE username=?");
$stmt->bindParam(1, $_POST["name"]);
$stmt->bindParam(2, $_POST["address"]);
$stmt->bindParam(3, $_POST["mobile"]);
$stmt->bindParam(4, $_POST["email"]);
$stmt->bindParam(5,$_POST["username"]);
if ($stmt->execute()){
header("location:member_All.php");
}
}
?>
<?php $stmt = $pdo->prepare("SELECT * FROM member WHERE username=?");

if (!empty($_GET) && isset($_GET["username"])) {

    $stmt->bindParam(1, $_GET["username"]);
    $stmt->execute();
    $row = $stmt->fetch();
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
            <form action="member_edit.php" method="POST">
                <input type="hidden" name="username" value="<?= $row["username"] ?>">
               
                name : <input type="text" name="name" value="<?= $row["name"]?>" required><br>
                 Address : <br>
                 <input type="text" name="address" value="<?= $row["address"]?>">
                mobile : <input type="text" name="mobile" value="<?= $row["mobile"] ?>"><br>
                email : <input type="email" name="email" value="<?= $row["email"] ?>" required><br>
                
                <input type="submit" value="ยีนยันแก้ไขสมาชิก">
                <button type="button" onclick="window.location.href='member_All.php';">ยกเลิก</button>
            </form>
        </article>
            <?php include "./component/menu.php" ?>
            <?php include "./component/aside.php" ?>
    </main>

    <?php include "./component/footer.php" ?>
</body>

</html>