<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8">
<script>
function confirmDelete(username) { 
    var ans = confirm("ต้องการลบ username :" + username); 
    if (ans==true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
        document.location = "delete.php?username=" + username;
    }
function confirmEdit(username){
    var ans = confirm("ต้องการแก้ไข username :" + username); 
    if (ans==true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
        document.location = "workshop9.php?username=" + username;
    }

</script>
</head>
<body>
<?php
$stmt = $pdo->prepare("SELECT * FROM member");
$stmt->execute();
while ($row = $stmt->fetch()) { ?>
    <div style="padding:10px">
        <h2><?=$row["username"]?></h2>
        email : <?=$row["email"]?> <br>
        ที่อยู่ : <?=$row["address"]?><br>
        <a href='#' onclick="confirmEdit('<?=$row["username"]?>')">แก้ไข</a>
        <a href='#' onclick="confirmDelete('<?=$row["username"]?>')">ลบ</a>
        <hr>
    </div>
<?php }
?>
</body>
</html>