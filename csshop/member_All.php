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
        document.location = "member_delete.php?username=" + username;
    }

    function confirmEdit(username) {
      var ans = confirm("ต้องการแก้ไข username :" + username);
     
      if (ans == true) 
        document.location = "member_edit.php?username=" + username;
    }
  </script>
</head>

<body>

<?php include "./component/head.php" ?>
<?php include "./component/mobile_bar.php" ?>

  <main>
    <article>
      <form action="member_All.php" method="GET">
        <input type="text" name="name" placeholder="ค้นหาด้วยชื่อ :"><br>
        <input type="submit" value="ค้นหา">
      </form>
      <a href="member_insert.php"><button>เพิ่มสมาชิก</button></a><br>
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
          <h3> username :<?= $row["username"] ?></h3>
          <?php if ($row["img"] != "") { ?>
            <a href="#">
              <img src='./photo/member/<?= $row["img"] ?>' width="250px" height="200px">
            </a>
          <?php } else { ?>
            <div>don't have image : </div>
          <?php } ?>
          <br>
          name : <?= $row["name"] ?><br>
          email : <?= $row["email"] ?> <br>
          ที่อยู่ : <?= $row["address"] ?><br>
          <a href='#' onclick="confirmEdit('<?= $row["username"] ?>')">แก้ไข</a>
          <a href='#' onclick="confirmDelete('<?= $row["username"] ?>')">ลบ</a>
          <hr>
        </div>
      <?php }
      ?>
    </article>
    <?php include "./component/menu.php" ?>
    <?php include "./component/aside.php" ?>
  </main>
  <?php include "./component/footer.php" ?>
</body>

</html>