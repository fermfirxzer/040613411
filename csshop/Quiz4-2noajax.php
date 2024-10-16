<html>

<head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../mcss.css" rel="stylesheet" type="text/css" />
    <script src="../mpage.js"></script>
    <script>
        var httpRequest;
        function send(){
            httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = hospital;
            var url="./fetch.php";
            httpRequest.open("GET", url);
            httpRequest.send();
        }
        function hospital(){
            console.log("This is fetch")
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                console.log(httpRequest.responseText)
                const rawData=httpRequest.responseText;

            }
        }
    </script>
</head>

<body>
    <?php include "../component/head.php" ?>
    <?php include "../component/mobile_bar.php" ?>
    <main>
        <article>
        <table>
        <tr>
            <th>No.</th>
            <th>ชื่อโรงพยาบาล</th>
            <th>ขนาดใหญ่</th>

            <th>ขนาดกลาง</th>
            <th>ขนาดเล็ก</th>
</tr>

</table>
        </article>
        <?php include "../component/menu.php" ?>
        <?php include "../component/aside.php" ?>
    </main>
    <?php include "../component/footer.php" ?>
</body>

</html>