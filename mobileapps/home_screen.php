<?php

include '../config.php';
include './app_functions.php';

$output = "";
$fromdate = date('Y-m-d');
$todate = date('Y-m-d', strtotime(date('Y-m-d') . "+ 13 day"));

$fromTime = date('Y-m-d') . ' 19:00:00';
$toTime = date('Y-m-d H:i:s', strtotime("+8 hours", strtotime(date('Y-m-d') . ' 19:00:00')));


$next2days = date('Y-m-d', strtotime(date('Y-m-d') . "+ 2 day"));

//
//
//$parentTime = strtotime($parent);
//$later = strtotime("+6 hours", $parentTime);
//echo date('Y-m-d H:i:s', $later);


$sql_crausel_mov = getRecords("SELECT * FROM b_movies WHERE (DATE(AiringDateTime) BETWEEN '" . $fromdate . "' AND '" . $todate . "' OR promospot=1 ) AND `Status`=1 AND HomeCarausalPath !='' group by Title ORDER BY AiringDateTime ASC limit 0,8");
$sql_tonight_mov = getRecords("SELECT * FROM b_movies WHERE AiringDateTime BETWEEN '" . $fromTime . "' AND '" . $toTime . "'  AND Status=1 ORDER BY AiringDateTime LIMIT 6");
$sql_banner = getRecords("SELECT id,title,banner_img FROM b_banners WHERE istatus = '1' ORDER BY img_order ASC LIMIT 5");
//$sql_3days_highligths = getRecords("SELECT * FROM b_movies WHERE (DATE(AiringDateTime) BETWEEN '" . $fromdate . "' AND '" . $next2days . "' OR IsHighlight=1 ) AND `Status`=1 group by Title ORDER BY AiringDateTime ASC limit 0,3");
$sql_3days_highligths = getRecords("SELECT * FROM b_movies WHERE IsHighlight=1 AND `Status`=1 AND DATE(AiringDateTime) >= '" . $fromdate . "' group by Title ORDER BY AiringDateTime ASC limit 0,3");

//Loop for hbo highlights movies
foreach ($sql_banner as $no => $row_banner) {
    $output .= '<highlights_mov>
        <movie_id> ' . $row_banner->id . ' </movie_id>        
        <title><![CDATA[' . $row_banner->title . ']]></title>  
        <crausel_img><![CDATA[' . IMAGE_PATH . $row_banner->banner_img . ']]></crausel_img>                
        <type>banner</type>
    </highlights_mov>
';
}

//Loop for hbo highlights movies
foreach ($sql_crausel_mov as $no => $row_data) {


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

    $is_hd = 0;
    if (!empty($row_data->IsHd)) {
        $is_hd = 1;
    }



    $output .= '<highlights_mov>
        <movie_id> ' . $row_data->MovieID . ' </movie_id>        
        <title><![CDATA[' . $row_data->Title . ']]></title>  
        <tuning>' . DateFormatWhole($row_data->AiringDateTime) . '</tuning>
        <starring><![CDATA[ ' . $row_data->Starring . ']]></starring>
        <directedby><![CDATA[ ' . $row_data->DirectedBy . ']]></directedby>
        <genre><![CDATA[' . $row_data->Genre . ']]></genre>
        <duration> ' . formatduration($row_data->Duration) . ' </duration>
        <synopsis><![CDATA[ ' . stripslashes($row_data->Synopsis) . ']]></synopsis>        
        <poster_img><![CDATA[' . IMAGE_PATH . $row_data->FilePathBig . ']]></poster_img>	
        <crausel_img><![CDATA[' . IMAGE_PATH . $row_data->HomeCarausalPath . ']]></crausel_img>        
        <movie_url><![CDATA[' . $movieurl . ']]></movie_url>
        <thumb_path><![CDATA[' . IMAGE_PATH . $row_data->FilePath . ']]></thumb_path>
        <highlights>' . $row_data->IsHighlight . '</highlights>
        <originals>' . $row_data->Originals . '</originals>
        <type>movie</type>
        <is_hd>' . $is_hd . '</is_hd>
        <movie_video_url><![CDATA[ ' . $row_data->VideoPath . ']]></movie_video_url>
        <s_time>' . $start_time . '</s_time>
        <e_time>' . $end_time . '</e_time>
        <reminder>' . $reminder . '</reminder>
    </highlights_mov>
';
}

//Loop for hbo tonight movies
foreach ($sql_tonight_mov as $no => $tonight_data) {

    $is_hd = 0;
    if (!empty($tonight_data->IsHd)) {
        $is_hd = 1;
    }

    $arriving_time = $tonight_data->AiringDateTime;
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
    $movieurl = WEBSITE_PATH . getmoviename($tonight_data->Title, $tonight_data->MovieID);

    $output .= '<tonight_mov>
        <movie_id> ' . $tonight_data->MovieID . ' </movie_id>        
        <title><![CDATA[' . $tonight_data->Title . ']]></title>  
        <tuning>' . DateFormatWhole($tonight_data->AiringDateTime) . '</tuning>
        <starring><![CDATA[ ' . $tonight_data->Starring . ']]></starring>
        <directedby><![CDATA[ ' . $tonight_data->DirectedBy . ']]></directedby>
        <genre><![CDATA[' . $tonight_data->Genre . ']]></genre>
        <duration> ' . formatduration($tonight_data->Duration) . ' </duration>
        <synopsis><![CDATA[ ' . stripslashes($tonight_data->Synopsis) . ']]></synopsis>        
        <poster_img><![CDATA[' . IMAGE_PATH . $tonight_data->FilePathBig . ']]></poster_img>	
        <crausel_img><![CDATA[' . IMAGE_PATH . $tonight_data->HomeCarausalPath . ']]></crausel_img>        
        <movie_url><![CDATA[' . $movieurl . ']]></movie_url>
        <thumb_path><![CDATA[' . IMAGE_PATH . $tonight_data->FilePath . ']]></thumb_path>
        <highlights>' . $tonight_data->IsHighlight . '</highlights>
        <originals>' . $tonight_data->Originals . '</originals>
        <is_hd>' . $is_hd . '</is_hd>
        <movie_video_url><![CDATA[ ' . $tonight_data->VideoPath . ']]></movie_video_url>
        <s_time>' . $start_time . '</s_time>
        <e_time>' . $end_time . '</e_time>
        <reminder>' . $reminder . '</reminder>
    </tonight_mov>
';
}


//Loop for hbo tonight movies
foreach ($sql_3days_highligths as $no => $next3_data) {

    $is_hd = 0;
    if (!empty($next3_data->IsHd)) {
        $is_hd = 1;
    }

    $arriving_time = $next3_data->AiringDateTime;
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
    $movieurl = WEBSITE_PATH . getmoviename($next3_data->Title, $next3_data->MovieID);

    $output .= '<next_three_highlights>
        <movie_id> ' . $next3_data->MovieID . ' </movie_id>        
        <title><![CDATA[' . $next3_data->Title . ']]></title>  
        <tuning>' . DateFormatWhole($next3_data->AiringDateTime) . '</tuning>
        <starring><![CDATA[ ' . $next3_data->Starring . ']]></starring>
        <directedby><![CDATA[ ' . $next3_data->DirectedBy . ']]></directedby>
        <genre><![CDATA[' . $next3_data->Genre . ']]></genre>
        <duration> ' . formatduration($next3_data->Duration) . ' </duration>
        <synopsis><![CDATA[ ' . stripslashes($next3_data->Synopsis) . ']]></synopsis>        
        <poster_img><![CDATA[' . IMAGE_PATH . $next3_data->FilePathBig . ']]></poster_img>	
        <crausel_img><![CDATA[' . IMAGE_PATH . $next3_data->HomeCarausalPath . ']]></crausel_img>        
        <movie_url><![CDATA[' . $movieurl . ']]></movie_url>
        <thumb_path><![CDATA[' . IMAGE_PATH . $next3_data->FilePath . ']]></thumb_path>
        <highlights>' . $next3_data->IsHighlight . '</highlights>
        <originals>' . $next3_data->Originals . '</originals>
        <is_hd>' . $is_hd . '</is_hd>
        <movie_video_url><![CDATA[ ' . $next3_data->VideoPath . ']]></movie_video_url>
        <s_time>' . $start_time . '</s_time>
        <e_time>' . $end_time . '</e_time>
        <reminder>' . $reminder . '</reminder>
    </next_three_highlights>
';
}

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>
	<hbo_highlights>
		' . $output . '
	</hbo_highlights>';
