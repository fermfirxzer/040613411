<?php include "connect.php" ?>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="mcss.css" rel="stylesheet" type="text/css" />
    <script src="mpage.js"></script>
    <script>
        function confirmDelete(pid) {
            var ans = confirm("ต้องการลบ pid :" + pid);
            if (ans == true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
                document.location = "product_delete.php?pid=" + pid;
        }

        function confirmEdit(pid) {
            var ans = confirm("ต้องการแก้ไข pid :" + pid);
            if (ans == true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
                document.location = "product_edit.php?pid=" + pid;
        }
    </script>
</head>

<body>

    <header>
        <div class="logo">
            <img src="cslogo.jpg" width="200" alt="Site Logo">
        </div>
        <div class="search">
            <form>
                <input type="search" placeholder="Search the site...">
                <button>Search</button>
            </form>
        </div>
    </header>

    <div class="mobile_bar">
        <a href="#"><img src="responsive-demo-home.gif" alt="Home"></a>
        <a href="#" onClick='toggle_visibility("menu"); return false;'><img src="responsive-demo-menu.gif" alt="Menu"></a>
    </div>

    <main>
        <article>
            <form action="product_All.php" method="GET">
                <input type="text" name="pname" placeholder="ค้นหาสินค้าด้วยชื่อ :"><br>
                <input type="submit" value="ค้นหา">
            </form>
            <a href="product_insert.php">
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
        </article>
        <?php include "./component/menu.php" ?>
        <aside>
            <h2>Aside</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit libero sit amet nunc ultricies, eu feugiat diam placerat. Phasellus tincidunt nisi et lectus pulvinar, quis tincidunt lacus viverra. Phasellus in aliquet massa. Integer iaculis massa id dolor venenatis scelerisque.
                <br><br>
            </p>
        </aside>
    </main>
    <footer>
        <a href="#">Sitemap</a>
        <a href="#">Contact</a>
        <a href="#">Privacy</a>
    </footer>
</body>

</html>