<?php

include("../config.php");
//print_r($_REQUEST);

$numberofrow = 12;
$limitstart = 0;
$limitend = 12;


if ($_REQUEST['page_num']) {
    $currentpage = $_REQUEST['page_num'];
} else {
    $currentpage = 1;
}
if ($_REQUEST['page_num'] > 1) {
    $limitstart = $numberofrow * ($_REQUEST['page_num'] - 1);
    $limitend = $numberofrow;
}
$fromdate = date('Y-m-d');
$todate = date('Y-m-d', strtotime(date('Y-m-d') . "+ 2 day"));
$sql1 = "select * from b_movies where Title REGEXP '^[" . $_REQUEST['movie_letter'] . "]' and Originals=" . $_REQUEST['original'] . " and Soap=" . $_REQUEST['series'] . " and Status=1
AND DATE(AiringDateTime) BETWEEN '" . $fromdate . "' AND '" . $todate . "' ORDER BY Title";
$res1 = mysql_query($sql1);
$sql .= $sql1 . " limit " . $limitstart . "," . $limitend . "";
$res = mysql_query($sql);
if (mysql_num_rows($res) > 0) {
    if ($_REQUEST['movie_type'] == 'Album') {
        echo '<div class="highlight-pic">';
        while ($row = mysql_fetch_array($res)) {
            echo '<div class="highlight-pic8">
		  
		  <div class="pic2"><a href="movie-' . strtolower(preg_replace('![^a-z0-9]+!i', '-', $row['Title'])) . "-" . $row['MovieID'] . ".php" . '"><img src="' . $row['FilePath'] . '" /></a></div>
		  <p style="padding-right:5px;"><a href="movie-' . strtolower(preg_replace('![^a-z0-9]+!i', '-', $row['Title'])) . "-" . $row['MovieID'] . ".php" . '">' . $row['Title'] . '</a><br /><span>' . DateFormat($row['AiringDateTime']) . '</span></p>
		  </div>
		 ';
        }
    } elseif ($_REQUEST['movie_type'] == 'List') {
        echo '<div class="highlight-list"><ul>';
        while ($row = mysql_fetch_array($res)) {
            echo '<li><a href="movie-' . strtolower(preg_replace('![^a-z0-9]+!i', '-', $row['Title'])) . "-" . $row['MovieID'] . ".php" . '">' . $row['Title'] . '<span>' . DateFormat($row['AiringDateTime']) . '</span></a></li>';
        }
        echo '</ul></div>';
    } else {
        echo "";
    }
    echo '</div><div style="clear:both;"></div>';

    $num = ceil(mysql_num_rows($res1) / $numberofrow);
    if ($num > 1) {
        echo '<div class="ajax_pagination_div">';
        for ($i = 1; $i <= $num; $i++) {
            if ($currentpage == $i) {
                echo '<a class="ajax_pagination_curr" onclick="return false;" href="#">' . $i . '</a>';
            } else {
                echo '<a class="ajax_pagination" onclick="getMovieListingData(\'\',\'\',\'' . $i . '\');return false;" href="#">' . $i . '</a>';
            }
        }
        echo '</div>';
    }
}
?>