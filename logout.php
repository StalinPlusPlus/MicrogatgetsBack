<?php
if (!empty($_POST['phone']) && !empty($_POST['api_key'])) {
    $phone = $_POST['phone'];
    $apiKey = $_POST['api_key'];
    $con = mysqli_connect("localhost", "root", "", "microgatgets");
    if ($con) {
        $sql = "select * from users where phone = '" . $phone . "' and api_key = '" . $apiKey . "'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res)) {
            $row = mysqli_fetch_assoc($res);
            $sqlUpdate = "update users set api_key = '' where phone = '" . $phone . "'";
            if (mysqli_query($con, $sqlUpdate)) {
                echo "success";
            } else
                echo "Ошибка выхода из профиля";
        } else
            echo "Неавторизованный доступ";
    } else
        echo "Ошибка подключения к базе данных";
} else
    echo "Все поля должны быть заполнены";