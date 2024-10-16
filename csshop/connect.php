<?php
try {
	$pdo=new PDO("mysql:host=localhost;dbname=sec1_10;charset=utf8","Wstd10","KwifyvjB");
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "เกิดข้อผิดพลาด : ".$e->getMessage();
}
?>