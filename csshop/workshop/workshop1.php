<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
    <style>
        table,th,td{
            border:1px solid black;
        }
        </style>
</head>

<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM product");
    $stmt->execute();?>
    <table>

    <tr>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th>รายละเอียดสินค้า</th>
        <th>ราคาสินค้า</th>
    </tr>
    <?php while ($row = $stmt->fetch()) {?>
        <tr>
        <td> รหัสสินค้า : <?= $row["pid"] ?></td>
        <td> ชื่อสินค้า : <?= $row["pname"] ?></td>
        <td> รายละเอียดสินค้า : <?= $row["pdetail"] ?></td>
        <td> ราคา : <?= $row["price"] ?> บาท</td>
    </tr>
    <?php } ?>
    </table>
</body>

</html>