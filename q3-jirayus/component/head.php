<?php 
// ตรวจสอบว่ามีชอใน ื่ session หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
$login = $login ?? false;
// if (!$login&&empty($_SESSION["username"]) ) {
// header("location:login.php");
// exit();
// }
?>
<header>
        <div class="logo">
            <img src="cslogo.jpg" width="200" alt="Site Logo">
        </div>
        <div class="search">
            <form>
                <input type="search" placeholder="Search the site...">
                <button>Search</button>
            </form>
        </div>
</header>