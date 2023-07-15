<?php
if (!empty($_POST['phone']) && !empty($_POST['password'])) {
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $result = array();

    $con = mysqli_connect("localhost", "root", "", "microgatgets");
    if($con) {
        $sql = "select * from users where phone = '" . $phone . "'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            if ($phone == $row['phone'] && password_verify($password, $row['password'])) {
                try {
                    $apiKey = bin2hex(random_bytes(23));
                } catch (Exception $e) {
                    $apiKey = bin2hex(uniqid($email, true)); 
                }
                $sqlUpdate = "update users set api_key = '" . $apiKey . "' where phone = '" . $phone . "'";
                if (mysqli_query($con, $sqlUpdate)) {
                    $result = array("status" => "success", "message" => "Login successful", "name" => $row['name'], "phone" => $row['phone'], "api_key" => $apiKey, 
                "surname" => $row['surname'], "patronimyc" => $row['patronimyc'], "birthday" => $row['birthday'], "country" => $row['country'], "city" => $row['city'], 
                "id" => $row['id']);
                } else
                    $result = array("status" => "failed", "message" => "Login failed try again");
            } else
                $result = array("status" => "failed", "message" => "Retry with correct email and password");
        } else
            $result = array("status" => "failed", "message" => "Retry with correct email and password");
    } else
        $result = array("status" => "failed", "message" => "Database connection failed");
} else
    $result = array("status" => "failed", "message" => "All fields are required");

echo json_encode($result, JSON_PRETTY_PRINT);