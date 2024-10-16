<html>

<head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../mcss.css" rel="stylesheet" type="text/css" />
    <link href="../table.css" rel="stylesheet"/>
    <script src="../mpage.js"></script>

    <style>
        td{
            text-align:center;
        }
        </style>
    <script>
        // async function send() {
            
        //     var url = "./fetch.php"; // Ensure the path to fetch.php is correct
        //     try{
        //         const response=await fetch(url);
        //         const data=await response.text();
        //         const object=JSON.parse(data);
        //         console.log(object);
        //     }catch(error){
        //         console.log(error);
        //     }
            
        // }
        var httpRequest;

        function send() {
            httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = hospital;
            var url = "http://202.44.40.193/~aws/JSON/priv_hos.json"; // Ensure the path to fetch.php is correct
            httpRequest.open("GET", url);
            httpRequest.send();
        }
        function hospital() {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                const rawData = httpRequest.responseText;
                const object = JSON.parse(rawData);
                const host = object.features;

                const hospitalTable = document.getElementById("table");

                host.forEach((hospital, index) => {
                    const tr = document.createElement('tr');
                    const numBeds = hospital.properties.num_bed; // Get the number of beds
                    tr.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${hospital.properties.name}</td>
                        <td>${numBeds >= 91 ? '✔' : ''}</td>
                        <td>${numBeds >= 31 && numBeds <= 90 ? '✔' : ''}</td>
                        <td>${numBeds <= 30 ? '✔' : ''}</td>
                    `;
                    hospitalTable.appendChild(tr);
                });
            }
        }

        // Call the send function when the page loads
        window.onload = send;
    </script>
</head>

<body>
    <?php include "../component/head.php" ?>
    <?php include "../component/mobile_bar.php" ?>
    <main>
        <article>
            <table id="table">
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
