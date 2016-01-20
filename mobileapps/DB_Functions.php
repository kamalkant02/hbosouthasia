<?php

class DB_Functions {

    private $db;
    public $con = "";

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->con = $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /*
     * Funtion for fetching hq questions
     */

    public function fetchHQQues() {

        $quesArr = array();
        $apps_hq = mysql_query("SELECT * FROM `apps_hq` WHERE (DATE('" . date("Y-m-d") . "') BETWEEN DATE(start_date) AND DATE(end_date)) 
								AND s_status = '1'"); //return sql result  

        if (mysql_num_rows($apps_hq) > 0) {
            $row = mysql_fetch_array($apps_hq);
            //$quesArr['hq_id'] = $row['id'];
            //$quesArr['hq_name'] = $row['hq_name'];
            $hq_ques = mysql_query("SELECT * FROM `apps_hq_questions` WHERE hq_id = '" . $row['id'] . "' AND q_status = 1"); //return sql result
            if (mysql_num_rows($hq_ques) > 0) {
                $i = 0;
                while ($res_ques = mysql_fetch_array($hq_ques)) {
                    $quesArr[$i]['hq_id'] = $res_ques['hq_id'];
                    $quesArr[$i]['ques_id'] = $res_ques['id'];
                    $quesArr[$i]['question_name'] = $res_ques['questions_name'];
                    $quesArr[$i]['opt1'] = $res_ques['opt1'];
                    $quesArr[$i]['opt2'] = $res_ques['opt2'];
                    $quesArr[$i]['opt3'] = $res_ques['opt3'];
                    $quesArr[$i]['opt4'] = $res_ques['opt4'];
                    $quesArr[$i]['ans'] = $res_ques['ans'];
                    $i++;
                }
            } else {
                return false;
            }
            return $quesArr;
        } else {
            return false;
        }
    }

    /* Function for submitting score & each question with user answer */

    public function submitScore($hqID, $userID, $score, $ques) {

        $insert_hq_users = mysql_query("INSERT INTO apps_hq_users(`hq_id`,`user_id`,`score`,`created`,`updated`) VALUES	('" . $hqID . "','" . $userID . "','" . $score . "','" . date("Y-m-d H:i:s") . "','" . date("Y-m-d  H:i:s") . "')");
        $apps_hq_users = mysql_insert_id();
        if (!empty($apps_hq_users)) {

            $questions = explode(":~:", $ques);
            foreach ($questions as $val) {
                //[ques] => B@@1:~:Y@@2:~:Christian Bale@@3:~:Dax Shepard@@4:~:2009@@5:~:Joseph McGinty Nichol@@6:~:2011@@7:~:Tom Cruise@@8:~:Hugh Jackman@@9:~:Tom Cruise@@10:~:)

                $temp = explode("@@", $val);
                if (!empty($temp[0]) && !empty($temp[1])) {
                    mysql_query("INSERT INTO apps_hq_users_ans(`hq_user_score_id`,`ques_id`,`user_ans`,`created`,`updated`)
 							VALUES('" . $apps_hq_users . "','" . $temp[1] . "','" . $temp[0] . "','" . date("Y-m-d  H:i:s") . "','" . date("Y-m-d  H:i:s") . "')");
                }
            }
            $success = "Successfully Inserted";
            return $success;
        } else {
            return false;
        }
    }

    /* Function for submitting score & each question with user answer */

    public function leaderboard($format) {

        $leaderArr = array();
        if ($format == 'monthly') {
            $leader_month = mysql_query("SELECT hq_usr.*, fb.fbuserid, fb.name, hq.start_date, hq.end_date FROM apps_hq_users hq_usr 
		  							   JOIN fb_users fb ON hq_usr.user_id = fb.id JOIN apps_hq hq ON hq.id = hq_usr.hq_id 
									   WHERE DATE(hq.start_date) >= (DATE('" . date('Y-m-d', strtotime('today - 30 days')) . "')) 
									   ORDER BY hq_usr.score DESC");
            if (mysql_num_rows($leader_month) > 0) {

                $k = '0';
                while ($leader_rows = mysql_fetch_array($leader_month)) {
                    //$leaderArr[$k]['id'] = $leader_rows['id'];
                    $leaderArr[$k]['hq_id'] = $leader_rows['hq_id'];
                    //$leaderArr[$k]['user_id'] = $leader_rows['user_id'];
                    $leaderArr[$k]['score'] = $leader_rows['score'];
                    $leaderArr[$k]['name'] = $leader_rows['name'];
                    $leaderArr[$k]['start_date'] = date('Y-m-d', strtotime($leader_rows['start_date']));
                    $leaderArr[$k]['end_date'] = date('Y-m-d', strtotime($leader_rows['end_date']));
                    $leaderArr[$k]['fbuserid'] = $leader_rows['fbuserid'];
                    $leaderArr[$k]['profile_pic'] = "http://graph.facebook.com/" . $leader_rows['fbuserid'] . "/picture";
                    $k++;
                }
                return $leaderArr;
                //echo "<pre>";print_r($leaderArr);exit();
            } else {
                return false;
            }
        } else if ($format == 'weekly') {

            $leader_week = mysql_query("SELECT hq_usr.*, fb.fbuserid, fb.name, hq.start_date, hq.end_date FROM apps_hq_users hq_usr 
		  							   JOIN fb_users fb ON hq_usr.user_id = fb.id JOIN apps_hq hq ON hq.id = hq_usr.hq_id 
									   WHERE (DATE('" . date("Y-m-d") . "') BETWEEN DATE(hq.start_date) AND DATE(hq.end_date)) 
									   ORDER BY hq_usr.score DESC");
            if (mysql_num_rows($leader_week) > 0) {

                $k = '0';
                while ($leader_wk_rows = mysql_fetch_array($leader_week)) {
                    //$leaderArr[$k]['id'] = $leader_wk_rows['id'];
                    $leaderArr[$k]['hq_id'] = $leader_wk_rows['hq_id'];
                    //$leaderArr[$k]['user_id'] = $leader_wk_rows['user_id'];
                    $leaderArr[$k]['score'] = $leader_wk_rows['score'];
                    $leaderArr[$k]['name'] = $leader_wk_rows['name'];
                    $leaderArr[$k]['start_date'] = date('Y-m-d', strtotime($leader_wk_rows['start_date']));
                    $leaderArr[$k]['end_date'] = date('Y-m-d', strtotime($leader_wk_rows['end_date']));
                    $leaderArr[$k]['fbuserid'] = $leader_wk_rows['fbuserid'];
                    $leaderArr[$k]['profile_pic'] = "http://graph.facebook.com/" . $leader_wk_rows['fbuserid'] . "/picture";
                    $k++;
                }
                return $leaderArr;
            } else {
                return false;
            }
        } else if ($format == 'previous_week') {
            
            $d = strtotime("today");
            $start_week = date("Y-m-d", strtotime("last week monday", $d));
            $end_week = date("Y-m-d", strtotime("last week sunday", $d));

            $leader_pre_week = mysql_query("SELECT hq_usr.*, fb.fbuserid, fb.name, hq.start_date, hq.end_date FROM apps_hq_users hq_usr 
		  							   JOIN fb_users fb ON hq_usr.user_id = fb.id JOIN apps_hq hq ON hq.id = hq_usr.hq_id 
									   WHERE DATE(hq.start_date) = DATE('" . $start_week . "') AND DATE(hq.end_date) = DATE('" . $end_week . "')
									   ORDER BY hq_usr.score DESC");
            if (mysql_num_rows($leader_pre_week) > 0) {

                $k = '0';
                while ($leader_pre_rows = mysql_fetch_array($leader_pre_week)) {
                    //$leaderArr[$k]['id'] = $leader_pre_rows['id'];
                    $leaderArr[$k]['hq_id'] = $leader_pre_rows['hq_id'];
                    //$leaderArr[$k]['user_id'] = $leader_pre_rows['user_id'];
                    $leaderArr[$k]['score'] = $leader_pre_rows['score'];
                    $leaderArr[$k]['name'] = $leader_pre_rows['name'];
                    $leaderArr[$k]['start_date'] = date('Y-m-d', strtotime($leader_pre_rows['start_date']));
                    $leaderArr[$k]['end_date'] = date('Y-m-d', strtotime($leader_pre_rows['end_date']));
                    $leaderArr[$k]['fbuserid'] = $leader_pre_rows['fbuserid'];
                    $leaderArr[$k]['profile_pic'] = "http://graph.facebook.com/" . $leader_pre_rows['fbuserid'] . "/picture";
                    $k++;
                }
                return $leaderArr;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

	 /* Function for user leaderboard */

    public function my_score($user_id) {
		
		$userArr = array();
        $user_score = mysql_query("SELECT hq_usr.*, fb.fbuserid, fb.name, hq.start_date, hq.end_date FROM apps_hq_users hq_usr 
		  							   JOIN fb_users fb ON hq_usr.user_id = fb.id JOIN apps_hq hq ON hq.id = hq_usr.hq_id 
									   WHERE user_id = '" . $user_id . "' ORDER BY hq_usr.score DESC LIMIT 20"); //return sql result

        if (mysql_num_rows($user_score) > 0) { 
			$i = '0';
            while ($user_rows = mysql_fetch_array($user_score)) {
			 		//$userArr[$i['id'] = $user_rows['id'];
                    $userArr[$i]['hq_id'] = $user_rows['hq_id'];
                    //$userArr[$i]['user_id'] = $user_rows['user_id'];
                    $userArr[$i]['score'] = $user_rows['score'];
                    $userArr[$i]['name'] = $user_rows['name'];
                    $userArr[$i]['start_date'] = date('Y-m-d', strtotime($user_rows['start_date']));
                    $userArr[$i]['end_date'] = date('Y-m-d', strtotime($user_rows['end_date']));
                    $userArr[$i]['fbuserid'] = $user_rows['fbuserid'];
                    $userArr[$i]['profile_pic'] = "http://graph.facebook.com/" . $user_rows['fbuserid'] . "/picture";
			$i++;
			}
            return $userArr;
        } else {              
            return false;
        }
    }

    /* Function for fb user */

    public function fb_reg_user($fbuser_id, $name, $email, $first_name, $last_name, $gender) {

        $fb_user = mysql_query("SELECT * FROM `fb_users` WHERE fbuserid = '" . $fbuser_id . "'"); //return sql result

        if (mysql_num_rows($fb_user) > 0) { // user data already exist in DB
            $reg_usr = mysql_fetch_array($fb_user);
            $usrID = $reg_usr['id'];
            return $usrID;
        } else {  // inserting data on non existence
            $url = 'http://www.facebook.com/profile.php?id=' . $fbuser_id;

            mysql_query("INSERT INTO fb_users(fbuserid,name,link,email,adddate,updatedate)
 							VALUES('" . $fbuser_id . "','" . $name . "','" . $url . "','" . $email . "','" . date("Y-m-d") . "',
								   '" . date("Y-m-d") . "')");
            $fbuserID = mysql_insert_id();
            return $fbuserID;
        }
    }

    /* Function for User Played HQ or not */

    public function fetchHQPlayed($hq_id, $user_id) {

        $hq_row = mysql_query("SELECT * FROM `apps_hq_users` WHERE hq_id = '" . $hq_id . "' AND user_id = '" . $user_id . "'");
        if (mysql_num_rows($hq_row) > 0) {
            return "played";
        } else {
            return false;
        }
    }

    /*
      Function for storing device registration id
     */

    public function storeDeviceReg($regID, $mobileDevice, $user_id) {
        $result = mysql_query("INSERT INTO enc_notification(reg_id,user_id,reg_date,mobile_device)
		VALUES('" . $regID . "','" . $user_id . "','" . date('Y-m-d h:i:s') . "','" . $mobileDevice . "')");
        // check for successful store
        if ($result) {
            $tid = mysql_insert_id();
            return $tid;
        } else {
            return false;
        }
    }

    /*
      Function for storing device emei/uuid
     */

    public function storeIMEI($imeiNo, $mobileDevice) {
        $result = mysql_query("INSERT INTO enc_imei(emei,mobile_device,adding_date)
		VALUES('" . $imeiNo . "','" . $mobileDevice . "','" . date('Y-m-d h:i:s') . "')");
        // check for successful store
        if ($result) {
            $tid = mysql_insert_id();
            return $tid;
        } else {
            return false;
        }
    }

    /* Function for fetching xml entity decode */

    public function xml_entity_decode($s) {
        // illustrating how a (hypothetical) PHP-build-in-function MUST work
        static $XENTITIES = array('&amp;', '&gt;', '&lt;');
        static $XSAFENTITIES = array('#_x_amp#;', '#_x_gt#;', '#_x_lt#;');
        $s = str_replace($XENTITIES, $XSAFENTITIES, $s);
        $s = html_entity_decode($s, ENT_QUOTES, 'ISO-8859-1'); // PHP 5.3+
        $s = str_replace($XSAFENTITIES, $XENTITIES, $s);
        return $s;
    }

}

//<pre>Array(    [tag] => submit_hq_score    [api_username] => hboindia2015    [api_password] => India@1008@HBO    [user_id] => 1058    [hq_id] => 1    [score] => 2
//    [ques] => [Ljava.lang.String;@41dfbdd0)
//</pre>
//{"tag":"submit_hq_score","success":0,"error":1,"error_msg":"Data not found"}
?>