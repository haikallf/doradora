<?php

    $pdo = new PDO("sqlite:database.db");

    $statement = $pdo->query("SELECT * FROM user");

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    var_dump($rows);