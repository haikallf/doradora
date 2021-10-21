<?php 
$db = "./db/database.db";
function loadAllItem() {
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("SELECT * FROM item;");
    $data = array();
    
    while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
        array_push($data, $row);
    }
    $db->close();
    return $data;
}

function loadAllAvailableItem() {
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("SELECT * FROM item WHERE available = 1;");
    $data = array();
    
    while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
        array_push($data, $row);
    }
    $db->close();
    return $data;
}

function syncStockAndQuantity() {
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("UPDATE item SET available = 0 WHERE stok = 0;");
}

$itemArray = loadAllItem();
?>