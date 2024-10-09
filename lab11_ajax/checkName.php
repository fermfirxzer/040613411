<?php
include "connect.php";
$stmt=$pdo->prepare("SELECT * FROM member WHERE username=?");
$stmt->bindParam(1,$_GET["username"]);
$stmt->execute();
$user=$stmt->fetch();
sleep(1);
print_r($user);
if (!$user) {
	echo "okay";
} else {
	echo "denied";
}

?>
