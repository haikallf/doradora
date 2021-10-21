<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        echo "<script>alert('Anda harus login untuk mengakses halaman ini');</script>";
        echo "<script>location.href='index.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="../css/header-user.css" />
    <link rel="stylesheet" href="../css/cart.css" />
    <title>Keranjang</title>
</head>

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
            require_once( 'functions.php' );
            require_once( '../check/database.php' );
            if(array_key_exists('logout-btn', $_POST)) {
                if (isset($_SESSION['username'])) {
                    session_destroy();
                    echo "<script>location.href='login.php'</script>";
                }
            }
            else if(array_key_exists('login-btn', $_POST)){
                echo "<script>location.href='login.php'</script>";
            }

             else if(array_key_exists('cart-quantity-check-btn', $_POST)){
                setQuantityCart($_SESSION['username'], $_POST['idItem'], $_POST['quantity']);
             }
             else if(array_key_exists('checkout-btn', $_POST)){
                buyItemFomCart($_SESSION['username'], "2020/22/21");
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

    <div class="cart-title">
        <p>Keranjang</p>
    </div>
    <div class="cart-container">
        <div class="cart-left">
        <?php if($_SESSION['isAdmin'] != -1) {?>

        <?php
            require_once( '../check/database.php' );
            $cartItem = getCartItem($_SESSION['username']);
        ?>
        <?php for($i = 0; $i < count($cartItem); $i++) {?>
            <?php $item = findItemByID($cartItem[$i]["idItem"])?>
            <div class="cart-product">
                <div class="cart-img-container">
                    <img src=<?= ".".$item[0]["gambar"]?> alt="foto dorayaki" />
                </div>
                <div class="cart-details-container">
                    <div class="cart-details">
                        <p><?= $item[0]["namaItem"]?></p>
                        <strong><?= $item[0]["harga"]?></strong>
                        <form method="POST">
                            <input type="hidden" name="idItem" value=<?= $item[0]["idItem"]?>>
                            <input id="cart-qty" type="number" name="quantity" min="1" value=<?= $cartItem[$i]["quantity"]?> max=<?= $item[0]["stok"]?>>
                            <button id="cart-quantity-check-btn" name="cart-quantity-check-btn" type="submit"><i class="fas fa-check"></i></button>
                        </form>
                    </div>
                    <!-- <form action="" method="POST">
                        <input type="hidden" name="title" value="asdsa">
                        <button class="cart-del-btn" type="submit" name="delfromcart">
                            <i class="fas fa-trash-alt fa-2x"></i>
                        </button>
                    </form> -->
                    
                </div>
            </div>
            <?php } ?>
        <?php } else {?>
        <?php
            require_once( '../check/database.php' );
            $allItem = loadAllItem($_SESSION['username']);
        ?>
        <?php for($i = 0; $i < count($allItem); $i++) {?>
            <div class="edit-product">
                <div class="edit-img-container">
                    <img src=<?= ".".$allItem[$i]["gambar"]?> alt="foto dorayaki" />
                </div>
                <div class="edit-details-container">
                    <div class="edit-details">
                        <form method="POST">
                            <div class="edit-details-left">
                                <p>Nama Dorayaki:</p>
                                <input type="text" name="edit-namaItem" id="edit-namaItem" value='<?= $allItem[$i]["namaItem"]?>'>
                                <p class="bottom-label">Harga:</p>
                                <input type="number" name="edit-harga" id="edit-harga" value=<?= $allItem[$i]["harga"]?>>
                            </div>
                            
                            <div class="edit-details-right">
                                <p>Stok:</p>
                                <input type="number" name="edit-stok" id="edit-stok" value=<?= $allItem[$i]["stok"]?>>
                                <p class="bottom-label">Deskripsi:</p>
                                <input type="text" name="edit-deskripsi" id="edit-deskripsi" value='<?= $allItem[$i]["deskripsi"]?>'>
                            </div>
                            
                            <div class="edit-check-btn">
                                <input type="hidden" name="idItem" value=<?= $allItem[$i]["idItem"]?>>
                                <button id="edit-check-btn" name="edit-check-btn" type="submit"><i class="fas fa-check"></i></button>
                            </div>
                            
                        </form>
                    </div>
                    <!-- <form action="" method="POST">
                        <input type="hidden" name="title" value="asdsa">
                        <button class="cart-del-btn" type="submit" name="delfromcart">
                            <i class="fas fa-trash-alt fa-2x"></i>
                        </button>
                    </form> -->
                    
                </div>
            </div>
        <?php } ?>
        <?php } ?>
        </div>


        <?php if ($_SESSION['isAdmin'] != 1) {?>
            <div class="cart-right">
                <div class="cart-right-promo">
                    <input type="text" placeholder="Masukkan kode promo">
                </div>
                <div class="cart-right-total">
                    <h2>Ringkasan Belanja</h2>
                    <div class="subtotal">
                        <?php $subtotalArray = cartItemSubtotal($_SESSION['username']);?>
                        <p>Subtotal (<?= $subtotalArray['totalItem'] ?> barang):</p>
                        <p>Rp<?= $subtotalArray['subtotal'] ?></p>
                    </div>
                    <div class="shipping">
                        <p>Ongkos Kirim:</p>
                        <p>Rp0</p>
                    </div>
                    <div class="hr">
                        <hr>
                    </div>
                    <div class="total">
                        <p>Total:</p>
                        <p>Rp<?= $subtotalArray['subtotal'] ?></p>
                    </div>
                    <div class="checkout-btn">
                        <form method="POST">
                            <button type="button" name="checkout-btn">Beli</button>
                        </form>
                        
                    </div>
                </div>
            </div>
            <?php } ?>    
        </div>

    <script src="./js/index.js"></script>
</body>

</html>