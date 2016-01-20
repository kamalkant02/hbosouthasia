<?php

include("../config.php");
include './app_functions.php';

$sql_crausel_mov = getRecords("SELECT * FROM apps_cnst_update WHERE cnt_status = '1' ORDER BY id DESC");
foreach ($sql_crausel_mov as $no => $row_data) {
    $output .= '<updates>
				<id>' . $row_data->id . '</id>
				<title><![CDATA[' . nl2br(stripslashes($row_data->title)) . ']]></title>
				<thumb_image><![CDATA[' . $row_data->thumb_image . ']]></thumb_image>
				<description><![CDATA[' . htmlentities($row_data->description) . ' ]]></description>
                                <update_url><![CDATA[' . htmlentities($row_data->updates_url) . ' ]]></update_url>
				<date>' . DateFormatWhole($row_data->update_date) . '</date>
			</updates>';
}
header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>
	<update_list>
		' . $output . '
</update_list>';
