<?php
$cost = "";
if (!empty($_POST['id_device']) && !empty($_POST['id_user']) && !empty($_POST['id_order_type']) && !empty($_POST['cost'])) {
    $con = mysqli_connect("localhost", "root", "", "microgatgets");

    $id_device = $_POST['id_device'];
    $id_user = $_POST['id_user'];
    $id_order_type = $_POST['id_order_type'];
    $cost = $_POST['cost'];

    if ($id_order_type == 1 && !empty($_POST['date_start']) && !empty($_POST['date_end'])) {
        $srok = "P".$_POST['date_end']."D";
        $interval = new DateInterval($srok);
        $date_start = date('Y-m-d', strtotime($_POST['date_start']));
        $date = DateTime::createFromFormat('Y-m-d', $date_start);
        $date->add($interval);
        $date_end = $date->format('Y-m-d');
        if ($con) {
            $sql = "insert into orders (id_device, id_user, date_start, date_end, id_order_type, cost) values ('".$id_device."', '".$id_user."', '".$date_start."', '".$date_end."', 
                '".$id_order_type."', '".$cost."')";

            if (mysqli_query($con, $sql)) {
                echo "Заказ успешно создан!";
            } else {
                echo "Ошибка запроса";
            }
        } else
            echo "Ошибка подключения к базе данных";
    } else {
        if ($con) {
            $sql = "insert into orders (id_device, id_user, id_order_type, cost) values ('".$id_device."', '".$id_user."', '".$id_order_type."', '".$cost."')";

            if (mysqli_query($con, $sql)) {
                echo "Заказ успешно создан!";
            } else {
                echo "Ошибка запроса";
            }
        } else {
            echo "Ошибка запроса";
        }
    }
} else
    echo "Все поля должны быть заполнены! - '".$cost."'";