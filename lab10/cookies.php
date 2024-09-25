<html>
<body>
<?php

print_r($_COOKIE);
// ถ ้าคุกกี้ visit เป็นค่าว่าง ให ้สร ้างคุกกี้ visit และก าหนดค่าเริ่มต ้นเป็น 0
if (empty($_COOKIE["visit"])) {
setcookie("visit", 0, time() + 1000);
}

if (!isset($_COOKIE["visit"])) {
echo "Welcome to my website! Click here for a tour";
} else {
$visit = $_COOKIE["visit"] + 1;
setcookie("visit", $visit, time() + 1000);
echo "This is visit number $visit.";
}
?>
</body>
</html>