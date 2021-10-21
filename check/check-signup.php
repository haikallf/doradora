<?php 
$db = "../db/database.db";
// regex email dan username dan cek username unik
$username = isset($_POST['u']) ? $_POST['u'] : ''; 
$password = isset($_POST['p']) ? $_POST['p'] : ''; 
$email = isset($_POST['e']) ? $_POST['e'] : '';

$ok = true;
$pesan = array();
if (!isset($username) || empty($username) || !isset($password) || empty($password) || !isset($email) || empty($email)) {
    $ok = false;
    $pesan[] = "Jangan ada field yang kosong.";
}

if ($ok) {
    // periksa email
    if(!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $ok = false;
        $pesan[] = "Email tidak valid.";
    }
    // periksa username regex
    $regex = "/^[a-zA-Z0-9._]+$/";
    if (!preg_match($regex, $username)) {
        $ok = false;
        $pesan[] = "Username tidak valid.";
    }
}

if ($ok) {
    // periksa username dan email sudah ada atau belum di db
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("SELECT * FROM user WHERE username = '$username' OR email = '$email'");
    $data = $query->fetchArray(SQLITE3_ASSOC);

    if (!empty($data)) {
        $ok = false;
        $pesan[] = "Username/email telah terdaftar.";
    }
    else {
        // enkripsi password, masukin ke database
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $query_insert = $db->query("INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashed');");
        // $pesan[] = "Akun berhasil mendaftar. Selamat berbelanja!";


    }
}

echo json_encode(
    array(
        'ok' => $ok,
        'pesan' => $pesan
    )
)
?>