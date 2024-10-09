<html><head>
<meta charset="utf-8">
<script>
    function send() {
    request = new XMLHttpRequest();
    request.onreadystatechange = showResult;
    var keyword = document.getElementById("keyword").value;
    var url= "productTable.php?keyword=" + keyword;
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
<input type="text" id="keyword" onkeyup="send()">
    <div id="result">
<table border="1">
<?php while($row = mysql_fetch_array($objQuery)): ?>
<tr>
<td><a href="productDetail.php?pid=<?php echo $row["product_id"]?>"><?php echo
$row["product_name"]?></a></td>
<td><?php echo $row["product_detail"]?></td>
<td><img src="img/<?php echo $row["product_id"] ?>.png" width="100"></td>
<td><?php echo $row["product_price"]?> บาท</td>
<td><a href="cart.php?productId=<?php echo $row["product_id"]?>&action=add">สงซ
ѷ
ั
อ
ҟ
ื </a>

</tr>

<?php endwhile;?>
</table>
</div>
</body></html>