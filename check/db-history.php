<?php 
$db = "../db/database.db";

// admin
function historyOneItem($idItem) {
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("SELECT * FROM riwayat WHERE idItem = '$idItem;");
    $data = array();
    
    while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
        array_push($data, $row);
    }
    $db->close();
    return $data;
}

function historyByUser($username) {
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("SELECT * FROM riwayat WHERE username = '$username;");
    $data = array();
    
    while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
        array_push($data, $row);
    }
    $db->close();
    return $data;
}
?>