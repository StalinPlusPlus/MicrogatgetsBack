<?php
if (!empty($_POST['phone']) && !empty($_POST('api_key'))) {
    $phone = $_POST['phone'];
    $apiKey = $_POST['api_key'];
    $result = array();

    $con = mysqli_connect("localhost", "root", "", "microgatgets");
    if ($con) {
        $sql = "select * from users where phone = '" . $phone . "' and api_key = '" . $apiKey . "'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            $result = array("status" => "success", "message" => "Data fetched successful", "name" => $row['name'], "phone" => $row['phone'], "apiKey" => $row['api_key']);
        } else
            $result = array("status" => "failed", "message" => "Unauthorised success");
    } else
        $result = array("status" => "failed", "message" => "Database connection failed");
} else
    $result = array("status" => "failed", "message" => "All fields are required");

echo json_encode($result, JSON_PRETTY_PRINT);