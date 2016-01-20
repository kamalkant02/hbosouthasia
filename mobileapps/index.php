<?php

/**
  PHP API for Facebook Login, Fetch HQ Question , Submit Score, Leaderboard, My Score, Check HQ Playing Status and so on for HBO India Mobile app (Android & IOS).
 * */
$api_username = "hboindia2015"; //API Username
$api_password = "India@1008@HBO"; // API Password for access

if (isset($_REQUEST['tag']) && !empty($_REQUEST['tag']) && !empty($_REQUEST['api_username']) && !empty($_REQUEST['api_password'])) {

    $tag = $_REQUEST['tag']; //GET TAG    
    $apiUsername = $_REQUEST['api_username']; //Get Username
    $apiPassword = $_REQUEST['api_password']; //Get Password
    //check api username and api password, if password are wrong then show unauthorized access message
    if ($apiUsername == $api_username && $apiPassword == $api_password) {

        // Include Database handler
        require_once 'DB_Functions.php';
        $db = new DB_Functions();
        // response Array
        $response = array("tag" => $tag, "success" => 0, "error" => 0);

        // check for tag type
        if ($tag == 'hq_ques') {

            $hq_ques = $db->fetchHQQues();
            if ($hq_ques != false) {
                $response["success"] = 1;
                $response["success_msg"] = "Success";
                $response["ques"] = $hq_ques;
            } else {
                $response["error"] = 1;
                $response["error_msg"] = "Data not found.";
            }
            echo json_encode($response);
        } else if ($tag == 'submit_hq_score') {

            // Submit HQ Score            
            $userID = $_REQUEST['user_id'];
            $hqID = $_REQUEST['hq_id'];
            $score = $_REQUEST['score'];
            $ques = $_REQUEST['ques'];

            //check all fields are not empty
            if (!empty($userID) && !empty($hqID) && !empty($score) && !empty($ques)) {
                //sumit score
                $submit_score = $db->submitScore($hqID, $userID, $score, $ques);
                if ($submit_score != false) {
                    $response["success"] = 1;
                    $response["success_msg"] = "Success";
                    //$response["logs"] = $submit_score;
                } else {
                    $response["error"] = 1;
                    $response["error_msg"] = "Data not found";
                }
            } else {
                $response["error"] = 1;
                $response["error_msg"] = "Unauthorized Access.";
            }
            echo json_encode($response);
            
        } else if ($tag == 'leaderboard') {

            //leaderboards           
            $format = $_REQUEST['format'];

            if (!empty($format)) {

                $leaderboard = $db->leaderboard($format);
                if ($leaderboard != false) {
                    $response["success"] = 1;
                    $response["success_msg"] = "Success";
                    $response["logs"] = $leaderboard;
                } else {
                    $response["error"] = 1;
                    $response["error_msg"] = "Data not found";
                }
            } else {
                $response["error"] = 1;
                $response["error_msg"] = "Unauthorized Access.";
            }
            
            echo json_encode($response);
            
        }else if ($tag == 'my_score') {

 			// myscore
			$user_id = $_REQUEST['user_id'];
			 
            if (!empty($user_id)) {

                $my_score = $db->my_score($user_id);
                if ($my_score != false) {
                    $response["success"] = 1;
                    $response["success_msg"] = "Success";
                    $response["logs"] = $my_score;
                } else {
                    $response["error"] = 1;
                    $response["error_msg"] = "Data not found";
                }
            } else {
                $response["error"] = 1;
                $response["error_msg"] = "Unauthorized Access.";
            } 
            echo json_encode($response);
        } else if ($tag == 'fbreg_user') {

            //facebook registration
            $first_name = $last_name = $gender = $email = "";
            $fbuser_id = $_REQUEST['fbuser_id'];
            $name = $_REQUEST['name'];

            if (isset($_REQUEST['first_name']) && !empty($_REQUEST['first_name'])) {
                $first_name = $_REQUEST['first_name'];
            }
            if (isset($_REQUEST['last_name']) && !empty($_REQUEST['last_name'])) {
                $last_name = $_REQUEST['last_name'];
            }
            if (isset($_REQUEST['gender']) && !empty($_REQUEST['gender'])) {
                $gender = $_REQUEST['gender'];
            }
            if (isset($_REQUEST['email']) && !empty($_REQUEST['email'])) {
                $email = $_REQUEST['email'];
            }
            //check all fields are not empty
            if (!empty($fbuser_id) && !empty($name)) {

                $fb_reg_user = $db->fb_reg_user($fbuser_id, $name, $email, $first_name, $last_name, $gender);
                if ($fb_reg_user != false) {
                    $response["success"] = 1;
                    $response["success_msg"] = "Success";
                    $response["user_id"] = $fb_reg_user;
                    //$response["logs"] = $submit_score;
                } else {
                    $response["error"] = 1;
                    $response["error_msg"] = "Data not found";
                }
            } else {
                $response["error"] = 1;
                $response["error_msg"] = "Unauthorized Access.";
            }
            echo json_encode($response);
        } else if ($tag == 'check_hq') {

            //check user is played hq or not
            $hq_id = $_REQUEST['hq_id'];
            $user_id = $_REQUEST['user_id'];
            //check all fields are not empty
            if (!empty($hq_id) && !empty($user_id)) {

                $hq_user_played = $db->fetchHQPlayed($hq_id, $user_id);
                if ($hq_user_played != false) {
                    $response["success"] = 1;
                    $response["success_msg"] = $hq_user_played;
                } else {
                    $response["error"] = 1;
                    $response["error_msg"] = "not-played";
                }
            } else {
                $response["error"] = 1;
                $response["error_msg"] = "Unauthorized Access.";
            }
            echo json_encode($response);
        } else {
            $response["error"] = 4;
            $response["error_msg"] = "JSON ERROR";
            echo json_encode($response);
        }
    } else {
        $response["error"] = 1;
        $response["error_msg"] = "Unauthorized Access.";
        echo json_encode($response);
    }
} else {
    echo "HBO India API";
}
?>