<?php include "connect.php" ?>
<html>
<head><meta charset="UTF-8"></head>
<body>
    <?php $insert=false; ?>
     <?php if(!empty($_POST)){
        $stmt=$pdo->prepare("INSERT INTO member VALUES (?,?,?,?,?,?) ");
        $stmt->bindParam(1,$_POST["username"]);
        $stmt->bindParam(2,$_POST["password"]);
        $stmt->bindParam(3,$_POST["name"]);
        $stmt->bindParam(4,$_POST["address"]);
        $stmt->bindParam(5,$_POST["mobile"]);
        $stmt->bindParam(6,$_POST["email"]);
        if($stmt->execute()){
            $insert=true;
        }else{
            $insert=false;
        }
    }?>
<h3>เพิ่มข้อมูล User : </h3>
<form action="workshop7.php" method="post">
    username : <input type="text" name="username" require><br>
    password : <input type="text" name="password" require><br>
    name : <input type="text" name="name" require><br>
    Address : <br>
    <textarea name="address" rows="3" cols="40"></textarea><br>
    mobile : <input type="text" name="mobile"><br>
    email : <input type="email" name="email" require><br>
    <input type="submit" value="ยีนยัน">
</form>
<?php if($insert==true){
        echo "<span style='color:red;'>เพิ่มข้อมูลสำเร็จ</span>";
    } ?>
</body>
</html>