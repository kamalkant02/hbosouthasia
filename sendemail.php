<?php

/*
 * Send Email for Reminder function
 * 
 */

ini_set("date.timezone", "Asia/Calcutta");
include ('dbconfig.php');
error_reporting(E_ALL);

$ariving_time = "";
$from_time = date('Y-m-d H:i:s');
$to_time = date('Y-m-d H:i:s', strtotime($from_time . "+ 10 minute"));


$sql = "SELECT id,name,email,movie_id,sending_time,alert_hour FROM alertme WHERE alert = '1' AND sending_time BETWEEN '$from_time' AND '$to_time'";


$res = mysql_query($sql);
while ($row = mysql_fetch_array($res)) {

    $alertid = $row['id'];
    $movie_id = $row['movie_id'];
    $name = $row['name'];
    $email = $row['email'];
    $hour = $row['alert_hour'];
    $sending_time = $row['sending_time'];


    //select movie details
    $sql_alert = "SELECT * FROM b_movies WHERE MovieID = '$movie_id' AND Status = '1'";
    $res_movie_alert = mysql_query($sql_alert);
    if (mysql_num_rows($res_movie_alert) > 0) {

        $row_movie_alert = mysql_fetch_array($res_movie_alert);

        $ariving_time = DateFormat($row_movie_alert['AiringDateTime']);
        //sending email
        $headers = "From: HBO India <hbosa@hboasia.com>";
        $headers = $headers . "\r\n";
        $headers = $headers . 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $to = "$email";

        $subject = "Movie Alert!";

        $body = ' <html>
		 <body>
		 <table width="80%" border="0" align="center" cellpadding="2" cellspacing="2" >

         <tr valign="top" class="text">
             <td valign="middle">Hello ' . $name . '</td>         
          </tr>

                  
         <tr><td></td></tr>
         <tr valign="top" class="text">         
            <td>
               We would like to inform you that you will receive an alert ' . $hour . ' hours prior to the telecast of ' . $row_movie_alert['Title'] . '.
           </td>
         </tr>  
         
         <tr><td></td></tr>
         <tr valign="top" class="text">         
            <td>
               Don\'t forget to watch ' . $row_movie_alert['Title'] . ' at ' . $ariving_time . '.
           </td>
         </tr>
         
         <tr><td></td></tr>
         <tr><td></td></tr>
         <tr valign="top" class="text">         
            <td>
               Thanks and Regards,
           </td>
         </tr>
         <tr valign="top" class="text">         
            <td>
               HBO India
           </td>
         </tr>
         
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr valign="top" class="text">         
            <td>
              Disclaimer: This is not a SPAM or a promotional e-mail. It is only sent to people who submit a request to be alerted through e-mail before the telecast of their favourite movie.
           </td>
     </tr>
  </table>
</body>
  </html>
  ';

        mail($to, $subject, $body, $headers);

        //update alert message
        $sql_update = "UPDATE alertme SET alert = '0' WHERE id='$alertid'";
        $result = mysql_query($sql_update);
        $row_effected = (int) $result;
    }
}

function DateFormat($date) {

    $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date))));
    if (trim($date) != "" && trim($date) != "0000-00-00 00:00:00")
        return date("l, j M", strtotime($date)) . " at " . date("g:i A", strtotime($date));
    else
        return '';
}

?>
