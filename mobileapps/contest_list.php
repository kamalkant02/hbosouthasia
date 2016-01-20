<?php

include("../config.php");
include './app_functions.php';
$output = "";

$sql_crausel_mov = getRecords("SELECT * FROM apps_contest WHERE cnt_status = '1' ORDER BY contest_id DESC");

foreach ($sql_crausel_mov as $no => $row_data) {
    $output .= '<contest>
				<contest_id> ' . $row_data->contest_id . ' </contest_id>
				<contest_name><![CDATA[ ' . nl2br(stripslashes($row_data->contest_name)) . ']]></contest_name>
				<thumb_image> ' . $row_data->thumb_image . ' </thumb_image>
				<description><![CDATA[ ' . htmlentities($row_data->description) . ']]></description>
				<contest_url> ' . $row_data->contest_url . ' </contest_url>
				<start_date> ' . DateFormatWhole($row_data->start_date) . ' </start_date>
				<end_date> ' . DateFormatWhole($row_data->end_date) . ' </end_date>
			</contest>';
}

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>
	<contest_list>
		' . $output . '
</contest_list>';
