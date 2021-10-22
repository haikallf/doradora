<?php
    session_start();
    if (isset($_SESSION['username'])) {

    }
    else {
        echo "<script>location.href='login.php'</script>";
    }

    if (isset($_SESSION['username'])) {
        $isAdmin = $_SESSION['isAdmin'];
    }
    else {
        $isAdmin = -1;
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
    <link rel="stylesheet" href="../css/order-history.css" />
    <title>Riwayat Pembelanjaan</title>
</head>

<body onload="renderHeader(<?= $isAdmin?>)">
    <div class="header">
        <div class="header-brand" onclick="goToHome()">
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
            if(array_key_exists('logout-btn', $_POST)) {
                if (isset($_SESSION['username'])) {
                    $_SESSION = [];
                    session_unset();
                    session_destroy();
                    setcookie('TKN','',time() - 3600,'/');
                    header("Location: ../index.php");
                    exit;
                }
            }
            else if(array_key_exists('login-btn', $_POST)){
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
    
    <div class="order-history-title">
        <p>Riwayat Pembelian</p>
    </div>
    <?php 
        require_once('../check/db-history.php');
        $itemArray = historyByUser($_SESSION['username']);
    ?>
    <div class="order-history-container">
        <div class="order-history-left">
            <div class="order-history-product">
                <!-- <div class="order-history-img-container">
                    <img src="./images/dorayaki.jpg" alt="foto buku" />
                </div> -->
                <div class="order-history-details-container">
                    <div class="order-history-details">
                        <?php for($i = 0; $i < count($itemArray); $i++) {?>
                            <form action="./pages/product-details.php" method="GET" name="itemForm" id="itemForm-<?=$i?>" class="itemForm">
                                <div class="order-history-details" onclick="submitData(<?=$i?>)">
                                    <p><?= "Waktu : ".$itemArray[$i]["tanggal"]?></p>
                                    <p><?= "Nama item : ".findItemName($itemArray[$i]["idItem"])?></p>
                                    <p><?= "Jumlah : ".(-1*$itemArray[$i]["quantity"])?></p>
                                    <input type="hidden" name="idItem" value=<?= $itemArray[$i]["idItem"]?>>
                                </div>
                            </form>
                        <?php } ?>
                    </div>                  
                </div>
            </div>
        </div>
    </div>

    <script src="./js/index.js"></script>
</body>

</html>