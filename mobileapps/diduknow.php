<?php

include("../config.php");
include './app_functions.php';
$output = "";
$today = date('Y-m-d');

//echo "SELECT * from d_didyouknow WHERE DATE(ShowDate) <= '$today' ORDER BY ShowDate DESC LIMIT 15";
$sql_crausel_mov = getRecords("SELECT * FROM d_didyouknow ORDER BY RAND() LIMIT 3");

foreach ($sql_crausel_mov as $no => $row_data) {
    $output .= "<diduknow>
		<id>" . $row_data->DidYouKnowID . " </id>
		<description><![CDATA[" . $row_data->StoryLine . "]]></description>                
	</diduknow>";
}

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>
	<didyouknow_list>
		' . $output . '
</didyouknow_list>';
