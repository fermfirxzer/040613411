<?php include "connect.php"; ?>

<?php
print_r($_POST);
$target_dir = "./photo/product/";
$unique_id = uniqid();
$target_file = $target_dir . $unique_id . "_" . basename($_FILES["img"]["name"]);
$uploadOk = 1;

$image_upload=$unique_id . "_" . basename($_FILES["img"]["name"]);
// Check if the image file is a valid image

if (!empty($_POST)) {

        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["img"]["name"])) . " has been uploaded.";
            // Insert into database
            $stmt = $pdo->prepare("INSERT INTO product (pname, pdetail, price, img) VALUES (?, ?, ?, ?)");
            $stmt->bindParam(1, $_POST["pname"]);
            $stmt->bindParam(2, $_POST["detail"]);
            $stmt->bindParam(3, $_POST["price"]);
            $stmt->bindParam(4, $image_upload); // Store the uploaded image file path
            if ($stmt->execute()) {
                $pid = $pdo->lastInsertId();
                header("Location: product_All.php");
                exit; // Make sure to exit after redirect
            }
        } else {
            echo "$target_file";
            echo "Sorry, there was an error uploading your file.";
        }
}
?>

<html>

<head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="mcss.css" rel="stylesheet" type="text/css" />
    <script src="mpage.js"></script>
</head>

<body>
    <?php include "./component/head.php" ?>
    <?php include "./component/mobile_bar.php" ?>
    <?php if (isset($pid) && $pid != 0) {
        echo "<p>เพิ่มสินค้าสินค้าสำเร็จ $pid</p>";
    } ?>
    <main>
    <article>
        <form action="product_insert.php" method="post" enctype="multipart/form-data">
            ชื่อสินค้า : <input type="text" name="pname" required><br>
            รายละเอียดสินค้า : <input type="text" name="detail" required><br>
            ราคา: <input type="number" name="price" required><br>
            เพิ่มรูปสินค้า : <input type="file" id="img" name="img">
            <input type="submit" name="submit" value="เพิ่มสินค้า">
        </form>
        
        </article>
        <?php include "./component/menu.php" ?>
        <?php include "./component/aside.php" ?>
    </main>

    <?php include "./component/footer.php" ?>
</body>

</html>
