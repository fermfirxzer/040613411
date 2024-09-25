<html>
<body>
<?php 
include "connect.php";
session_start();
$stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
$stmt->bindParam(1, $_POST["username"]);
$stmt->bindParam(2, $_POST["password"]);
$stmt->execute();
$row = $stmt->fetch();
// หาก username และ password ตรงกัน จะมีข้อมูลในตัวแปร $row
if (!empty($row)) {
// เปลี่ยน session id ป้ องกัน Session Fixation
session_regenerate_id();
// น าข้อมูลผู้ใชจากฐานข้อมูลเขียนลง ้ session 2 ค่า
$_SESSION["fullname"] = $row["name"];
$_SESSION["username"] = $row["username"];
// แสดง link เพื่อไปยังหน้าต่อไปหลังจากตรวจสอบส าเร็จแล้ว
echo "เข้าสูระบบส ่ าเร็จ<br>";
echo "<a href='user-home.php'>ไปยังหน้าหลักของผู้ใช<้ /a>";
// กรณี username และ password ไม่ตรงกัน
} else {
echo "ไม่ส าเร็จ ชอหรือรหัสผ่านไม่ถูกต้อง ื่ ";
echo "<a href='login-form.php'>เข้าสูระบบอีก ่ ครัง</a>";
}
?>
<form action="check-login.php" method="POST">
Username: <input type="text" name="username"><br>
Password: <input type="password" name="password"><br>
<input type="submit" value="Login">
</form>
</body>
</html>