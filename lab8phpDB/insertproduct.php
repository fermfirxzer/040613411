<?php include "connect.php"; ?>

<?php
print_r($_POST);
$pid = 0;
$target_dir = "photo/";
$target_file = $target_dir . basename($_FILES["img"]["name"]);
echo "$target_file";
$uploadOk = 0; // Initialize to 0

if (!empty($_POST)) {
    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if upload is OK
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Attempt to upload the file
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["img"]["name"])) . " has been uploaded.";
            // Insert into database
            $stmt = $pdo->prepare("INSERT INTO product (pname, pdetail, price, img) VALUES (?, ?, ?, ?)");
            $stmt->bindParam(1, $_POST["pname"]);
            $stmt->bindParam(2, $_POST["detail"]);
            $stmt->bindParam(3, $_POST["price"]);
            $stmt->bindParam(4, $_POST["img "]); // Store the path or name
            if ($stmt->execute()) {
                $pid = $pdo->lastInsertId();
                header("Location: Allproduct.php");
                exit; // Make sure to exit after redirect
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
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
    <?php if ($pid != 0) {
        echo "<p>เพิ่มสินค้าสินค้าสำเร็จ $pid</p>";
    } ?>

    <form action="insertproduct.php" method="post">
        ชื่อสินค้า : <input type="text" name="pname" required><br>
        รายละเอียดสินค้า : <input type="text" name="detail" required><br>
        ราคา: <input type="number" name="price" required><br>
        เพิ่มรูปสินค้า : <input type="file" id="img" name="img">
        <input type="submit" value="เพิ่มสินค้า">
    </form>
</body>
</html>
