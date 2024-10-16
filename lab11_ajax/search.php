<?php
include "connect.php";
$stmt=$pdo->prepare("SELECT * FROM member WHERE username LIKE ?");
$searchTerm = "%" . $_GET["username"] . "%";
$stmt->bindParam(1, $searchTerm);
$stmt->execute();

?>
      <?php while ($row=$stmt->fetch()) { ?>
        <div style="padding:10px">
          <h3><?= $row["username"] ?></h3>
          <?php if ($row["img"] != "") { ?>
            <a href="#">
              <img src='../phpDBlab8/photo/member/<?= $row["img"] ?>' width="250px" height="200px">
            </a>
          <?php } else { ?>
            <div>don't have image : </div>
          <?php } ?>
          <br>
          email : <?= $row["email"] ?> <br>
          ที่อยู่ : <?= $row["address"] ?><br>
          <hr>
        </div>
      <?php } ?>
<?php ?>