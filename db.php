<?php 
// 1. Autentikasi pengguna (admin, user)

// 2. Pengelolaan varian dorayaki (admin)
// kalo admin, pagenya ada semua fungsi dibawah
// a.Menambah dorayaki
function addItem($idItem, $jumlah) {

}
// b.Melihat varian dorayaki yang di-filter berdasarkan nama varian
// ini mending load semua, filternya di array phpnya aja, cuman load yg available
function loadAllItem() {
    $db = new SQLite3("database(1).db");
    $query = $db->query("SELECT * FROM item WHERE available = 1;");

    $data = array();
    
    while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
        array_push($data, $row);
    }
    $db->close();
    return $data;
}

$tes = loadAllItem();
print_r($tes);
// c.Melihat detail dorayaki

// d.[BONUS] Mengubah informasi tentang varian dorayaki yang sudah ada.

// e.Menghapus varian dorayaki yang sudah ada.

// 3. Manajemen stok dorayaki (admin)
// a. Menambah stok varian dorayaki

// b. Mengurangi varian dorayaki

// 4. Melihat Daftar Varian Dorayaki (user)
// a. sama kaya 2b

// b. sama kaya 2c

// 5. BONUS Riwayat perubahan stok
// 6. Pembelian dorayaki
// Mengurangi stok

// 7. BONUS Riwayat Pembelian
?>