<?php include "connect.php" ?>

<?php 

print_r($_POST);


$target_dir = "./photo/product/";

$unique_id = uniqid();

$target_file = $target_dir . $unique_id . "_" . basename($_FILES["img"]["name"]);

$uploadOk = 1;

$image_upload = $unique_id . "_" . basename($_FILES["img"]["name"]);

?>

<!-- Proceed with the rest of the script if form has been submitted -->
<?php if (!empty($_POST)) {
        // Try to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            // Prepare the SQL update query
            $stmt = $pdo->prepare("UPDATE product SET pname = ?, pdetail = ?, price = ?, img = ? WHERE pid = ?");
            $stmt->bindParam(1, $_POST["pname"]);
            $stmt->bindParam(2, $_POST["pdetail"]);
            $stmt->bindParam(3, $_POST["price"]);
            $stmt->bindParam(4, $image_upload);
            $stmt->bindParam(5, $_POST["pid"]);

            // Execute the query and redirect on success
            if ($stmt->execute()) {
                header("Location: product_All.php");
            }
        } else {
            // If file upload fails, display the error
            echo "$image_upload";
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>

<!-- Fetch the product details for editing -->
<?php 
$stmt = $pdo->prepare("SELECT * FROM product WHERE pid=?");

if (!empty($_GET) && isset($_GET["pid"])) {
    $stmt->bindParam(1, $_GET["pid"]);
    $stmt->execute();
    $row = $stmt->fetch();
    $old_id = $_GET["pid"];
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
    <main>
        <article>
            <!-- Product edit form -->
            <form action="product_edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="pid" value="<?= $row["pid"] ?>">
                ชื่อสินค้า : <input type="text" name="pname" value="<?= $row["pname"] ?>" required><br>
                รายละเอียดสินค้า : <input type="text" name="pdetail" value="<?= $row["pdetail"] ?>" required><br>
                ราคา : <input type="text" name="price" value="<?= $row["price"] ?>" required><br>
                เพิ่มรูปสินค้า : <input type="file" id="img" name="img"><br>

                <input type="submit" value="แก้ไขสินค้า">
            </form>
        </article>
        <?php include "./component/menu.php" ?>
        <?php include "./component/aside.php" ?>
    </main>

    <?php include "./component/footer.php" ?>
</body>
</html>
