<?php
if (
    !empty($_POST['phone']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['patronimyc']) && !empty($_POST['birthday'])
    && !empty($_POST['country']) && !empty($_POST['city'])
) {
    $con = mysqli_connect("localhost", "root", "", "microgatgets");

    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $patronymic = $_POST['patronimyc'];
    $birthday = date('Y-m-d', strtotime($_POST['birthday']));
    $country = $_POST['country'];
    $city = $_POST['city'];
    if ($con) {
        $sql = "insert into users (phone, password, name, surname, patronimyc, birthday, country, city) values ('" . $phone . "', '" . $password . "', '" . $name . "', '" . $surname . "', 
            '" . $patronymic . "', '" . $birthday . "', '" . $country . "', '" . $city . "')";
        if (mysqli_query($con, $sql)) {
            echo "success";
        } else
            echo "Ошибка регистрации";
    } else
        echo "Ошибка подключения к базе данных";
} else
    echo "Все поля должны быть заполнены";