<?php 
// 1. Autentikasi pengguna (admin, user)

// 2. Pengelolaan varian dorayaki (admin)
// kalo admin, pagenya ada semua fungsi dibawah
// a.Menambah varian dorayaki
// $GLOBALS['db']
$db = "../db/database.db";
$db2 = "./db/database.db";
function addItem($idItem, $namaItem, $deskripsi,int $harga,int $stok, $gambar,int $available) {
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("INSERT INTO item(idItem, namaItem, deskripsi, harga, stok, gambar, available) VALUES ('$idItem', '$namaItem', '$deskripsi', '$harga', '$stok', '$gambar', '$available');");
    $db->close();
    unset($db);
}

// b.Melihat varian dorayaki yang di-filter berdasarkan nama varian

function filterItemByName($nama) {
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("SELECT * FROM item WHERE available = 0 AND namaItem LIKE '%$nama%';");
    $data = array();
    
    while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
        array_push($data, $row);
    }
    $db->close();
    unset($db);
    return $data;
}

function findItemByID($id) {
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("SELECT * FROM item WHERE idItem = $id");
    $data = array();
    
    while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
        array_push($data, $row);
    }
    $db->close();
    unset($db);
    return $data;
}

// c.Melihat detail dorayaki = ini dari loadAllItem ambil satu elemen

// d.[BONUS] Mengubah informasi tentang varian dorayaki yang sudah ada.
function editItem($idItem, $columnName, $newValue) {
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("UPDATE item SET '$columnName' = '$newValue' WHERE idItem = '$idItem';");
    $db->close();
    unset($db);
}
// e.Menghapus varian dorayaki yang sudah ada.
function deleteItem($idItem) {
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("UPDATE item SET available = 0 WHERE idItem = '$idItem';");
    $db->close();
    unset($db);
    echo "<script>alert('Dorayaki berhasil dihapus');</script>";
    echo "<script>location.href='../index.php'</script>";
}

// 3. Manajemen stok dorayaki (admin)
// a. Menambah stok varian dorayaki
function addStokItemAdmin($idItem,int $value, $username, $tanggal) {
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("UPDATE item SET stok = stok + '$value' WHERE idItem = '$idItem';");
    // cari nama varian
    $query2 = $db->query("SELECT namaItem FROM item WHERE idItem = '$idItem';");
    $fetch2 = $query2->fetchArray(SQLITE3_ASSOC);
    $namaItem = $fetch2['namaItem'];
    $db->close();
    unset($db);

    // $query3 = $db->query("INSERT INTO riwayat VALUES ('$username', '$namaItem', '$tanggal', '$value';");
}
// addStokItemAdmin('id1',0,0,0);
// b. Mengurangi varian dorayaki
function reduceStokItemAdmin($idItem,int $value) {
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("UPDATE item SET stok = stok - '$value' WHERE idItem = '$idItem';");
    // cari nama varian
    $query2 = $db->query("SELECT namaItem FROM item WHERE idItem = '$idItem';");
    $fetch2 = $query2->fetchArray(SQLITE3_ASSOC);
    $namaItem = $fetch2['namaItem'];
    $db->close();
    unset($db);

    // $query3 = $db->query("INSERT INTO riwayat VALUES ('$username', '$namaItem', '$tanggal', '$value';");
}

// 4. Melihat Daftar Varian Dorayaki (user)
// a. sama kaya 2b
// b. sama kaya 2c

// 5. BONUS Riwayat perubahan stok
// 6. Pembelian dorayaki
// Mengurangi stok

// 7. BONUS Riwayat Pembelian

// $a = loadAllItem();
// var_dump(findItemByID("10"));

// var_dump(count(filterItemByName("cream")));

function addToCart($username, $idItem, $quantity) {
    $db = new SQLite3($GLOBALS['db']);
    $query1 = $db->query("SELECT * FROM cart WHERE idItem = '$idItem';");

    $fetch1 = array();
    while ($row = $query1->fetchArray(SQLITE3_ASSOC)) {
        array_push($fetch1, $row);
    }

    if (count($fetch1) == 0) {
        $query2 = $db->query("INSERT INTO cart (username, idItem, quantity) VALUES ('$username', '$idItem', '$quantity');");
    }
    else {
        $query3 = $db->query("UPDATE cart SET quantity = quantity + '$quantity' WHERE idItem = '$idItem';");
    }
    
    $db->close();
    unset($db);
    unset($fetch1);
}


// function buyItem($username, $idItem, $quantity) {
//     $db = new SQLite3($GLOBALS['db']);
//     $query = $db->query("INSERT INTO cart (username, idItem, quantity) VALUES ('$username', '$idItem', '$quanity')");
// }

?>