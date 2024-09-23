<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
    <script>
        function confirmDelete(pid) {
            var ans = confirm("ต้องการลบ pid :" + pid);
            if (ans == true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
                document.location = "deleteproduct.php?pid=" + pid;
        }

        function confirmEdit(pid) {
            var ans = confirm("ต้องการแก้ไข pid :" + pid);
            if (ans == true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
                document.location = "editproduct.php?pid=" + pid;
        }
    </script>
</head>

<body>
    <form action="Allproduct.php" method="GET">
        <input type="text" name="pname" placeholder="ค้นหาสินค้าด้วยชื่อ :"><br>
        <input type="submit" value="ค้นหา">
    </form>
    <a href="insertproduct.php">
        <button>เพิ่มสินค้า </button>
    </a>
    <br>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM product WHERE pname LIKE ?");
    if (!empty($_GET) && isset($_GET["pname"])) {
        $value = '%' . $_GET["pname"] . '%';
    } else if (empty($_GET)) {
        $value = '%' . '%';
    }
    $stmt->bindParam(1, $value);
    $stmt->execute();
    ?>
    <div>
        <?php
        while ($row = $stmt->fetch()) { ?>
            รหัสสินค้า: <?= $row["pid"] ?><br>
            ชื่อสินค้า: <?= $row["pname"] ?><br>
            <?php if ($row["img"] != "") { ?>
                <a href="productdetail.php?pname=<?= $row["pname"] ?>">
                    <img src='photo/product/<?= $row["img"] ?>' width="250" height="200">
                </a><br>
            <?php } else { ?>
                <div>don't have image : </div>
            <?php } ?>
            รายละเอียดสินค้า: <?= $row["pdetail"] ?><br>
            ราคา: <?= $row["price"] ?> บาท<br>
            <a href="#" onclick="confirmEdit('<?= $row["pid"] ?>')">แก้ไข</a> |
            <a href="#" onclick="confirmDelete('<?= $row["pid"] ?>')">ลบ</a>
            <hr>
        <?php
        }

        ?>
    </div>
</body>

</html>