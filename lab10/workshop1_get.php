<html>
<body>
<?php

if(!empty($_GET)&&isset($_GET["language"])){
    setcookie("language",$_GET["language"],time()+1000);
}
print_r($_GET);
echo "<br>";
print_r($_COOKIE);
// ถ ้าคุกกี้ visit เป็นค่าว่าง ให ้สร ้างคุกกี้ visit และก าหนดค่าเริ่มต ้นเป็น 0
?>
</body>
</html>