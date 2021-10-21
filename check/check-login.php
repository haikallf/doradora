<?php 

$db = "../db/database.db";

$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';

$ada = true;
$message = array();

if (!isset($username) || empty($username)) {
    $ada = false;
    $message[] = "Username cannot be empty!";
}

if (!isset($password) || empty($password)) {
    $ada = false;
    $message[] = "Username cannot be empty!";
}

if ($ada) {
    // cari username di database
    console.log("ada");
    $db = new SQLite3($GLOBALS['db']);
    $query = $db->query("SELECT * FROM user WHERE username = '$username'");
    $data = $query->fetchArray(SQLITE3_ASSOC);

    if (empty($data)) {
        $message[] = "Wrong username or password!";
    } else {
        // $hashedPwd = $data["password"];
        // cek password
        // $status = password_verify($password, $hashedPwd);
        if ($password == $data["password"]) {
            $status = 1;
        } else {
            $status = 0;
        }
        if ($status == 0) {
            $message[] = "Wrong username or password!";
        } else {
            $message[] = "Selamat datang "+$data["username"];
            // cookies
            // setcookie("username",$username);
            // setcookie("isAdmin",$isAdmin);
        }
    }
}

echo json_encode(
    array(
        'ok' => $ada,
        'message' => $message
    )
)
?>
