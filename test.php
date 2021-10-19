<?php 
    require_once("database.php");
    $all = json_encode(loadAllItem());
    echo $all;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX</title>
    <script type="text/javascript">
        function getProducts() {
            const ajax = new XMLHttpRequest();
            ajax.onload = function () {
                const data = ajax.responseText;
                clear();
                displayProducts(data);
            }
            
            
            const url = "test.php";
            ajax.open("GET", url);
            ajax.send();
        }

        function clear() {
            const a = document.getElementById("list");
            list.textContent = '';
        }
        function displayProducts(data) {
            const li = document.createElement("li");
            li.textContent = data;
            const ul = document.getElementById("list");
            ul.appendChild(li);
        }
        function buttonClick() {
            getProducts();
        }
    </script>
</head>
<body>
    <button onclick="buttonClick()">Update</button>   
    <ul id="list"></ul>
</body>
</html>