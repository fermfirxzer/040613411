<html>
<body>
<?php

if (isset($_COOKIE["language"])&&($_COOKIE["language"]=="en")) {
    echo "Hello World";
}else if(isset($_COOKIE["language"])&&($_COOKIE["language"]=="th")){
    echo "สวัสดี";
}
?>
</body>
</html>