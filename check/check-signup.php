<?php 
session_start();
$db = "../db/database.db";
// regex email dan username dan cek username unik
$username = isset($_POST['u']) ? $_POST['u'] : ''; 
$password = isset($_POST['p']) ? $_POST['p'] : ''; 
$email = isset($_POST['e']) ? $_POST['e'] : '';

$ok = true;
$message = array();
if (!isset($username) || empty($username) || !isset($password) || empty($password) || !isset($email) || empty($email)) {
    $ok = false;
    $message[] = "Jangan ada kolom yang kosong.";
}

if ($ok) {
    // periksa email
    if(!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $ok = false;
        $message[] = "Email tidak valid.";
    }
    // periksa username regex
    $regex = "/^[a-zA-Z0-9._]+$/";
    if (!preg_match($regex, $username)) {
        $ok = false;
        $message[] = "Username tidak valid.";
    }
}

if ($ok) {
    // periksa username dan email sudah ada atau belum di db
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("SELECT * FROM user WHERE username = '$username' OR email = '$email'");
    $data = $query->fetchArray(SQLITE3_ASSOC);

    if (!empty($data)) {
        $ok = false;
        $message[] = "Username/email telah terdaftar.";
    }
    else {
        // enkripsi password, masukin ke database
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $query_insert = $db->query("INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashed');");
        // $message[] = "Akun berhasil mendaftar. Selamat berbelanja!";
        // session
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $hashed;
        $_SESSION['isAdmin'] = 0;
        // cookies
        $time = time() + (3600);
        setcookie("username",$username,$time,'/');
        setcookie("password",$hashed,$time);
        setcookie("isAdmin",0,$time);


    }
}

echo json_encode(
    array(
        'ok' => $ok,
        'message' => $message
    )
)
?>