<?php include "connect.php" ?>
<?php if (!empty($_POST)) {
    print_r($_POST);
    $stmt = $pdo->prepare("UPDATE product SET pname = ?, pdetail = ?, price = ?, img = ? WHERE pid = ?");
    $stmt->bindParam(1, $_POST["pname"]);
    $stmt->bindParam(2, $_POST["pdetail"]);
    $stmt->bindParam(3, $_POST["price"]);
    $stmt->bindParam(4, $_POST["img"]);
    $stmt->bindParam(5, $_POST["pid"]);
    if ($stmt->execute()) {
        header("location:Allproduct.php");
    } else {
        // Error handling
    }
} ?>
<?php $stmt = $pdo->prepare("SELECT * FROM product WHERE pid=?");

if (!empty($_GET) && isset($_GET["pid"])) {

    $stmt->bindParam(1, $_GET["pid"]);
    $stmt->execute();
    $row = $stmt->fetch();
    $old_id = $_GET["pid"];
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
            <form action="editproduct.php" method="POST">
                <input type="hidden" name="pid" value="<?= $row["pid"] ?>">
                ชื่อสินค้า : <input type="text" name="pname" value="<?= $row["pname"] ?>" require><br>
                รายละเอียดสินค้า : <input type="text" name="pdetail" value="<?= $row["pdetail"] ?>" require><br>
                ราคา : <input type="text" name="price" value="<?= $row["price"] ?>" require><br>
                เพิ่มรูปสินค้า : <input type="file" id="img" name="img" value="<?= $row["img"] ?>">

                <input type="submit" value="แก้ไขสินค้า">
            </form>
        </article>
            <?php include "./component/menu.php" ?>
            <?php include "./component/aside.php" ?>
    </main>

    <?php include "./component/footer.php" ?>
</body>

</html>