<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <title>โรงพยาบาล</title>
    <script>
        async function getDataFromAPI() {
            let response = await fetch('http://202.44.40.193/~aws/JSON/priv_hos.json');
            let rawData = await response.text();
            let objectData = JSON.parse(rawData);

            let hosData = objectData.features;
            console.log(hosData);

            let bighost = [];
            let normalhos = [];
            let smallhos = [];

            for (let i = 0; i < hosData.length; i++) {
                const hospital = hosData[i].properties;
                if (hospital.num_bed > 90) {
                    bighost.push(hospital);
                } else if (hospital.num_bed >= 31) {
                    normalhos.push(hospital);
                } else {
                    smallhos.push(hospital);
                }
            }

            console.log(bighost);

            // Populate select options for big hospitals
            const select = document.getElementById("select");
            bighost.forEach((hos) => {
                let option = document.createElement("option");
                option.innerHTML = hos.name; // Corrected innerHTML property
                option.value = hos.name;
                select.appendChild(option);
            });

            // Populate the lists for big, medium, and small hospitals
            const bighostList = document.getElementById('bighost');
            bighost.forEach(hos => {
                let li = document.createElement('li');
                li.textContent = hos.name; // Display hospital name in the list
                bighostList.appendChild(li);
            });

            const normalhosList = document.getElementById('normalhos');
            normalhos.forEach(hos => {
                let li = document.createElement('li');
                li.textContent = hos.name;
                normalhosList.appendChild(li);
            });

            const smallhosList = document.getElementById('smallhos');
            smallhos.forEach(hos => {
                let li = document.createElement('li');
                li.textContent = hos.name;
                smallhosList.appendChild(li);
            });
        }
        getDataFromAPI();
        function show(ele) {
       
        let msg = document.getElementById('msg');
        msg.innerHTML = 'host: <b>' + ele.options[ele.selectedIndex].text + '</b> </br>' +
            'ID: <b>' + ele.value + '</b>';
    }
    </script>
</head>

<body>
    <h1>โรงพยาบาล</h1>
    <h3>โรงพยาบาลขนาดใหญ่</h3>
    <ol start="1" id="bighost"></ol>
    <h3>โรงพยาบาลขนาดกลาง</h3>
    <ol start="1" id="normalhos"></ol>
    <h3>โรงพยาบาลขนาดเล็ก</h3>
    <ol start="1" id="smallhos"></ol>
    <select id="select" onChange="show(this)">
        <option value="" disabled selected>เลือกโรงพยาบาลขนาดใหญ่</option>
    </select>
    <p id="msg"></p>
</body>

</html>
