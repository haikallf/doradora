<?php 

function login($username_, $password_){
    $pdo = new PDO("sqlite:database.db");

    $statement = $pdo->query("SELECT * FROM user");

    $userDat = $statement->fetchAll(PDO::FETCH_ASSOC);

    $i = 0;
    $found = false;

    while ($i < count($userDat) && !$found){
        if ($userDat[$i]["username"] == $username_){
            if($userDat[$i]["password"] == $password_){
                $found = true;
            } 
        }
        $i++;
    }

    if ($found){
        return $username_;
    }
    else {
        echo "<script>alert('Username or password incorrrect!');</script>";
        echo "<script>location.href='login.php'</script>";
        return null;
    }   
}

function signup($username_, $password_, $email_){
    $pdo = new PDO("sqlite:database.db");

    $statement = $pdo->query("SELECT * FROM user");

    $userDat = $statement->fetchAll(PDO::FETCH_ASSOC);

    $i = 0;
    $foundUsername = false;
    $foundEmail = false;
    
    while ($i < count($userDat) && !$foundUsername && !$foundEmail){
        if ($userDat[$i]["username"] == $username_){
            $foundUsername = true;
        }
        if($userDat[$i]["email"] == $email_){
            $foundEmail = true;
        } 
        $i++;
    }

    if ($foundUsername){
        if ($foundEmail){
            echo "<script>alert('Username and Email already exists');</script>";
            echo "<script>location.href='login.php'</script>";
            return null;
        }
        else {
            echo "<script>alert('Username already exists');</script>";
            echo "<script>location.href='login.php'</script>";
            return null;
        }
    }
    if ($foundEmail){
        echo "<script>alert('Email already exists');</script>";
        echo "<script>location.href='login.php'</script>";
        return null;
    } 
    if (!$foundUsername && !$foundEmail) {
        $sql = $pdo->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)");
        $sql -> bindValue(":username", $username_);
        $sql -> bindValue(":email", $email_);
        $sql -> bindValue(":password", $password_);
        $res = $sql -> execute();
        // echo "<script>alert('Username or password incorrrect!');</script>";
        // echo "<script>location.href='login.php'</script>";
        echo "<script>alert('Thanks for Signing Up!');</script>";
        echo "<script>location.href='login.php'</script>";  
    }   

}