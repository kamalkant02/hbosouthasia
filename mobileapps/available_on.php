<?php

include("../config.php");
include './app_functions.php';
$output = "";
$sql_crausel_mov = getRecords("SELECT ID,website_name,website_url,logo_path,location,description,channel FROM apps_availabe_on WHERE STATUS='1' ORDER BY ID DESC");
if (!empty($sql_crausel_mov)) {
    foreach ($sql_crausel_mov as $no => $row_data) {

        $hbo = "no";
        $hd = "no";
        if (explode(",", $row_data->channel)) {
            $channel = explode(",", $row_data->channel);
            foreach ($channel as $ch) {
                if ($ch == "1") {
                    $hbo = "yes";
                } else if ($ch == "2") {
                    $hd = "yes";
                }
            }
        } else {
            $channel = $row_data->channel;
            if ($channel == "1") {
                $hbo = "yes";
            } else if ($channel == "2") {
                $hd = "yes";
            }
        }



        $output .= '<subscriber>
				<id>' . $row_data->ID . ' </id>
				<website_name><![CDATA[ ' . $row_data->website_name . ']]></website_name>
				<website_url><![CDATA[' . $row_data->website_url . ']]></website_url>
                                <logo_path><![CDATA[' . $row_data->logo_path . ']]></logo_path>
                                <location><![CDATA[' . $row_data->location . ']]></location>
                                <hbo>' . $hbo . '</hbo>
                                <hd>' . $hd . '</hd>
				<description><![CDATA[' . htmlentities($row_data->description) . ']]></description>				
			</subscriber>';
    }
    header('Content-Type: application/xml; charset=utf-8');
    echo '<?xml version="1.0" encoding="utf-8"?>
	<available_on>
		' . $output . '
</available_on>';
} else {
    $err_msg = "Data not found.";
}