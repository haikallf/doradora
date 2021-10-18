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
    <link rel="stylesheet" href="./css/header-user.css" />
    <link rel="stylesheet" href="./css/product-details.css" />
    <title>Produk</title>
</head>

<body>
    <?php
    require_once( 'functions.php' );
    session_start();
    if(array_key_exists('addtocart', $_POST)) {
        if (isset($_SESSION['username'])) {
            addToCart($_SESSION['username'], $_POST['title'], $_POST['harga'], $_POST['img']);
        }
        else{
            echo "<script>alert('Anda harus login untuk menambah item ke keranjang');</script>";
        }
    }    
    ?>

    <?php
        require_once( 'database.php' );
        if (isset($_GET["idItem"])) {
            $item = findItemByID($_GET["idItem"]);
        }
        else {
             $item = findItemByID($_GET["1"]);
        }
    ?>
    <div class="header">
        <div class="header-brand">
            <a href="./index.php">Doradora</a>
        </div>

        <div class="header-search">
            <input type="search" placeholder="Cari dorayaki disini">
            <div class="search-icon"><i class="fas fa-search"></i></div>
        </div>

        <div class="header-option">
            <div class="header-cart" title="Keranjang" onclick="goToCart()">
                <i class="fas fa-shopping-cart"></i>
            </div>

            <div class="header-wishlist" title="Wishlist">
                <i class="fas fa-heart"></i>
            </div>

            <div class="header-chat" title="Obrolan">
                <i class="fas fa-comment-dots"></i>
            </div>
        </div>

        <div class="vr"></div>

        <div class="header-history">
            <i class="fas fa-history"></i>
            <p>Order History</p>
        </div>

        <div class="vr"></div>

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
                if(array_key_exists('logout-btn', $_POST)) {
                    if (isset($_SESSION['username'])) {
                        session_destroy();
                        echo "<script>location.href='login.php'</script>";
                    }
                }
                else if(array_key_exists('login-btn', $_POST)){
                    echo "<script>location.href='login.php'</script>";
                }
            
            ?>
            <form method="POST">
            <?php if (isset($_SESSION['username'])) {?>
                    <input type='submit' name='logout-btn' style="outline: none; height: 25px; width: 75px; border-radius: 10px; border: 1px solid black;font-family: 'Poppins', sans-serif; background-color: black; color: white; cursor: pointer;transition: 0.5"
                     value="Log Out"/>
            <?php } else { ?>
                    <input type='submit' name='login-btn' style="outline: none; height: 25px; width: 75px; border-radius: 10px; border: 1px solid black;font-family: 'Poppins', sans-serif; background-color: black; color: white; cursor: pointer;transition: 0.5" value="Log In" />
                </div>
            <?php } ?>
        </form>
    </div>

    <div class="product-details">
        <div class="product-left">
            <img src=<?= $item[0]["gambar"]?> alt="" />
        </div>
        <div class="product-right">
            <div class="product-right-title">
                <h3><?= $item[0]["namaItem"]?></h3>
                <p>★★★★★</p>
                <p>Rp<?= $item[0]["harga"]?></p>
            </div>
            <div class="product-right-description">
                <h3>Deskripsi</h3>
                <p><?= $item[0]["deskripsi"]?></p>
            </div>
            <div class="product-right-button">
                <div class="product-right-button-primary">
                  <form method="POST">
                    <input type="hidden" name="img" value=${foto-dorayaki} />
                    <input type="hidden" name="title" value="${nama-dorayaki}" />
                    <input type="hidden" name="harga" value=${harga-dorayaki} />
                    <input type="hidden" name="quantity" value=${jumlah-dorayaki} />
                    <div class="add-to-cart">
                        <button type="submit" name="addtocart"><i class="fas fa-shopping-cart"></i> KERANJANG</button>
                    </div>
                  </form>
                    <div class="buy-now">
                        <button><i class="fas fa-wallet"></i> BELI SEKARANG</button>
                    </div>
                </div>
                <div class="product-right-button-secondary">
                    <div class="wishlist-button">
                        <button><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                    <div class="chat-button">
                        <button><i class="fas fa-comment-dots"></i> Chat</button>
                    </div>
                    <div class="share-button">
                        <button><i class="fas fa-share-alt"></i> Share</button>
                    </div>
                </div>
            </div>
            <div class="hr">
                <hr />
            </div>
            <div class="product-right-delivery">
                <h3>Pengiriman</h3>
                <div class="product-right-delivery-location">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Dikirim dari <b>Jakarta Pusat</b></p>
                </div>
                <div class="product-right-delivery-cost">
                    <i class="fas fa-truck"></i>
                    <p>Ongkir Reguler Rp19000</p>
                </div>
                <p>Estimasi tiba 1 September 2021</p>
                <a href="#">Lihat pilihan kurir</a>
            </div>
        </div>
    </div>


    <script src="./js/index.js"></script>
</body>

</html>