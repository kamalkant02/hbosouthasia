<?php

        include ('config.php');

            $error_msg = "";
            $ipaddress = $_SERVER['REMOTE_ADDR']; //ipaddress
            $user_agent = $_SERVER['HTTP_USER_AGENT']; //ipaddress
            $date = date('Y-m-d H:i:s'); //current date and time
            $name = $_POST['txtname']; //name   
            $name = DoSecure($name);
            $name = ucwords($name);
            if ($name == '') {
                $error_msg.="Please enter your name.";
            }
            $movie_name = $_POST['movie_name'];
            $email = $_POST['txtemail']; //email id
            $email = DoSecure($email);
            if ($email == '') {
                $error_msg.="Please enter your email.";
            }
            if (!ereg("[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]", $email)) {
                $error_msg.= "Please enter a valid email." . "";
            }
            $hour = $_POST['cmbhour']; //hour
            $hour = DoSecure($hour);
            if ($hour == '') {
                $error_msg.="Please select movie alert time.";
            }

            $mscheduleid = $_POST['mscheduleid']; //movie schedule id

            $arriving_time = $_POST['arivingtime']; //arriving time

            $sending_time = date('Y-m-d H:i:s', strtotime($arriving_time . "- $hour hour"));


            //submit alertme table
            if ($error_msg == '') {
				
                $sql = "INSERT INTO alertme (name,email,movie_id,sending_time,alert_hour,ipaddress,user_agent,adding_date) VALUES('$name','$email','$mscheduleid','$sending_time','$hour','$ipaddress','$user_agent','$date')";

                $result = mysql_query($sql);
                $row_effected = (int) $result;

                if ($row_effected > 0) {
                    $sucees_msg = '<div class="popup">';
                    $sucees_msg .=  '<p>Thank you ' . ucfirst($name) . ' for using the HBO South Asia website.</p><p>You will be reminded for \'' . $movie_name . '\' before ' . $hour . ' hours.</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
                    $sucees_msg .= '</div>';
					
					echo $sucees_msg;
					exit;

                } else {
                    echo $error_msg = "Error. Please try again.";
					exit;
                }
            } else {
                echo $error_msg = "Error. Please try again.";
				exit;
            }
?>