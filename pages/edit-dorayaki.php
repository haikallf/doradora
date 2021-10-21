<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="../css/header-user.css" />
    <!-- <link rel="stylesheet" href="../css/product-details.css" /> -->
    <link rel="stylesheet" href="../css/edit-dorayaki.css" />
    <title>Produk</title>
</head>
    <?php
    // $id = "1";
    require_once( './functions.php' );
    require_once( '../check/database.php' );
    session_start();
    if(array_key_exists('add-to-cart', $_POST)) {
        if (isset($_SESSION['username']) && isset($_POST["quantity-hidden"])) {
            if(isset($_POST["idItem"])){
                addToCart($_SESSION["username"], $_POST["idItem"], $_POST["quantity-hidden"]);
            }
        }
        else{
            echo "<script>alert('Anda harus login untuk menambah item ke keranjang');</script>";
        }
    }

    else if (array_key_exists('delete-item', $_POST)){
        deleteItem($_POST['idItem']);
        echo "<script>alert('Penghapusan dorayaki berhasil!');</script>";
    }
    
    if (isset($_SESSION['username'])) {
        $isAdmin = $_SESSION['isAdmin'];
    }
    else {
        $isAdmin = -1;
    }
    ?>

    <?php
        require_once( '../check/database.php' );
        if (isset($_GET["idItem"])) {
            $id = $_GET["idItem"];
        }
        else {
             $id = "1";
        }
    ?>

<body onload="renderHeader(<?= $isAdmin?>)">
    <div class="header">
        <div class="header-brand" onclick="javascript:location.href = '../index.php';">
            Doradora
        </div>

        <div class="header-search">
            <form action="search-result.php" id="search-form" name="search-form" method="GET">
                <input type="text" name="search-query" placeholder="Cari dorayaki disini">
                <div class="search-icon" onclick="submitSearch()"><i class="fas fa-search"></i></div>
            </form>
        </div>

        <div id="header-user-admin"></div>

        <div class="header-user">
            <i class="fas fa-user"></i>
            <?php if (isset($_SESSION['username'])) {?>
                <p><?= $_SESSION['username'] ?></p>
            <?php } else { ?>
                <p>Guest</p>
            <?php } ?>
            
        </div>
        
        <div class="vr"></div>

        <?php 
            require_once( '../check/database.php' );
            if(array_key_exists('logout-btn', $_POST)) {
                if (isset($_SESSION['username'])) {
                    $_SESSION = [];
                    session_unset();
                    session_destroy();
                    header("Location: ../index.php");
                    exit;
                }
            }
            else if(array_key_exists('login-btn', $_POST)){
                header("Location: login.php");
                exit;
            }
        ?>

        <div class="login-logout">
            <form method="POST">
                <?php if (isset($_SESSION['username'])) {?>
                    <input type='submit' name='logout-btn' id='logout-btn' value="Log Out"/>
                <?php } else { ?>
                    <input type='submit' name='login-btn' id='login-btn' value="Log In" />
                <?php } ?>
            </form>
        </div>
    </div>

    <div class="product-details">
        <div class="product-left">
            <img id="gambar" src="" alt="Gambar tidak tersedia."/>
        </div>
        <div class="product-right">
            <?php $item = findItemByID($id) ?>
            <form action="">
                <div class="product-right-info">
                    <p>Nama dorayaki:</p>
                    <input type="text" name="namaItem" id="namaItem" value='<?= $item[0]["namaItem"] ?>'>
                    <p>Harga dorayaki:</p>
                    <input type="number" name="harga-dorayaki" id="harga-dorayaki" value=<?= $item[0]["harga"] ?>  min=1>
                    <p>Stok dorayaki:</p>
                    <input type="number" name="stok-dorayaki" id="stok-dorayaki" value=<?= $item[0]["stok"] ?> min=1>
                    <p>Terjual:</p>
                    <input type="number" name="terjual-dorayaki" id="stok-dorayaki" value="" min=1>
                </div>
                <div class="product-right-description">
                    <p>Deskripsi</p>
                    <input type="text" name="deskripsi" <?= $item[0]["deskripsi"] ?>>
                </div>
                <div class="done-btn">
                    <input type="hidden" name="idItem" value=<?=$id ?> />
                    <button type="submit" name="delete-item"><i class="fas fa-check"></i> SIMPAN</button>
                </div>
            </form>
            <div class="hr">
                <hr />
            </div>
        </div>
    </div>
    <script>
        // var items = '<p echo json_encode($item); ?>';
        // items = JSON.parse(items);
        id = <?=$id ?>;
        loadItem();
        document.addEventListener("click",loadItem);
        function loadItem() {
            const ajax = new XMLHttpRequest();
            ajax.onload = function () {
                var items = ajax.responseText;
                items = JSON.parse(items);
                document.getElementById("gambar").src = '.'+items[0]["gambar"];
                document.getElementById("namaItem").innerHTML = items[0]["namaItem"];
                document.getElementById("harga").innerHTML = "Rp. " + items[0]["harga"].toLocaleString("en-US");
                document.getElementById("stok").innerHTML = "Stok : " + items[0]["stok"];
                document.getElementById("deskripsi").innerHTML = items[0]["deskripsi"];
                document.getElementById("quantity").setAttribute("max", items[0]["stok"]);
                document.getElementById("quantity-hidden").value = document.getElementById("quantity").value;
            }
            
            ajax.open("GET", "../check/db-product-details.php?id="+id, true);
            ajax.send();

            
        }
    </script>

    <script src="./js/index.js"></script>
</body>

</html>