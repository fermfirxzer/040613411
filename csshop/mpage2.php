
<?php
    include "connect.php";
    $stmt=$pdo->prepare("SELECT * FROM product");
    $stmt->execute();
    $product=$stmt->fetchAll();
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
    <style>
        h3{
            color:green;
        }
        table{
            margin:0 auto;
            border-collapse:collapse;
            border:1px solid black;
        }
        td+td,th+th{
            
            border-left:1px solid gray;
        }
        th{
            background:#AFEEEE;
            color:#00009E;
            border:1px solid gray;
            padding:0.5rem;
        }
        td{
            padding:0.5rem;
            border:1px solid gray;
            background:#EEEEEE;
        }
        article{
            text-align:center;
        }
        </style>
</head>

<body>
    <?php include "./component/head.php" ?>
    <?php include "./component/mobile_bar.php" ?>
    <main>
        <article>
            <h3>All PRODUCT</h3>
           <table>
            <tr>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>รายละเอียด</th>
                <th>ราคา</th>
                <th>จำนวน</th>
            </tr>
            <?php foreach($product as $product){ ?>
                    <tr>
                        <td><?= $product["pid"]?></td>
                        <td><?= $product["pname"]?></td>
                        <td><?= $product["pdetail"]?></td>
                        <td><?= $product["price"]?></td>
                        <td><?= $product["quantity"]?></td>
            </tr>
            <?php } ?>
            <tr>
                
            </tr>
            </table>
        </article>
        <?php include "./component/menu.php" ?>
        <?php include "./component/aside.php" ?>
    </main>
    <?php include "./component/footer.php" ?>
</body>

</html>