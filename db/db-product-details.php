<?php 
require_once("database.php");
// setiap dipanggil, load ulang database pada id itu
$id = $_REQUEST["id"];
$result = findItemByID($id);
echo json_encode($result);
?>