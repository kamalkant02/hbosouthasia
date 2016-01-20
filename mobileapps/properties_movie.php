<?php

include("../config.php");
include './app_functions.php';
$stant_name = $_REQUEST['key'];
$stant_value = $_REQUEST['val'];

$output = "";
$sql_query = "SELECT * FROM b_movies WHERE Status=1 AND " . $stant_name . " = '" . $stant_value . "'  ORDER BY AiringDateTime ASC LIMIT 25";
$sql_crausel_mov = getRecords($sql_query);

//print_r($sql_crausel_mov);
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
        <crausel_img><![CDATA[' . IMAGE_PATH . $row_data->HomeCarausalPath . ']]></crausel_img>        
        <movie_url><![CDATA[' . $movieurl . ']]></movie_url>
        <thumb_path><![CDATA[' . IMAGE_PATH . $row_data->FilePath . ']]></thumb_path>
        <highlights>' . $row_data->IsHighlight . '</highlights>
        <originals>' . $row_data->Originals . '</originals>
        <is_hd>' . $is_hd . '</is_hd>
        <movie_video_url><![CDATA[ ' . $row_data->VideoPath . ']]></movie_video_url>
        <s_time>' . $start_time . '</s_time>
        <e_time>' . $end_time . '</e_time>
        <reminder>' . $reminder . '</reminder>
    </movie>
';
}

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>
	<properties_movie>
		' . $output . '
	</properties_movie>';


