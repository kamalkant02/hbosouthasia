<?php

//http://localhost:88/hbosouthasia/mobileapps/movies_schedule.php
include("../config.php");
include './app_functions.php';

$day = $_REQUEST['day'];
$displayDate = "";
$output = "";
$sql_crausel_mov = "";

if ($day == 1) {
    $todate = date('Y-m-d'); //display current day schedule
    $toTime = date('H:i:s');
    $displayDate = date('M d, Y');

    $sql_crausel_mov = getRecords("SELECT * FROM b_movies WHERE DATE(AiringDateTime) = '" . $todate . "' AND TIME(AiringDateTime) >= '" . $toTime . "' AND Status=1 ORDER BY AiringDateTime");
} else {
    $day = $day - 1;
    $todate = date('Y-m-d', strtotime(date('Y-m-d') . "+ " . $day . " day"));
    $displayDate = date('M d, Y', strtotime(date('Y-m-d') . "+ " . $day . " day"));

    $sql_crausel_mov = getRecords("SELECT * FROM b_movies WHERE DATE(AiringDateTime) = '" . $todate . "' AND Status=1 ORDER BY AiringDateTime");
}



foreach ($sql_crausel_mov as $no => $row_data) {

    $is_hd = 0;
    if (!empty($row_data->IsHd)) {
        $is_hd = 1;
    }

    $arriving_time = $row_data->AiringDateTime;
    $remtime = date('Y-m-d H:i:s', strtotime($arriving_time . "- 1 hour"));
    $curtime = date('Y-m-d H:i:s');
    $start_time = date('d-m-Y H:i:s', strtotime($arriving_time . "- 1 hour"));
    $end_time = date('d-m-Y H:i:s', strtotime($arriving_time . "-30 min"));
    $reminder = "";
    if ($curtime >= $remtime) {
        $reminder = "no";
    } else {
        $reminder = "yes";
    }

    $movieurl = WEBSITE_PATH . getmoviename($row_data->Title, $row_data->MovieID);

    $output .= '<movie>
        <movie_id> ' . $row_data->MovieID . ' </movie_id>        
        <title><![CDATA[' . $row_data->Title . ']]></title>  
        <tuning>' . DateFormatWhole($row_data->AiringDateTime) . '</tuning>
        <starring><![CDATA[ ' . $row_data->Starring . ']]></starring>
        <directedby><![CDATA[ ' . $row_data->DirectedBy . ']]></directedby>
        <genre><![CDATA[' . $row_data->Genre . ']]></genre>
        <duration> ' . formatduration($row_data->Duration) . ' </duration>
        <synopsis><![CDATA[ ' . stripslashes($row_data->Synopsis) . ']]></synopsis>        
        <poster_img><![CDATA[' . IMAGE_PATH . $row_data->FilePathBig . ']]></poster_img>	       
        <movie_url><![CDATA[' . $movieurl . ']]></movie_url>
        <thumb_path><![CDATA[' . IMAGE_PATH . $row_data->FilePath . ']]></thumb_path>
        <highlights>' . $row_data->IsHighlight . '</highlights>
        <originals>' . $row_data->Originals . '</originals>
        <is_hd>' . $is_hd . '</is_hd>
        <movie_video_url><![CDATA[ ' . $row_data->VideoPath . ']]></movie_video_url>
        <s_time>' . $start_time . '</s_time>
        <e_time>' . $end_time . '</e_time>
        <reminder>' . $reminder . '</reminder>
    </movie>';
}
//echo $output;
$output .= '<date>' . $displayDate . '</date>';
header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?><hbo_highlights>' . $output . '</hbo_highlights>';
