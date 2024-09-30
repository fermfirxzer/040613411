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
          <h3><?= $row["username"] ?></h3>
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