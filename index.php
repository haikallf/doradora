<?php
    session_start();  
    if (isset($_SESSION['isAdmin'])) { 
        $isAdmin = $_SESSION['isAdmin'];
    } else {
        $isAdmin = -1;
    }
    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="./css/header-user.css" />
    <link rel="stylesheet" href="./css/index.css" />
    <title>Home</title>
  </head>
  <body onload="renderHeader(<?= $isAdmin?>, 1)">
    <div class="header">
        <div class="header-brand" onclick="goToHomeFromHome()">
            Doradora
        </div>

        <div class="header-search">
            <form action="./pages/search-result.php" id="search-form" name="search-form" method="GET">
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

            if(array_key_exists('logout-btn', $_POST)) {
                if (isset($_SESSION['username'])) {
                    $_SESSION = [];
                    session_unset();
                    session_destroy();
                    header("Location: index.php");
                    exit;
                }
            }
            else if(array_key_exists('login-btn', $_POST)) {
                header("Location: ./pages/login.php");
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
    
    <div class="product-container">
        <div class="product">
            <?php 
                require_once("./check/db-index.php");
                // syncStockAndQuantity();
                if ($isAdmin == 1) {
                    $itemArray = loadAllItem();
                }
                else{
                    $itemArray = loadAllAvailableItem();
                }
            
            ?>
            <?php for($i = 0; $i < count($itemArray); $i++) {?>
                <form action="./pages/product-details.php" method="GET" name="itemForm" id="itemForm-<?=$i?>" class="itemForm">
                    <div class="product-card" onclick="submitData(<?=$i?>)">
                        <img src=<?= $itemArray[$i]["gambar"]?> alt="Gambar tidak tersedia.">
                        <p><?= $itemArray[$i]["namaItem"]?></p>
                        <p>★★★★★</p>
                        <p>Rp. <?= number_format($itemArray[$i]["harga"])?></p>
                        <input type="hidden" name="idItem" value=<?= $itemArray[$i]["idItem"]?>>
                        <!-- <input type="submit" name="" id="submit" value="gas"> -->
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>

    <div class="container" id="container"></div>
    <div class="pagination">
        <ul></ul>
    </div>
    <script src="./js/index.js"></script>
  </body>
</html>
