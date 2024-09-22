<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
    <script>
        function confirmDelete(pid) { // ฟังก์ชนจะถูกเรียกถ้าผู้ใช ั คลิกที่ ้ link ลบ
            var ans = confirm("ต ้องการลบสนค ้ารหัส ิ " + pid); // แสดงกล่องถามผู้ใช ้
            if (ans == true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
                document.location = "delete.php?pid=" + pid; // สงรหัสส ่ นค ้าไปให ้ไฟล์ ิ delete.php
        }
    </script>
</head>

<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()) { ?>
        ชื่อสมาชิก : <?= $row["name"] ?> <br>
        ที่อยู่ : <?= $row["address"] ?> <br>
        อีเมล์ : <?= $row["email"] ?> <br>
        <img src='./photo/member/<?= $index ?>.jpg' width="250px" height="200px"> <br>
        <?= "<a href='editform.php?pid=" . $row ["pid"] . "'>แก ้ไข</a> | "; ?>
        <?= "<a href='#' onclick='confirmDelete(" . $row ["pid"] . ")'>ลบ</a>"; ?>
        <?php $index++ ?>
        <hr>
    <?php } ?>

</body>

</html>