<?php include "connect.php" ?>

<!doctype html>
<html lang="en">

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
            <?php $stmt = $pdo->prepare("SELECT * FROM member");
            $index = 1;
            $stmt->execute();
            while ($row = $stmt->fetch()) { ?>
                <div style="padding:15px;">

                    <?php if ($row["img"] != "") { ?>
                        <a href="workshop5detail.php?username=<?= $row["username"] ?>">
                            <img src='./photo/member/<?= $row["img"] ?>' width="250px" height="200px">
                        </a>
                    <?php } else { ?>
                        <div>don't have image : </div>
                    <?php } ?>

                    <br>
                    Username : <?= $row["username"] ?><br>
                    Email : <?= $row["email"] ?><br>
                    Address :<?= $row["address"] ?><br>
                    <hr>
                    <?php $index++ ?>
                </div>
            <?php } ?>
        </article>
        <nav id="menu">
            <h2>Navigation</h2>
            <ul class="menu">
                <li class="dead"><a>Home</a></li>
                <li><a href="./mpage1.php">All Products</a></li>
                <li><a href="./mpage2.php">Table of All Products</a></li>
                <li><a href="#">Page 03</a></li>
                <li><a href="#">Page 04</a></li>
                <li><a href="#">Page 05</a></li>
                <li><a href="#">Page 06</a></li>
                <li><a href="#">Page 07</a></li>
            </ul>
        </nav>
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