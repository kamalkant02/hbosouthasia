<?php

/* Function to fetch sql result from database */

define("WEBSITE_PATH", "http://www.hbosouthasia.com/");
define("IMAGE_PATH", "http://www.hbosouthasia.com/");

function getResults($sql) {

    $result = array();
    $resource = mysql_query($sql);
    if (mysql_num_rows($resource) > 0) {
        while ($row = mysql_fetch_object($resource)) {
            $result[] = $row;
        }
    }
    mysql_free_result($resource);
    return $result;
}

/* Function for getting records for hbo defeind */

function getRecords($sql) {

    $result = array();
    $resource = mysql_query($sql);
    if (mysql_num_rows($resource) > 0) {
        while ($row = mysql_fetch_object($resource)) {

            $row->website_link = WEBSITE_PATH;
            $result[] = $row;
        }
    }
    mysql_free_result($resource);
    //mysql_close($dbhandle);    
    return $result;
}

/* Function for count movie likes */

function movieLike($movieID) {
    $sql_like_count = "select * from c_likes where MovieID=" . $movieID;
    $res_like_count = mysql_query($sql_like_count);
    if (mysql_num_rows($res_like_count) > 0) {
        $likes = mysql_num_rows($res_like_count);
        $likes = $likes + 5;
        echo $likes . '&nbsp;Like';
    } else {
        echo '5&nbsp;Like';
    }
}

function DateFormatWhole($date) {

    $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date)) . "+  " . $_SESSION['diffmin'] . " minutes"));
    if (trim($date) != "" && trim($date) != "0000-00-00 00:00:00")
        return date("D, j M g:i A", strtotime($date));
    else
        return '';
}
