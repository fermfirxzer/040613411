<!-- <!-- <!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ไม่ใช้ AJAX</title>
    <script src="data.json"></script> <!-- โหลด JSON -->
</head>
<body>
    <h1>รายชื่อโรงพยาบาล</h1>
    <ul id="hospital-list"></ul>
    
    <script>
        // ใช้ข้อมูล JSON ที่โหลดเข้ามา
        const hospitals = data.hospitals; // data มาจากการโหลด JSON
        const hospitalList = document.getElementById("hospital-list");

        hospitals.forEach(hospital => {
            const li = document.createElement("li");
            li.textContent = `${hospital.name} - จำนวนเตียง: ${hospital.num_bed}`;
            hospitalList.appendChild(li);
        });
    </script>
</body>
</html> -->
<script>
        var httpRequest;

        function send() {
            httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = hospital;
            var url = "./fetch.php"; // Ensure the path to fetch.php is correct
            httpRequest.open("GET", url);
            httpRequest.send();
        }

        function hospital() {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                const rawData = httpRequest.responseText;
                const object = JSON.parse(rawData);
                const host = object.features;

                let bighost = [];
                let normalhost = [];
                let smallhost = [];

                // Categorize hospitals based on the number of beds
                host.forEach((host) => {
                    const hos = host.properties;
                    if (hos.num_bed > 90) {
                        bighost.push(hos);
                    } else if (hos.num_bed > 30) {
                        normalhost.push(hos);
                    } else {
                        smallhost.push(hos);
                    }
                });

                const table = document.getElementById("table");
                
                // Populate the table with categorized hospitals
                bighost.forEach((big, index) => {
                    let row = table.insertRow(-1); // Insert at the end
                    row.insertCell(0).textContent = index + 1; // No.
                    row.insertCell(1).textContent = big.name; // Hospital Name
                    row.insertCell(2).textContent = "Yes"; // Large
                    row.insertCell(3).textContent = "No"; // Medium
                    row.insertCell(4).textContent = "No"; // Small
                });

                normalhost.forEach((normal, index) => {
                    let row = table.insertRow(-1);
                    row.insertCell(0).textContent = bighost.length + index + 1; // No. continues from large
                    row.insertCell(1).textContent = normal.name; // Hospital Name
                    row.insertCell(2).textContent = "No"; // Large
                    row.insertCell(3).textContent = "Yes"; // Medium
                    row.insertCell(4).textContent = "No"; // Small
                });

                smallhost.forEach((small, index) => {
                    let row = table.insertRow(-1);
                    row.insertCell(0).textContent = bighost.length + normalhost.length + index + 1; // No. continues from medium
                    row.insertCell(1).textContent = small.name; // Hospital Name
                    row.insertCell(2).textContent = "No"; // Large
                    row.insertCell(3).textContent = "No"; // Medium
                    row.insertCell(4).textContent = "Yes"; // Small
                });
            }
        }

        
        window.onload = send;
    </script> -->
<!-- <!DOCTYPE html>
<html>
<head>
    <style>
        table, th, td 
        {
            border: solid 1px #ddd;
            border-collapse: collapse;
            padding: 2px 3px;
            text-align: center;
        }
        th { 
            font-weight:bold;
        }
    </style>
</head>
<body>
    <input type='button' onclick='tableFromJson()' value='Create Table from JSON data' />
    <p id="showData"></p>
</body>

<script>
  let tableFromJson = () => {
    // the json data.
    const myBooks = [
      {'Book ID': '1', 'Book Name': 'Challenging Times',
       'Category': 'Business', 'Price': '125.60'
      },
      {'Book ID': '2', 'Book Name': 'Learn JavaScript',
       'Category': 'Programming', 'Price': '56.00'
      },
      {'Book ID': '3', 'Book Name': 'Popular Science',
       'Category': 'Science', 'Price': '210.40'
      }
    ]

    // Extract value from table header. 
    // ('Book ID', 'Book Name', 'Category' and 'Price')
    let col = [];
    for (let i = 0; i < myBooks.length; i++) {
      for (let key in myBooks[i]) {
        if (col.indexOf(key) === -1) {
          col.push(key);
        }
      }
    }

    // Create table.
    const table = document.createElement("table");

    // Create table header row using the extracted headers above.
    let tr = table.insertRow(-1);                   // table row.

    for (let i = 0; i < col.length; i++) {
      let th = document.createElement("th");      // table header.
      th.innerHTML = col[i];
      tr.appendChild(th);
    }

    // add json data to the table as rows.
    for (let i = 0; i < myBooks.length; i++) {

      tr = table.insertRow(-1);

      for (let j = 0; j < col.length; j++) {
        let tabCell = tr.insertCell(-1);
        tabCell.innerHTML = myBooks[i][col[j]];
      }
    }

    // Now, add the newly created table with json data, to a container.
    const divShowData = document.getElementById('showData');
    divShowData.innerHTML = "";
    divShowData.appendChild(table);
  }
</script>
</html> -->