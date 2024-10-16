<html>

<head>
    <meta charset="utf-8">
    <script>
        function send(event) {
            console.log("This is send");
            event.preventDefault();
            request = new XMLHttpRequest();
            request.onreadystatechange = showResult;
            var keyword = document.getElementById("keyword").value;
            var url = "search.php?username=" + keyword;
            request.open("GET", url, true);
            request.send(null);
        }
        function showResult() {
            if (request.readyState == 4) {
                if (request.status == 200)
                    document.getElementById("result").innerHTML = request.responseText;

            }
        }
    </script>
</head>

<body>
    <form onsubmit="send(event)">
    <input type="text" id="keyword">
    <button type="submit">Search</button>
    </form>
    <div id="result">
    
    </div>
</body>

</html>