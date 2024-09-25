<html>
<body>
<?php
   $success=0;
   if(!empty($_POST)){
   include "connect.php";
  
   session_start();

  $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
  $stmt->bindParam(1, $_POST["username"]);
  $stmt->bindParam(2, $_POST["password"]);
  $stmt->execute();
  $row = $stmt->fetch();
   $success=1;
  // หาก username และ password ตรงกัน จะมีข้อมูลในตัวแปร $row
}
?>

<form action="login-form.php" method="POST">
   Username: <input type="text" name="username"><br>
   Password: <input type="password" name="password"><br>
   <input type="submit" value="Login">
</form>
<?php
   if (!empty($row)&&$success==1) { 
      // นำข้อมูลผู้ใช้จากฐานข้อมูลเขียนลง session 2 ค่า
      $_SESSION["fullname"] = $row["name"];   
      $_SESSION["username"] = $row["username"];
  
      // แสดง link เพื่อไปยังหน้าต่อไปหลังจากตรวจสอบสำเร็จแล้ว
      echo "เข้าสู่ระบบสำเร็จ<br>";
      echo "<a href='user-home.php'>ไปยังหน้าหลักของผู้ใช้</a>"; 
  
    // กรณี username และ password ไม่ตรงกัน
    } else if(!empty($_POST)){
      echo "ไม่สำเร็จ ชื่อหรือรหัสผ่านไม่ถูกต้อง";
      echo "<a href='login-form.php'>เข้าสู่ระบบอีกครัง</a>"; 
    }
    ?>
</body>
</html>
