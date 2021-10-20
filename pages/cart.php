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

        <?php
            require_once( '../check/database.php' );
            $cartItem = getCartItem($_SESSION['username']);
        ?>
        <?php for($i = 0; $i < count($cartItem); $i++) {?>
            <?php $item = findItemByID($cartItem[$i]["idItem"])?>
            <div class="cart-product">
                <div class="cart-img-container">
                    <img src="./images/dorayaki.jpg" alt="foto buku" />
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
        </div>

        <div class="cart-right">
            <div class="cart-right-promo">
                <input type="text" placeholder="Masukkan kode promo">
            </div>
            <div class="cart-right-total">
                <h2>Ringkasan Belanja</h2>
                <div class="subtotal">
                    <p>Subtotal (1 barang):</p>
                    <p>Rp5000</p>
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
                    <p>Rp5000</p>
                </div>
                <div class="checkout-btn">
                    <button>Beli</button>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/index.js"></script>
</body>

</html>