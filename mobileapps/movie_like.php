<?php

$response = array();
$movID = $_REQUEST['movie_id'];
include '../config.php';

if (!empty($movID)) {


    $sql_query = "INSERT INTO c_likes (MovieID,UserIPAddress,`AddDate`) VALUES ('" . $movID . "','" . $_SERVER['REMOTE_ADDR'] . "','" . date('Y-m-d h:i:s') . "')";
    $sql_like_count = "SELECT * FROM c_likes WHERE MovieID = '" . $movID . "'";
    mysql_query($sql_query); //insert into c_likes in hbodefined database configuration

    $res_like_count = mysql_query($sql_like_count);
    if (mysql_num_rows($res_like_count) > 0) {
        $likes = mysql_num_rows($res_like_count);
        $likes = $likes + 5;

        $response["success"] = $likes . " Likes";
    } else {
        $response["success"] = "5 Likes";
    }
    echo json_encode($response);
} else {
    echo 'HBO India API';
}
?>