<?php

function DoSecure($a_value) {
    $output = trim($a_value);
    $output = str_replace("<!--", "", $output);
    //Replace JS Tag, HTML tags, etc...
    $search = array('@<script[^>]*?>.*?</script>@si',
        '@<[\/\!]*?[^<>]*?>@si',
        '@([\r\n])[\s]+@'
    );
    $replace = array('',
        '',
        '\1'
    );
    $output = preg_replace($search, $replace, $output);
    $output = htmlspecialchars($output);
    return $output;
}

function RecordSetToDropDown($rs, $selectedvalue, $indexCol, $valueCol, $showSelect = true) {
    global $db;
    if ($showSelect) {
        $list = '<option value="">Select--</option>';
    } else {
        $list = '';
    }
    if ($db->RowCount($rs) > 0) {
        while ($row = $db->FetchArray($rs)) {
            if ($row[$indexCol] == $selectedvalue) {
                $list.= '<option value="' . $row[$indexCol] . '" selected="selected">' . $row[$valueCol] . "</option>\n";
            } else {
                $list.= '<option value="' . $row[$indexCol] . '">' . $row[$valueCol] . "</option>\n";
            }
        }
    }
    return $list;
}

function NumericRangeToDropDown($start, $end, $step, $selectedvalue, $showSelect = true) {
    if ($showSelect) {
        $list = '<option value="">-- Select --</option>';
    } else {
        $list = '';
    }
    for ($i = $start; $i <= $end; $i = $i + $step) {
        if ($i == $selectedvalue) {
            $list.= '<option value="' . $i . '" selected="selected">' . $i . "</option>\n";
        } else {
            $list.= '<option value="' . $i . '">' . $i . "</option>\n";
        }
    }
    return $list;
}

function DateFormat($date) {

    $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date)) . $_SESSION[AddSub] . " " . $_SESSION[diffmin] . " minutes"));
    if (trim($date) != "" && trim($date) != "0000-00-00 00:00:00")
        return date("l, j M", strtotime($date)) . " at " . date("g:i A", strtotime($date));
    else
        return '';
}

function DateFormatInTitle($date) {

    $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date)) . $_SESSION[AddSub] . " " . $_SESSION[diffmin] . " minutes"));
    if (trim($date) != "" && trim($date) != "0000-00-00 00:00:00")
        return date("l jS F", strtotime($date));
    else
        return '';
}

function DateFormatAMPM($date) {

    $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date)) . $_SESSION[AddSub] . " " . $_SESSION[diffmin] . " minutes"));
    if (trim($date) != "" && trim($date) != "0000-00-00 00:00:00")
        return date("g:i A", strtotime($date));
    else
        return '';
}

function DateFormatDB($date) {

    $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date)) . $_SESSION[AddSub] . " " . $_SESSION[diffmin] . " minutes"));
    if (trim($date) != "" && trim($date) != "0000-00-00 00:00:00")
        return date("Y-m-d H:i:s", strtotime($date));
    else
        return '';
}

function formatduration($seconds) {
    if (trim($seconds) != "")
        return floor($seconds / 3600) . ' hr ' . floor(($seconds % 3600) / 60) . ' min';
    else
        return '';
}

function getmoviename($title, $id) {
    return "movie-" . strtolower(preg_replace('![^a-z0-9]+!i', '-', $title)) . "-" . $id . ".php";
}

function DateFormatListing($date) {

    $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date)) . $_SESSION[AddSub] . " " . $_SESSION[diffmin] . " minutes"));
    if (trim($date) != "" && trim($date) != "0000-00-00 00:00:00")
        return date("D, j M", strtotime($date)) . " " . date("g:i A", strtotime($date));
    else
        return '';
}

?>