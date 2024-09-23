<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
    <script>
        function confirmDelete(username) {
            var ans = confirm("ต้องการลบ username :" + username);
            if (ans == true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
                document.location = "delete.php?username=" + username;
        }

        function confirmEdit(username) {
            var ans = confirm("ต้องการแก้ไข username :" + username);
            if (ans == true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
                document.location = "workshop9.php?username=" + username;
        }
    </script>
</head>

<body>
    <form action="workshop6.php" method="GET">
        <input type="text" name="name" placeholder="ค้นหาด้วยชื่อ :"><br>
        <input type="submit" value="ค้นหา">
    </form>
    <a href="workshop7.php"><button>เพิ่มสมาชิก</button></a><br>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM member WHERE name LIKE ?");
    if (!empty($_GET) && isset($_GET["name"])) {
        $value = '%' . $_GET["name"] . '%';
    } else if (empty($_GET)) {
        $value = '%' . '%';
    }
    $stmt->bindParam(1, $value);
    $stmt->execute();
    ?>
    <?php
    while ($row = $stmt->fetch()) { ?>
        <div style="padding:10px">
            <h2><?= $row["username"] ?></h2>
            <?php if ($row["img"] != "") { ?>
                <a href="workshop5detail.php?username=<?= $row["username"] ?>">
                    <img src='./photo/member/<?= $row["img"] ?>' width="250px" height="200px">
                </a>
            <?php } else { ?>
                <div>don't have image : </div>
            <?php } ?>
            <br>
            email : <?= $row["email"] ?> <br>
            ที่อยู่ : <?= $row["address"] ?><br>
            <a href='#' onclick="confirmEdit('<?= $row["username"] ?>')">แก้ไข</a>
            <a href='#' onclick="confirmDelete('<?= $row["username"] ?>')">ลบ</a>
            <hr>
        </div>
    <?php }
    ?>
</body>

</html>