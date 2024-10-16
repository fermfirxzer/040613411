<?php
session_start();
// โหลดและแปลง JSON เป็น array
$jsonData = file_get_contents('http://202.44.40.193/~cs6530219/lab12/priv_hos.json');
$hospitalData = json_decode($jsonData, true);

?>

<!doctype html>
<html lang="th">

<head>
  <meta charset="utf-8">
  <title>CS Shop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="mobile-web-app-capable" content="yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="mcss.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "./component/head.php" ?>
    <?php include "./component/mobile_bar.php" ?>
    <main>
        <article>
        <table border="1" cellpadding="10" cellspacing="0">
        <tr>
          <th>No.</th><th>ชื่อโรงพยาบาล</th><th>ขนาดใหญ่ (> 91 เตียง)</th><th>ขนาดกลาง (30 - 91 เตียง)</th><th>ขนาดเล็ก (< 30 เตียง)</th>
        </tr>
        <?php
                $no = 1;
                foreach ($hospitalData['features'] as $hospital) {
                    $numBed = $hospital['properties']['num_bed'];
                    $hospitalName = $hospital['properties']['name'];
                    
                    // กำหนดเครื่องหมายเช็คถูกตามขนาดของโรงพยาบาล
                    $large = $numBed > 91 ? '✔' : '';
                    $medium = ($numBed <= 91 && $numBed >= 30) ? '✔' : '';
                    $small = $numBed < 30 ? '✔' : '';
                    
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$hospitalName}</td>
                            <td style='text-align:center;'>{$large}</td>
                            <td style='text-align:center;'>{$medium}</td>
                            <td style='text-align:center;'>{$small}</td>
                          </tr>";
                    $no++;
                }
                ?>
        </article>
        <?php include "./component/menu.php" ?>
        <?php include "./component/aside.php" ?>
    </main>
    <?php include "./component/footer.php" ?>
</body>
    

</html>