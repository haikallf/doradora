<?php 
require_once("database.php");
// setiap dipanggil, load ulang database pada id itu
$id = $_REQUEST["idItem"];
echo findItemByID($id);
?>