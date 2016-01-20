<?php
/*
 * 
  Romance, Family,Comedy,Action-Adventure, Horror-Thriller,Drama, Sci-Fi, Special
 * 
 */

include("config.php");

$movieTitle = "";
$metaTitle = "";
$metsDesc = "";

$genre = $_GET['q'];

//change genre valiable for fetching data
if ($genre == "romantic")
    $genre = "Romance";


//change title for showing in heading or title
if (strtolower($genre) == "action-thriller") {
    $movieTitle = 'Action Thriller Movies';
    $metaTitle = "Top English Action Thriller Movies | Hollywood Movie Channel";
    $metsDesc = "Watch your favorite Action Thriller Movies on English Movie Channel HBOSouthAsia. Check Now & Get the daily schedule of Hollywood Action Movies";
} else if (strtolower($genre) == "romance") {
    $movieTitle = 'Romantic Movies';
    $metaTitle = "Hollywood Romantic Movies | English Movie Channel";
    $metsDesc = "Watch and feel the charm of Romantic Movies only on HBOSouthAsia. Find out Hollywood Romantic Movies daily Schedule. Enjoy the Movies!";
} else if (strtolower($genre) == "sci-fi") {
    $movieTitle = 'Sci-Fi Movies';
    $metaTitle = "Best English Sci-Fi Movies | Hollywood Movies Channel";
    $metsDesc = "Watch your favorite English Sci-Fi Movies only on India's best Hollywood Movies Channel - HBOSouthAsia. Find out Daily Movies Schedule and Enjoy! ";
} else if (strtolower($genre) == "horror - sci fi") {
    $movieTitle = 'Horror - Sci-Fi Movies';
    $metaTitle = "Best English Horror - Sci-Fi Movies | Hollywood Movies Channel";
    $metsDesc = "Watch your favorite English Horror - Sci-Fi Movies only on India's best Hollywood Movies Channel - HBOSouthAsia. Find out Daily Movies Schedule and Enjoy! ";
} else if (strtolower($genre) == "action-adventure") {
    $movieTitle = 'Action-Adventure Movies';
    $metaTitle = "Top English Action Movies | Hollywood Movie Channel";
    $metsDesc = "Watch your favorite Action and Adventure Movies on English Movie Channel HBOSouthAsia. Check Now & Get the daily schedule of Hollywood Action Movies!";
} else if (strtolower($genre) == "horror-thriller") {
    $movieTitle = 'Horror-Thriller Movies';
    $metaTitle = "Hollywood horror and Thriller Movies | English Movie Channel";
    $metsDesc = "Solve the murder mysteries and enjoy Hollywood Horror-thriller Movies only on English Movies Channel in India. Check out on HBOSouthAsia!";
} else if (strtolower($genre) == "special") {
    $movieTitle = ucwords($genre) . ' Movies';
    $metaTitle = "Hollywood Special Movies | English Movies Channel";
    $metsDesc = "Watch Movies by Genre and Special Movies of your choice only on Hollywood Movies Channel - HBOSouthAsia. Get Movies Daily Schedule and Watch Now!";
} else if (strtolower($genre) == "drama") {
    $movieTitle = ucwords($genre) . ' Movies';
    $metaTitle = "Hollywood Drama Movies | English Movies on HBOSouthAsia";
    $metsDesc = "Enjoy watching Hollywood Drama Movies at your home only on number one English Movie Channel HBOSouthAsia. Check the Drama Movies Daily Schedule here!";
} else if (strtolower($genre) == "comedy") {
    $movieTitle = ucwords($genre) . ' Movies';
    $metaTitle = "Top English Comedy Movies | Hollywood Movie Channel";
    $metsDesc = "Relax and enjoy your time by watching Hollywood Comedy Movies on HBOSouthAsia. Check out schedule of your favorite Comedy Movies Here!";
} else if (strtolower($genre) == "family") {
    $movieTitle = ucwords($genre) . ' Movies';
    $metaTitle = "Best & Top Family Hollywood Movies | English Movies Channel";
    $metsDesc = "Spend fun time with your family by watching exclusive English Family Movies on the best Hollywood Movie Channel HBOSouthAsia. Watch Now!";
} else {
    $movieTitle = 'Categories';
    $metaTitle = "Hollywood Movies | English Movies Channel";
    $metsDesc = "Enjoy Hollywood Drama Movies at your home only on number one English Movie Channel HBOSouthAsia. Check out the schedule for what's playing this week on HBO. Your Home of Blockbuster Movies";
}

$pagetitle = $metaTitle;
$pagedescription = $metsDesc;
//$pagekeywordsack = '';
//echo $pagelink = $_GET['q'].'-movies.php';
?>
<?php include("mainheader.php"); ?>
<body>
    <div id="wrapper">
        <?php
        include_once("header.php");

        $start_with = 'a-z';
        $view = 'thumb';
        if (isset($_GET['view']) && !empty($_GET['view'])) {
            $view = $_GET['view'];
        }
        if ($_GET['start_with']) {
            $start_with = $_GET['start_with'];
        }
        ?>

        <div id="block_schedule_header" class="clearfix movie_title">
            <div class="container clearfix font_content font_block_header shows_font special_font title_block">
                <h2 class="page_title"><?php echo $movieTitle; ?></h2>
                <div class="glow glow_position"></div>
            </div>
        </div>

        <div class="block_container" style="min-height: 200px;">
            <div class="container clearfix section group">
                <div class="font_content font_block_header shows_font special_font channel_section_header bottom_spacing"></div>
                <div class="block_background_body_bottom">

                    <script language="javascript">
                        $(document).ready(function() {
                            function showlisting_search_parse() {
                                search_criteria_fields = ['genre', 'showing', 'showtime', 'format'];
                                search_criteria = {};

                                jQuery.each(search_criteria_fields,
                                        function() {
                                            search_key = this;
                                            search_value = [];

                                            $('input[name^=showlisting_' + this + ']').each(
                                                    function() {
                                                        if ($(this).prop('checked')) {
                                                            search_value.push($(this).val());
                                                        }
                                                    }
                                            );
                                            search_criteria[search_key] = search_value;
                                        }
                                );

                                return search_criteria;
                            }

                            function showlisting_search_criteria_to_string(search_criteria) {
                                search_string = "";
                                jQuery.each(search_criteria,
                                        function(key, value) {
                                            search_string += "&" + key + "=" + value;
                                        }
                                );

                                return search_string;
                            }

                            $('#showlisting_search_link').click(
                                    function() {
                                        search_criteria = showlisting_search_parse();

                                        window.location = '<?php echo $pagelink; ?>?' + showlisting_search_criteria_to_string(search_criteria) + "#search_result";
                                        return false;
                                    }
                            );
<?php if ($view == 'thumb') { ?>
                                start_with_ids = "showlisting_start_with_";
                                $('a[id^=' + start_with_ids + ']').click(
                                        function() {
                                            search_criteria_start_with = $(this).attr("id").substring(start_with_ids.length);
                                            search_criteria = showlisting_search_parse();

                                            window.location = '<?php echo $pagelink; ?>?view=thumb' + '&start_with=' + search_criteria_start_with + showlisting_search_criteria_to_string(search_criteria) + "#search_result";
                                            return false;
                                        }
                                );

                                view_type_ids = "showlisting_view_";
                                $('a[id^=' + view_type_ids + ']').click(
                                        function() {
                                            search_criteria_start_with = $(this).attr("id").substring(view_type_ids.length);
                                            search_criteria = showlisting_search_parse();

                                            window.location = '<?php echo $pagelink; ?>?view=' + search_criteria_start_with + '&start_with=a-z' + showlisting_search_criteria_to_string(search_criteria) + "#search_result";
                                            return false;
                                        }
                                );
<?php } else { ?>
                                start_with_ids = "showlisting_start_with_";
                                $('a[id^=' + start_with_ids + ']').click(
                                        function() {
                                            search_criteria_start_with = $(this).attr("id").substring(start_with_ids.length);
                                            search_criteria = showlisting_search_parse();

                                            window.location = '<?php echo $pagelink; ?>?view=list' + '&start_with=' + search_criteria_start_with + showlisting_search_criteria_to_string(search_criteria) + "#search_result";
                                            return false;
                                        }
                                );

                                view_type_ids = "showlisting_view_";
                                $('a[id^=' + view_type_ids + ']').click(
                                        function() {
                                            search_criteria_start_with = $(this).attr("id").substring(view_type_ids.length);
                                            search_criteria = showlisting_search_parse();

                                            window.location = '<?php echo $pagelink; ?>?view=' + search_criteria_start_with + '&start_with=a-z' + showlisting_search_criteria_to_string(search_criteria) + "#search_result";
                                            return false;
                                        }
                                );
<?php } ?>
                            $('#shows_listing_genre_clear_all').click(
                                    function() {
                                        $('input[name^=showlisting_genre]').each(
                                                function() {
                                                    if ($(this).prop('checked')) {
                                                        $(this).prop('checked', false);
                                                    }
                                                }
                                        );
                                        return false;
                                    }
                            );

                            $('#shows_listing_genre_check_all').click(
                                    function() {
                                        $('input[name^=showlisting_genre]').each(
                                                function() {
                                                    if (!$(this).prop('checked')) {
                                                        $(this).prop('checked', true);
                                                    }
                                                }
                                        );
                                        return false;
                                    }
                            );

                        });
                    </script>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="block_container block_bottom_space list_wrap">				


                                <?php
                                /*
                                  if($view == 'thumb')
                                  {
                                  ?>
                                  <div class="column shows_listing_view_type">
                                  <div class="shows_listing_alphabet"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_a-z" class="<?php if($_GET['start_with'] == '' || $_GET['start_with'] == 'a-z') echo 'show_thumb_title special_font'; ?>">All</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_a-c" class="<?php if($_GET['start_with'] == 'a-c') echo 'show_thumb_title special_font'; ?>">A - C</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_d-g" class="<?php if($_GET['start_with'] == 'd-g') echo 'show_thumb_title special_font'; ?>">D - G</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_h-m" class="<?php if($_GET['start_with'] == 'h-m') echo 'show_thumb_title special_font'; ?>">H - M</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_n-s" class="<?php if($_GET['start_with'] == 'n-s') echo 'show_thumb_title special_font'; ?>">N - S</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_t-z" class="<?php if($_GET['start_with'] == 't-z') echo 'show_thumb_title special_font'; ?>">T - Z</a> </div>
                                  <div class="shows_listing_view_type_txt"> <span>View&nbsp;&nbsp;</span> <a class="shows_listing_view_thumb selected" href="" id="showlisting_view_thumb"></a>&nbsp;&nbsp; <a class="shows_listing_view_list " href="" id="showlisting_view_list"></a>&nbsp;&nbsp; </div>
                                  </div>
                                  <?php
                                  }else
                                  {
                                  ?>
                                  <div class="column shows_listing_view_type">
                                  <div class="shows_listing_alphabet"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_a-z" class="<?php if($_GET['start_with'] == '' || $_GET['start_with'] == 'a-z') echo 'show_thumb_title special_font'; ?>">All</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_a-c" class="<?php if($_GET['start_with'] == 'a-c') echo 'show_thumb_title special_font'; ?>">A - C</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_d-g" class="<?php if($_GET['start_with'] == 'd-g') echo 'show_thumb_title special_font'; ?>">D - G</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_h-m" class="<?php if($_GET['start_with'] == 'h-m') echo 'show_thumb_title special_font'; ?>">H - M</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_n-s" class="<?php if($_GET['start_with'] == 'n-s') echo 'show_thumb_title special_font'; ?>">N - S</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_t-z" class="<?php if($_GET['start_with'] == 't-z') echo 'show_thumb_title special_font'; ?>">T - Z</a> </div>
                                  <div class="shows_listing_view_type_txt"> <span>View&nbsp;&nbsp;</span> <a class="shows_listing_view_thumb " href="" id="showlisting_view_thumb"></a>&nbsp;&nbsp; <a class="shows_listing_view_list selected" href="" id="showlisting_view_list"></a>&nbsp;&nbsp; </div>
                                  </div>
                                  <?php
                                  }
                                 */
                                if ($genre) {
                                    $sql1 = "select * from b_movies where DATE(AiringDateTime) >='" . date('Y-m-d') . "' AND Status=1 AND Genre = '$genre' GROUP BY Title ORDER BY AiringDateTime ASC";
                                    $res1 = mysql_query($sql1);
                                    if (mysql_num_rows($res1) > 0) {
                                        if ($view == 'list') {
                                            ?>

                                            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="shows_listing_tbl font_content">
                                                <tr>
                                                    <th class="font_small_header" width="50%">Title</th>
                                                    <th class="font_small_header" width="20%">Genre</th>
                                                    <th class="font_small_header" width="30%" style="padding-right: 20px; text-align: right;">Showtime</th>
                                                </tr>
                                                <?php
                                            } else {
                                                echo '<div class="row">';
                                            }

                                            $i = 1;
                                            while ($row1 = mysql_fetch_array($res1)) {
                                                $design = '';
                                                if ($i % 5 == 1)
                                                    $design = 'new_column';
                                                if ($view == 'thumb') {
                                                    ?>		
                                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                                        <div class="channel_block_third_thumb <?php echo $design; ?>">
                                                            <div class="channel_block_description short">
                                                                <div class="small_txt">
                                                                    <div class="show_thumb_title timeline_wrap_text shows_font"><a href="<?php echo getmoviename($row1['Title'], $row1['MovieID']) ?>" class="shows_font" title="<?php echo $row1['Title'] ?>"><?php echo $row1['Title'] ?></a></div>
                                                                    <span class="show_thumb_time"><?php echo DateFormatListing($row1['AiringDateTime']) ?></span> </div>
                                                            </div>
                                                            <a href="<?php echo getmoviename($row1['Title'], $row1['MovieID']) ?>" title="<?php echo $row1['Title'] ?>"><img src="http://www.hbosouthasia.com/<?php echo $row1['FilePath'] ?>" border="0" width="192" height="128" alt="<?php echo $row1['Title'] ?>" /></a> 
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                if ($view == 'list') {
                                                    if ($row1['Genre']) {
                                                        if (strtolower($row1['Genre']) == "romance")
                                                            $genre = 'Romantic';
                                                        else
                                                            $genre = $row1['Genre'];
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><a href="<?php echo getmoviename($row1['Title'], $row1['MovieID']) ?>" class="show_thumb_title_large" title="<?php echo $row1['Title'] ?>"><?php echo $row1['Title'] ?></a>
                                                            <div class="show_non_original" style="position: relative; display: inline-block; top: 2px; left: 5px;"></div></td>
                                                        <td><?php echo $genre; ?></td>
                                                        <td align="right" style="padding-right: 20px;"><?php echo DateFormatListing($row1['AiringDateTime']) ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                $i++;
                                            }
                                            if ($view == 'list') {
                                                ?>
                                            </table>
                                            <?php
                                        } else {
                                            echo '</div>';
                                        }
                                    } else {
                                        ?>
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="shows_listing_tbl font_content">
                                            <tr>
                                                <td class="font_small_header" width="100%">No Record Found!</td>
                                            </tr>
                                        </table>
                                        <?php
                                    }
                                    ?>


                                <?php } else { ?>
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%" class="shows_listing_tbl font_content">
                                        <tr><td class="font_small_header" width="100%"><h3><a href="/horror-thriller-movies.php" title="Horror-Thriller Movies">Horror-Thriller Movies</a></h3></td></tr>
                                        <tr><td class="font_small_header" width="100%"><h3><a href="/drama-movies.php" title="Drama Movies">Drama Movies</a></h3></td></tr>
                                        <tr><td class="font_small_header" width="100%"><h3><a href="/action-adventure-movies.php" title="Action-Adventure Movies">Action-Adventure Movies</a></h3></td></tr>
                                        <tr><td class="font_small_header" width="100%"><h3><a href="/action-thriller-movies.php" title="Action Thriller Movies">Action Thriller Movies</a></h3></td></tr>
                                        <tr><td class="font_small_header" width="100%"><h3><a href="/horror%20-%20sci%20fi-movies.php" title="Horror - Sci-Fi Movies">Horror - Sci-Fi Movies</a></h3></td></tr>
                                        <tr><td class="font_small_header" width="100%"><h3><a href="/sci-fi-movies.php" title="Sci-Fi Movies">Sci-Fi Movies</a></h3></td></tr>
                                        <tr><td class="font_small_header" width="100%"><h3><a href="/comedy-movies.php" title="Comedy Movies">Comedy Movies</a></h3></td></tr>
                                        <tr><td class="font_small_header" width="100%"><h3><a href="/special-movies.php" title="Special Movies">Special Movies</a></h3></td></tr>
                                        <tr><td class="font_small_header" width="100%"><h3><a href="/family-movies.php" title="Family Movies">Family Movies</a></h3></td></tr>
                                        <tr><td class="font_small_header" width="100%"><h3><a href="/romantic-movies.php" title="Romantic Movies">Romantic Movies</a></h3></td></tr>

                                    </table>
                                <?php } ?> </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("footerlink.php"); ?>  
            <?php include("copyright.php"); ?> 
        </div>
        <script type="text/javascript">
            var home_schedule_ajax = '';
            var now_showing_ajax = '';
        </script>
        <?php include("footeranalytics.php"); ?>
</body>
</html>
