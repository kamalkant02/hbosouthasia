<?php
include("config.php");

$colorbox = "";

if (!ereg('^[0-9]+$', $_GET['id']) || $_GET['id'] < 1) {
    //echo "This is not a positive whole number";
    header("location:index.php");
} else {
    $movieid = $_GET['id'];
}

function DateFormatMP($date) {

    if (trim($date) != "" && trim($date) != "0000-00-00 00:00:00")
        return date("l d M", strtotime($date)) . " at " . date("g.i A", strtotime($date));
    else
        return '';
}

$sql_back = "select * from b_movies where MovieID=" . $movieid . " AND Status=1";
$res_back = mysql_query($sql_back);
$back = '';
$pagetitle = 'Welcome to HBO South Asia';
$timeforkeywords = '';
$pagedescription = 'Watch movies on HBO.';
$pagekeywords = '';
$genre = '';
$starring = '';
$movieurl = '';
if (mysql_num_rows($res_back) > 0) {
    $row_back = mysql_fetch_array($res_back);
    if ($row_back['Background'] != '') {
        $back = 'style="background: url(' . $row_back['Background'] . ') fixed center top #000000;"';
    }
    if ($row_back['AiringDateTime'] != '0000-00-00 00:00:00') {
        $pagetitle = 'Watch ' . $row_back['Title'] . ' on ' . DateFormatMP($row_back['AiringDateTime']) . ' IST - HBO South Asia';
        $timeforkeywords = 'Watch ' . $row_back['Title'] . ' on ' . DateFormatMP($row_back['AiringDateTime']) . ' IST';
    } else {
        $pagetitle = 'Watch ' . $row_back['Title'] . ' - HBO South Asia';
        $timeforkeywords = 'Watch ' . $row_back['Title'];
    }
    if ($row_back['Synopsis'] != '') {
        $pagedescription = $row_back['Synopsis'];
    }

    if ($row_back['Genre'] != '') {
        $genre = strtolower(str_replace("-", " ", $row_back['Genre'])) . ' movies, ';
    }
    if ($row_back['Starring'] != '') {
        $starring = strtolower(str_replace("&quot;", "'", $row_back['Starring'])) . ', ';
    }

    $pagekeywordsack = $genre . $starring . 'hollywood movies, english movies';

    $movieurl = getmoviename($row_back['Title'], $row_back['MovieID']);
} else {
    header("location:index.php");
}
$videopath = "";
?>
<?php include("mainheader.php"); ?>
<!-- light box -->
<link type="text/css" rel="stylesheet" href="colorbox/colorbox.css" />  
<script src="colorbox/jquery-1.js" type="text/javascript"></script>
<script type="text/javascript" src="colorbox/jquery.colorbox.js"></script>  
<script type="text/javascript">

    $(document).ready(function () {

        $("#click").click(function () {
            $('#click').css({"background-color": "#f00", "color": "#fff", "cursor": "inherit"}).text("Open this window again and this message will still be here.");
            return false;
        });


        var width = $(window).width();
        if (width < 767) {

            $(".group3").colorbox({rel: 'group3', transition: "none", width: "75%", height: "75%"});
        }
        else
        {
            $(".example6").colorbox({iframe: true, innerWidth: 430, innerHeight: 498});
        }


//        var cboxOptions = {
//            width: '95%',
//            height: '95%',
//            maxWidth: '960px',
//            maxHeight: '960px'
//        }
//
//        $('.cbox-link').colorbox(cboxOptions);
//        $(window).resize(function() {
//            $.colorbox.resize({
//                width: window.innerWidth > parseInt(cboxOptions.maxWidth) ? cboxOptions.maxWidth : cboxOptions.width,
//                height: window.innerHeight > parseInt(cboxOptions.maxHeight) ? cboxOptions.maxHeight : cboxOptions.height
//            });
//        });


    });
</script> 
</head>
<body>
    <div id="wrapper">
        <?php include_once("header.php"); ?>
        <script>
            var loading_spinner_rectangle = '<div align="left"><img src="images/ajax-loader.gif"/></div>';

            $(document).ready(function () {
                //load data
                like('<?php echo $movieid; ?>', 1);
            });
            function like(movieid, insert) {

                var url = "ajax/likemovie.php";


                $("#likediv").html(loading_spinner_rectangle);

                $.post(
                        url,
                        {
                            movie_id: movieid,
                            insert: insert
                        },
                function (data) {
                    $("#likediv").html(data);
                }
                );
            }
        </script>
        <div id="block_schedule_header" class="clearfix movie_title">
            <div class="container clearfix font_content font_block_header shows_font special_font title_block">
                <h2 class="movie_title"><?php echo $row_back['Title']; ?></h2>
                <div class="glow glow_position"></div>
            </div>
        </div>
        <div class="container clearfix font_content channel_section_header schedule_section_header">
            <div class="block_container block_bottom_space block_top_space highlight_block_line movie_wrap">
                <div class="col span_6_of_15 font_content" style="position: relative;"> 
                    <img src="http://www.hbosouthasia.com/<?php echo $row_back['FilePathBig']; ?>" border="0" width="95%" alt = "<?php echo $row_back['Title'] . '-' . $row_back['Genre'] . ' Movie' ?>" />
                </div>
                <div class="col span_9_of_15 font_content">
                    <?php if ($row_back['Starring']) { ?>
                        <div class="show_divider special_font"><h3 class="font_small" style="display:inline">Starring:</h3> <?php echo $row_back['Starring']; ?></div>
                    <?php } if ($row_back['DirectedBy']) { ?>
                        <div class="show_divider special_font"><h3 class="font_small" style="display:inline">Directed by:</h3> <?php echo $row_back['DirectedBy']; ?></div>
                        <?php
                    } if ($row_back['Genre']) {
                        if (strtolower($row_back['Genre']) == "romance")
                            $genre = 'romantic';
                        else
                            $genre = strtolower($row_back['Genre']);
                        ?>
                        <div class="show_divider special_font"><h3 class="font_small" style="display:inline">Genre:</h3> <?php echo '<a href="' . $genre . '-movies.php" style="text-decoration:underline; font-size:16px; color:#ffffff;">' . $row_back['Genre'] . '</a>'; ?></div>
                    <?php } /* if ($row_back['Duration']) { ?>
                      <div class="show_divider special_font"><span class="font_small">Duration:</span> <?php echo formatduration($row_back['Duration']); ?></div>
                      <?php } */ if ($row_back['Synopsis']) { ?>                        
                        <br />
                        <div class="special_font"><?php echo $row_back['Synopsis']; ?></div>
                        <br />
                        <div class="special_font">
                            <a class='example6 group3' id="clbox"  href="remindme.php?id=<?php echo $row_back['MovieID']; ?>">
                                <img src="images/reminder.png" border="0" alt="Reminder" width="20"/>
                                Remind Me
                            </a> 
                        </div>
                    <?php } ?>
                    <div class="about_show_timer_box">
                        <div class="font_header show_divider"> Showtime </div>
                        <div class="show_divider font_content about_show_timer_box_timing"> <?php echo DateFormat($row_back['AiringDateTime']); ?> </div>
                    </div>
                    <div class="social_icon">
                        <div class="facebook_button">
                            <iframe src="https://www.facebook.com/plugins/like.php?href=http://www.hbosouthasia.com/<?php echo getmoviename($row_back['Title'], $row_back['MovieID']) ?>&amp;layout=button_count&amp;show_faces=false&amp;width=135&amp;action=like&amp;colorscheme=light&amp;height=25" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:135px; height:25px;" allowtransparency="true"></iframe>
                        </div>
                        <!--plugin wherever you want the facebook like button to appear  -->
                        <div class="gplus_button">
                            <!-- Place this tag in your head or just before your close body tag. -->
                            <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
                            <!-- Place this tag where you want the +1 button to render. -->
                            <g:plusone size="medium" href="https://plus.google.com/107257115661832425654"></g:plusone>
                        </div>                        <!-- Reddit Social Plugins -->
                        <div  class="tweet_button">
                            <div>
                                <!-- Place this tag where you want the su badge to render -->
                                <su:badge layout="1"></su:badge>
                                <!-- Place this snippet wherever appropriate -->
                                <script type="text/javascript">
            (function () {
                var li = document.createElement('script');
                li.type = 'text/javascript';
                li.async = true;
                li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(li, s);
            })();
                                </script>
                            </div>
                            <div class="reddit_button">
                                <a href="http://www.reddit.com/submit" onClick="window.location = 'http://www.reddit.com/submit?url=' + encodeURIComponent(window.location);
                                        return false"> 
                                    <img src="http://www.reddit.com/static/spreddit7.gif" alt="submit to reddit" border="0" /> 
                                </a>
                            </div>
                        </div>
                        <div class="hbolike_button">
                            <div id="like"><img src="images/like.png" onClick="like('<?php echo $row_back['MovieID']; ?>', 1)"/></div>
                            <div id="like-text"><span id="likediv">&nbsp;</span> Likes</div>
                        </div>					
                    </div>
                </div>
            </div>
        </div>
        <div class="block_container block_background_recommended block_bottom_space highlight_block_line weekly_update_block">
            <div class="container clearfix font_content">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="font_block_header channel_section_header bottom_spacing shows_font special_font title_block">
                            <?php
                            $fromdate = date('Y-m-d');
                            $todate = date('Y-m-d', strtotime(date('Y-m-d') . "+ 2 day"));

                            $sql = "select * from b_movies where IsHighlight=1 
AND DATE(AiringDateTime) BETWEEN '" . $fromdate . "' AND '" . $todate . "' AND Status=1 ORDER BY AiringDateTime ASC";
                            $res = mysql_query($sql);
                            if (mysql_num_rows($res) > 0) {
                                ?>
                                <div id="special_title_thisweek" class="glow_position in en"></div>Next 3 Days Highlights</div>
                            <?php
                            $i = 1;
                            while ($row = mysql_fetch_array($res)) {
                                $divclass = 'weekly_thumb_block';
                                if ($i > 1 && ($i % 2) == 0) {
                                    $divclass = '';
                                }
                                if ($i == 1) {
                                    ?>
                                    <div class="channel_block_main_thumb">
                                        <div class="channel_block_description longer">
                                            <div class="big_txt">
                                                <div class="show_thumb_title_large timeline_wrap_text"><a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>" class="shows_font"><?php echo $row['Title']; ?></a></div>
                                                <p class="show_thumb_time_large"><?php echo DateFormat($row['AiringDateTime']); ?></p>
                                            </div>
                                        </div>
                                        <a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>"><img width="460" height="307" border="0" alt="<?php echo $row['Title']; ?>" src="http://www.hbosouthasia.com/<?php echo $row['FilePathBig']; ?>"></a> </div>
                                <?php
                                    } else {
                                        if ($i == 2) {
                                            echo '<div class="row">';
                                        }
                                        ?>
                                <div class="col-sm-6">
                                    <div class="weekly_block_small_thumb <?php echo $divclass; ?>">
                                        <div class="channel_block_description middle">
                                            <div class="small_txt">
                                                <div class="show_thumb_title_large timeline_wrap_text"><a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>" class="shows_font"><?php echo $row['Title']; ?></a></div>
                                                <span class="show_thumb_time"><?php echo DateFormat($row['AiringDateTime']); ?></div>
                                        </div>
                                        <a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>"><img width="225" height="150" border="0" alt="<?php echo $row['Title']; ?>" src="http://www.hbosouthasia.com/<?php echo $row['FilePath']; ?>"></a> 
                                    </div></div>
                                    <?php
                                        if ($i == 3) {
                                            echo '</div>';
                                        }
                                    }
                                    $i++;
                                }
                                ?>
                        </div>
                    <?php } ?>
                    <!--div class="col span_7_of_15 font_content week_block_margin"-->
                    <div class="col-sm-6">
                        <?php
                        $fromdate = date('Y-m-d');
                        $todate = date('Y-m-d', strtotime(date('Y-m-d') . "+ 10 day"));

                        $sql_most_like = "SELECT COUNT(*) AS totalcount,c.MovieID,`SeriesID`,`Title`,`FilePathBig`,`Genre`,`AiringDateTime`,FilePath FROM c_likes c JOIN `b_movies` b ON(b.`MovieID`=c.`MovieID`) WHERE c.MovieID IN (SELECT MovieID FROM b_movies WHERE DATE(AiringDateTime) BETWEEN '" . $fromdate . "' AND '" . $todate . "' AND IsHighlight!=1 AND STATUS=1) AND c.MovieID != $movieid GROUP BY c.MovieID ORDER BY 1 DESC LIMIT 3";
                        $res_most_like = mysql_query($sql_most_like);
                        if (mysql_num_rows($res_most_like) > 0) {
                            ?>
                            <div class="font_block_header channel_section_header bottom_spacing shows_font special_font title_block"> You May Also Like<div class="heart">
                                    <img src="images/heart.png"></div>
                                <div id="special_title_hbooriginal" class="in en">                            
                                </div>
                            </div>
                            <?php
                            $i = 1;
                            while ($row = mysql_fetch_array($res_most_like)) {
                                $divclass = 'weekly_thumb_block';
                                if ($i > 1 && ($i % 2) == 0) {
                                    $divclass = '';
                                }
                                if ($i == 1) {
                                    ?>
                                    <div class="channel_block_main_thumb">
                                        <div class="channel_block_description longer">
                                            <div class="big_txt">
                                                <div class="show_thumb_title_large timeline_wrap_text"><a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>" class="shows_font"><?php echo $row['Title']; ?></a></div>
                                                <p class="show_thumb_time_large"><?php echo DateFormat($row['AiringDateTime']); ?></p>
                                            </div>
                                        </div>
                                        <a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>"><img width="460" height="307" border="0" alt="<?php echo $row['Title']; ?>" src="http://www.hbosouthasia.com/<?php echo $row['FilePathBig']; ?>"></a> 
                                    </div>
                                <?php
                                    } else {
                                        if ($i == 2) {
                                            echo '<div class="row">';
                                        }
                                        ?>
                                    <div class="col-sm-6">
                                        <div class="weekly_block_small_thumb <?php echo $divclass; ?>">
                                            <div class="channel_block_description middle">
                                                <div class="small_txt">
                                                    <div class="show_thumb_title_large timeline_wrap_text"><a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>" class="shows_font"><?php echo $row['Title']; ?></a></div>
                                                    <span class="show_thumb_time"><?php echo DateFormat($row['AiringDateTime']); ?></div>
                                            </div>
                                            <a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>"><img width="225" height="150" border="0" alt="<?php echo $row['Title']; ?>" src="http://www.hbosouthasia.com/<?php echo $row['FilePath']; ?>"></a> 
                                        </div>
                                    </div>
                                    <?php
                                        if ($i == 3) {
                                            echo '</div>';
                                        }
                                    }
                                    $i++;
                                }
                                ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-sm-12 fb-did-hbo">
                        <div class="text"><h2 class="cl-text">Did You Know</h2></div>
                        <span>
                            <?php
                            $sql_didyouknow = "SELECT * FROM `d_didyouknow` WHERE DATE(ShowDate)<='" . date('Y-m-d') . "' AND `Status`=1 order by ShowDate DESC LIMIT 0,1";
                            $res_didyouknow = mysql_query($sql_didyouknow);
                            if (mysql_num_rows($res_didyouknow) > 0) {
                                $row_didyouknow = mysql_fetch_array($res_didyouknow);
                                echo $row_didyouknow['StoryLine'];
                            }
                            ?>
                            <div class="share">
                            <a href="https://twitter.com/intent/tweet?text=<?php echo $row_didyouknow['StoryLine'] ?>&url=http://www.hbosouthasia.com" target="_blank" alt="Share on Twitter" title="Share on Twitter">
                                <img src="images/tweet.png">
                            </a> 
                            </div>
                            <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
                        </span>
                    </div></div>
            </div>
        </div>
    </div>


    <div class="block_background_body_bottom"></div>
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
