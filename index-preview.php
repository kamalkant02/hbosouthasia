<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en" class="wf-proximanova-n4-inactive wf-proximanova-n6-inactive wf-proximanovacondensed-i6-inactive wf-proximanovacondensed-n3-inactive wf-proximanovacondensed-n4-inactive wf-inactive">
<head>
<link href="//use.typekit.net" rel="dns-prefetch">
<link href="//ajax.googleapis.com" rel="dns-prefetch">
<link href="//s3-ap-southeast-1.amazonaws.com" rel="dns-prefetch">
<link href="//releases.flowplayer.org" rel="dns-prefetch">
<meta charset="utf-8" content="text/html" http-equiv="Content-Type">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title><?php echo $pagetitle; ?></title>
<meta name="description" content="<?php echo $pagedescription; ?>" />
<?php if(!empty($pagekeywordsack)){ ?>
<meta name="keywords" content="<?php echo $pagekeywordsack; ?>" />
<?php } ?>
<meta content="HBO Asia" name="author">
<meta content="NOINDEX, NOFOLLOW" name="robots">
<meta content="HBO Asia" property="og:title">
<meta content="assets/img/fb-hbo-480x320.jpg" property="og:image">
<meta content="HBO Asia" property="og:site_name">
<meta content="" property="og:description">
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/themes/smoothness/jquery-ui.css" type="text/css">
<link href="//releases.flowplayer.org/5.4.3/skin/minimalist.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/normalize.css">
<link rel="stylesheet" href="assets/css/styles.css">
<link rel="stylesheet" href="assets/css/styles-hbo.css">
<script src="//use.typekit.net/pop6qev.js" type="text/javascript"></script>
<script src="assets/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="assets/js/jquery-migrate-1.1.1.min.js" type="text/javascript"></script>
<style type="text/css">
.tk-proxima-nova-condensed{font-family:"proxima-nova-condensed",sans-serif;}.tk-proxima-nova{font-family:"proxima-nova",sans-serif;}
</style>
<link rel="stylesheet" href="http://use.typekit.net/c/e04417/proxima-nova:n4:n6,proxima-nova-condensed:i6:n3:n4.W0V:N:2,W0X:N:2,SCd:N:2,SCX:N:2,SCZ:N:2/d?3bb2a6e53c9684ffdc9a9bf21c5b2a620701c6661cd66453615bc1e876c78b743eeb6de419ce549fa7bb3512c8ffce4c4b18ea6c1a89b4ce88d338329554af79dab4fa779636100676db1d11113e20ab8884db654ff9a6aff8691c71d917dac78a6287d39928352200a8d3ceb411b69c2a8297b1362b8f31527416ba9bf2fd2ee7d823253df6e1b5386c56bff13d771df58e">
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="//releases.flowplayer.org/5.4.3/commercial/flowplayer.min.js" type="text/javascript"></script>
<script src="assets/js/video-player.js" type="text/javascript"></script>
<script src="assets/js/handlebars.js" type="text/javascript"></script>
<script src="assets/js/commons.js" type="text/javascript"></script>
</head>
<body>
    <div id="wrapper">
        <?php include_once("header.php"); ?>
        <script>


            $(document).ready(function() {
                //load data
                getPlanerlist('1');
            });
            /**
             * Get Movie list data
             *
             */

            function getPlanerlist(TheDay) {
                var url = "ajax/getplannerlist.php";
                var loading_spinner_rectangle = '<div align="left" style="margin-left:380px"><img src="images/ajax-loader.gif"/></div>';

                if (TheDay == 1)
                {
                    var TheDate = document.getElementById('txtdate1').value;
                    var NextDay = 2;
                    var PreDay = 3;
                }
                if (TheDay == 2)
                {
                    var TheDate = document.getElementById('txtdate2').value;
                    var NextDay = 3;
                    var PreDay = 1;
                }
                if (TheDay == 3)
                {
                    var TheDate = document.getElementById('txtdate3').value;
                    var NextDay = 1;
                    var PreDay = 2;
                }
                var month = new Array();
                month[0] = "Jan";
                month[1] = "Feb";
                month[2] = "Mar";
                month[3] = "Apr";
                month[4] = "May";
                month[5] = "Jun";
                month[6] = "Jul";
                month[7] = "Aug";
                month[8] = "Sep";
                month[9] = "Oct";
                month[10] = "Nov";
                month[11] = "Dec";
                var d = new Date(TheDate);

                var datetext = d.getDate();
                var monthtext = month[d.getMonth()];



                $("#hboplanner").html(loading_spinner_rectangle);
                $("#datediv").html(datetext);
                $("#monthdiv").html(monthtext);


                $.post(
                        url,
                        {
                            movie_date: TheDate
                        },
                function(data) {
                    document.getElementById('txtpredate').value = PreDay;
                    document.getElementById('txtnextdate').value = NextDay;
                    $("#hboplanner").html(data);
                }
                );
            }
        </script>
        <div id="marquee_video_player_container">
            <center>
                <div style="width: 810px; height: 360px;" class="is-splash" id="marquee_video_player_playlist"></div>
            </center>
            <div class="close_popup_video">Close</div>
        </div>
        <div id="marquee_container">
            <div id="marquee">
                <!--<div style="position: relative; display: none;" class="marquee_item clearfix marquee_item_version_flash">
                    <div class="marquee_video_play_flash">
                    </div>
                    <div style="width: 100%; overflow: hidden;">
                        <div style="position: relative; width: 1280px; display: block; left: 50%; margin-left: -640px;">
                            <center>
                                <object width="1280" height="380" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
                                    <param value="banners/watch-n-win-banner-on-hbo.swf" name="movie">
                                    <param value="high" name="quality">
                                    <param value="transparent" name="wmode">
                                    <embed width="1280" height="380" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high"  src="banners/watch-n-win-banner-on-hbo.swf">
                                </object>
                            </center>
                        </div>
                    </div>
                    <div class="marquee_fade clearfix" style="position: relative;"></div>
                    <div style="display: none;" class="marquee_timer">24000</div>
                </div>-->
                <!-- --------------For Banner Image -------------->
                <?php
                $banner = '';
                $bannerthumb = '';
                $bannertitle = '';

                $banner = 'banners/blockbuster-of-the-month-lincoln.png';
                $bannerthumb = 'banners/banner-thumb/blockbuster-of-the-month-lincoln-thumb.png';
                $bannertitle = 'Blockbuster of the Month - Lincoln';

                /* if (date('Y-m-d H:i:s') < '2013-11-04 17:00:00') {
                  $banner = 'banners/diwali-banner.png';
                  $bannerthumb = 'banners/banner-thumb/diwali-banner-thumb.png';
                  $bannertitle = 'Enjoy the blast of entertainment on HBO this Diwali';
                  } else {
                  $banner = 'banners/Rise-of-the-Gurdians.jpg';
                  $bannerthumb = 'banners/banner-thumb/rise-of-the-guardians-thumb.png';
                  $bannertitle = 'Rise of the Guardians';
                  } */
                if ($banner != '' && $bannerthumb != '' && $bannertitle != '') {
                    ?>
                    <div style="position: relative; display: none;" class="marquee_item clearfix marquee_item_version_flash">
                        <div class="marquee_video_play_flash" >
                        </div>
                        <div style="width: 100%; overflow: hidden;">
                            <div style="position: relative; width: 1280px; display: block; left: 50%; margin-left: -640px;">
                                <center>
                                    <img src="<?php echo $banner; ?>" alt="<?php echo $bannertitle; ?>" border="0" >
                                </center>
                            </div>
                        </div>
                        <div class="marquee_fade clearfix" style="position: relative;"></div>
                        <div style="display: none;" class="marquee_timer">5000</div>
                    </div>
                    <?php
                }
                $fromdate = date('Y-m-d');
                $todate = date('Y-m-d', strtotime(date('Y-m-d') . "+ 13 day"));

               echo  $sql_carausal = "select * from b_movies WHERE (DATE(AiringDateTime) BETWEEN '" . $fromdate . "' AND '" . $todate . "' OR promospot=1 ) AND `Status`=1 AND HomeCarausalPath !='' order by AiringDateTime ASC limit 0,8";
                $res_carausal = mysql_query($sql_carausal);
                if (mysql_num_rows($res_carausal) > 0) {
                    while ($row_carausal = mysql_fetch_array($res_carausal)) {
                        ?>
                        <div style="background-image: url(&quot;//hbosouthasia.com/<?php echo $row_carausal['HomeCarausalPath']; ?>&quot;); display: none;" class="marquee_item clearfix ">
                            <?php if ($row_carausal['VideoPath'] != '') { ?>
                                <div class="marquee_video_play">
                                    <div style="display: none;" class="marquee_video_link"><?php echo $row_carausal['VideoPath']; ?></div>
                                </div>
                            <?php } ?>
                            <div class="marquee_fade clearfix">
                                <div style="position: relative;" class="container clearfix font_content">
                                    <div class="marquee_content marquee_content_hide" style="display: none;">
                                        <p class="font_block_header shows_font"><a class="font_block_header shows_font" title="<?php echo $row_carausal['Title']; ?>" href="<?php echo getmoviename($row_carausal['Title'], $row_carausal['MovieID']) ?>"><?php echo $row_carausal['Title']; ?></a> <br>
                                            <?php echo DateFormat($row_carausal['AiringDateTime']); ?> </p>
                                        <p><?php echo $row_carausal['Synopsis']; ?></p>
                                        <a class="shows_font marquee_findoutmore" title="<?php echo $row_carausal['Title']; ?>" href="<?php echo getmoviename($row_carausal['Title'], $row_carausal['MovieID']) ?>">Find Out More</a>
                                        <p>
                                            <iframe scrolling="no" frameborder="0" allowtransparency="true" style="border:none; overflow:hidden; width:135px; height:25px;" src="https://www.facebook.com/plugins/like.php?href=http://www.hbosouthasia.com/<?php echo getmoviename($row_carausal['Title'], $row_carausal['MovieID']) ?>&amp;layout=button_count&amp;show_faces=false&amp;width=135&amp;action=like&amp;colorscheme=light&amp;height=25"></iframe>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div style="display: none;" class="marquee_timer">5000</div>
                        </div>
                        <?php
                        $movietitle.= '<li>' . $row_carausal['Title'] . '</li>';
                        $moviethumbnail.= '<li><a onClick="return false;" href=""><img width="48" height="32" border="0" class="marquee_nav_thumbnail" src="http://www.hbosouthasia.com/' . $row_carausal['FilePath'] . '"></a></li>';
                    }
                }
                ?>
                <div style="height:380px;"></div>
            </div>
            <div class="marquee_left_right_container">
                <div class="marquee_left_arrow">&lt;</div>
                <div class="marquee_right_arrow">&gt;</div>
            </div>
            <div id="marquee_nav_container" style="top: 366px;">
                <div class="glyph marquee_nav_tip_arrow_up" id="marquee_nav_tip_arrow"></div>
                <div class="container clearfix font_content">
                    <div id="marquee_nav_content">
                        <div class="font_content font_show_name" id="marquee_nav_showtitle_box"></div>
                        <div id="marquee_nav_thumanails">
                            <ul id="marquee_nav_thumbnail_list">
                                <!-- Banner's Thumbnails -->
                                <!--<li><a onClick="return false;" href=""><img width="48" height="32" border="0" class="marquee_nav_thumbnail" src="banners/banner-thumb/hbo-watch-n-win.png"></a></li>-->
                                <?php
                                if ($banner != '' && $bannerthumb != '' && $bannertitle != '') {
                                    ?>
                                    <li><a onClick="return false;" href=""><img width="48" height="32" border="0" class="marquee_nav_thumbnail" src="<?php echo $bannerthumb; ?>"></a></li>
                                <?php } ?>
                                <!-- Banner's Thumbnails -->
                                <?php echo $moviethumbnail; ?>
                            </ul>
                        </div>
                        <ul id="marquee_nav_showtitles">
                            <!-- Banner's Titles -->
                            <!-- <li>HBO Watch & Win Contest</li>-->
                            <?php
                            if ($banner != '' && $bannerthumb != '' && $bannertitle != '') {
                                ?>
                                <li><?php echo $bannertitle; ?></li>
                            <?php } ?>
                            <!-- Banner's Titles -->
                            <?php echo $movietitle; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/flash-detect-min.js" type="text/javascript"></script>
        <script src="assets/js/home-marquee.js" type="text/javascript"></script>
        <script language="javascript">
            $(document).ready(function() {
                if (FlashDetect.installed) {
                    $('#marquee div.marquee_item_version_nonflash').remove();
                } else {
                    $('#marquee div.marquee_item_version_flash').remove();
                }

                $('#marquee').simplebanner();
            });

            function playMarqueeVideo(video) {
                $('div.marquee_video_play_flash').each(function() {
                    if ($(this).children('div.marquee_video_link').html() == video) {
                        $(this).click();
                    }
                });
            }

            function replayMarqueeItem(marquee) {
                $('#marquee_nav_thumbnail_list').children().eq(marquee).mouseleave();
            }
        </script>
        <div class="block_container highlight_block_line block_background_top" id="block_schedule">
            <div class="clearfix" id="block_schedule_header">
                <div class="container clearfix font_content font_block_header shows_font special_font title_block"> 
                    Tonight On HBO
                    <div id="special_title_schedule" class="glow glow_position in en"></div>
                </div>
            </div>
            <div class="container clearfix section group channel_section_header">
                <div class="col span_2_of_15" id="block_schedule_channel_list">
                    &nbsp;
                </div>
                <div class="col" id="block_schedule_content">
                    <div class="block_schedule_top_nav_item view_full_schedule"><a class="shows_font special_font font_small" id="block_schedule_channel_list_view_full_schedule" href="<?php echo $site; ?>/movie-schedule.php">View Full Schedule</a></div>
                    <div class="block_schedule_top_nav_item calendar_container">
                        <div class="divTable">
                            <div class="divRow">
                                <div class="divCell">
                                    <input id="txtdate1" type="hidden" value="<?php echo date('Y-m-d'); ?>">
                                    <input id="txtdate2" type="hidden" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d', strtotime(date('Y-m-d'))) . " +  1 days")); ?>">
                                    <input id="txtdate3" type="hidden" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d', strtotime(date('Y-m-d'))) . " +  2 days")); ?>">
                                    <input id="txtpredate" type="hidden" value="3">
                                    <div class="calendar_left" onClick="getPlanerlist(document.getElementById('txtpredate').value);
                return false;">&lt;</div>
                                </div>
                                <div class="divCell">
                                    <div id="monthdiv" class="calendar_picker calendar_picker_header"><?php echo date('M'); ?></div>
                                    <div id="datediv" class="calendar_picker calendar_picker_date font_large"><?php echo date('j'); ?></div>
                                </div>
                                <div class="divCell">
                                    <input id="txtnextdate" type="hidden" value="2">
                                    <div class="calendar_right" onClick="getPlanerlist(document.getElementById('txtnextdate').value);
                return false;">dd&gt;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block_schedule_nav">
                        <div class="glyph" id="block_schedule_nav_left" onClick="getPlanerlist(document.getElementById('txtpredate').value);
                return false;" ></div>
                    </div>
                    <div class="block_schedule_container">
                        <div id="hboplanner" style="width: 2412px; left: -1608px;">
                        </div>
                    </div>
                    <div class="block_schedule_nav">
                        <div class="glyph" id="block_schedule_nav_right" onClick="getPlanerlist(document.getElementById('txtnextdate').value);
                return false;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block_container block_background_recommended block_bottom_space highlight_block_line weekly_update_block">
            <div class="container clearfix font_content">
                <div class="col span_7_of_15 font_content">
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
                                <div class="channel_block_main_thumb border_shadow">
                                    <div class="channel_block_description longer">
                                        <div class="big_txt">
                                            <div class="show_thumb_title_large timeline_wrap_text"><a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>" class="shows_font"><?php echo $row['Title']; ?></a></div>
                                            <p class="show_thumb_time_large"><?php echo DateFormat($row['AiringDateTime']); ?></p>
                                        </div>
                                    </div>
                                    <a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>"><img width="460" height="307" border="0" alt="<?php echo $row['Title']; ?>" src="http://www.hbosouthasia.com/<?php echo $row['FilePathBig']; ?>"></a> </div>
                            <?php } else { ?>

                                <div class="column border_shadow weekly_block_small_thumb <?php echo $divclass; ?>">
                                    <div class="channel_block_description middle">
                                        <div class="small_txt">
                                            <div class="show_thumb_title_large timeline_wrap_text"><a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>" class="shows_font"><?php echo $row['Title']; ?></a></div>
                                            <span class="show_thumb_time"><?php echo DateFormat($row['AiringDateTime']); ?></div>
                                    </div>
                                    <a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>"><img width="225" height="150" border="0" alt="<?php echo $row['Title']; ?>" src="http://www.hbosouthasia.com/<?php echo $row['FilePath']; ?>"></a> </div>
                            <?php
                            } $i++;
                        }
                        ?>
                    </div>
                    <?php } ?>
                <div class="col span_7_of_15 font_content week_block_margin" style="min-height:560px;">
                    <?php
                    $fromdate = date('Y-m-d');
                    $todate = date('Y-m-d', strtotime(date('Y-m-d') . "+ 10 day"));

                    $sql_most_like = "SELECT COUNT(*) AS totalcount,`c_likes`.MovieID,`SeriesID`,`Title`,`FilePathBig`,`Genre`,`AiringDateTime`,FilePath FROM `c_likes`
		JOIN `b_movies` ON(`b_movies`.`MovieID`=c_likes.`MovieID`)
		WHERE DATE(`b_movies`.AiringDateTime) BETWEEN '" . $fromdate . "' AND '" . $todate . "' AND `b_movies`.Status=1
		GROUP BY `b_movies`.`Title` ORDER BY 1 DESC limit 0,3";
                    $res_most_like = mysql_query($sql_most_like);
                    if (mysql_num_rows($res_most_like) > 0) {
                        ?>
                        <div class="font_block_header channel_section_header bottom_spacing shows_font special_font title_block"> You May Also Like<div class="heart"><img src="images/heart.png"></div>
                            <div id="special_title_hbooriginal" class="in en"></div>
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
                                <div class="channel_block_main_thumb border_shadow">
                                    <div class="channel_block_description longer">
                                        <div class="big_txt">
                                            <div class="show_thumb_title_large timeline_wrap_text"><a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>" class="shows_font"><?php echo $row['Title']; ?></a></div>
                                            <p class="show_thumb_time_large"><?php echo DateFormat($row['AiringDateTime']); ?></p>
                                        </div>
                                    </div>
                                    <a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>"><img width="460" height="307" border="0" alt="<?php echo $row['Title']; ?>" src="http://www.hbosouthasia.com/<?php echo $row['FilePathBig']; ?>"></a> </div>
        <?php } else { ?>
                                <div class="column border_shadow weekly_block_small_thumb <?php echo $divclass; ?>">
                                    <div class="channel_block_description middle">
                                        <div class="small_txt">
                                            <div class="show_thumb_title_large timeline_wrap_text"><a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>" class="shows_font"><?php echo $row['Title']; ?></a></div>
                                            <span class="show_thumb_time"><?php echo DateFormat($row['AiringDateTime']); ?></div>
                                    </div>
                                    <a title="<?php echo $row['Title']; ?>" href="<?php echo getmoviename($row['Title'], $row['MovieID']) ?>"><img width="225" height="150" border="0" alt="<?php echo $row['Title']; ?>" src="http://www.hbosouthasia.com/<?php echo $row['FilePath']; ?>"></a> </div>
                            <?php
                            } $i++;
                        }
                        ?>
                    </div>
<?php } ?>


                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

                <div class="col span_7_of_15 font_content" style="margin:0px;">
                    <div class="font_block_header channel_section_header bottom_spacing shows_font special_font title_block">
                        <div class="glow_position in en" id="special_title_thisweek"></div>HBO India on Twitter</div>
                    <a class="twitter-timeline" href="https://twitter.com/HBOINDIA"  data-widget-id="360746124857974784" data-show-replies="false" data-tweet-limit="3" width="480" >Tweets by @HBOINDIA</a>
                    <script>!function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                            if (!d.getElementById(id)) {
                                js = d.createElement(s);
                                js.id = id;
                                js.src = p + "://platform.twitter.com/widgets.js";
                                fjs.parentNode.insertBefore(js, fjs);
                            }
                        }(document, "script", "twitter-wjs");</script>

                </div>

                <div class="col span_7_of_15 font_content" style="margin-left:76px;">
                    <div class="font_block_header channel_section_header bottom_spacing shows_font special_font title_block">
                        <div class="glow_position in en" id="special_title_thisweek"></div>HBO India on Facebook</div>
                    <fb:like-box href="http://www.facebook.com/HBOINdia" width="460" colorscheme="light" show_faces="false" stream="true" header="false"></fb:like-box>
                </div>

                <div class="col shows_listing_block border_shadow" style="width:952px; margin:20px 0px 0px 0px;">
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
                        <a href="https://twitter.com/intent/tweet?text=<?php echo $row_didyouknow['StoryLine'] ?>&url=http://www.hbosouthasia.com" target="_blank" alt="Share on Twitter" title="Share on Twitter"><img src="images/tweet.png"></a></span>
                </div>     


            </div>
        </div>
    </div>
    <div class="block_background_body_bottom"></div>
    <script type="text/x-handlebars-template" id="cross-promo-block-template">
        &lt;div class="col span_9_of_15 border_shadow"&gt;
        &lt;div class="channel_block_main_thumb channel_block_thumb_margin"&gt;
        {{video}}
        &lt;div class="channel_block_description long"&gt;&lt;div class="big_txt"&gt;&lt;span class="show_thumb_time_large"&gt;{{time}}&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;
        &lt;a href="{{url}}" title="{{title}}"&gt;&lt;img src="{{img}}" border="0" width="393" height="262" alt="{{title}}" /&gt;&lt;/a&gt;
        &lt;div class="{{original}}"&gt;&lt;/div&gt;
        &lt;/div&gt;
        &lt;div class="channel_block_secondary_thumb"&gt;
        &lt;div class="font_large font_block_{{channel}}"&gt;&lt;a class="font_block_{{channel}}" href="{{url}}" title="{{title}}"&gt;&lt;span class="show_thumb_title_large"&gt;{{title}}&lt;/span&gt;&lt;/a&gt;&lt;/div&gt;
        &lt;p class="show_thumb_desc_large"&gt;{{synopsis}}&lt;/p&gt;
        &lt;a href="{{url}}" title="Find Out More" class="font_block_{{channel}} font_small"&gt;&lt;span class="font_block_{{channel}} font_small_header font_small"&gt;Find Out More&lt;/span&gt;&lt;/a&gt;
        &lt;div class="schedule_block_channel_fb_like home_block_fb_like"&gt;&lt;iframe src="https://www.facebook.com/plugins/like.php?href={{facebook}}&amp;amp;layout=button_count&amp;amp;show_faces=false&amp;amp;width=135&amp;amp;action=like&amp;amp;colorscheme=light&amp;amp;height=25" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:135px; height:25px;" allowtransparency="true"&gt;&lt;/iframe&gt;&lt;/div&gt;
        &lt;/div&gt;
        &lt;/div&gt;

        {{#each thumb}}
        &lt;div class="col span_3_of_15 border_shadow channel_block_third_thumb"&gt;
        {{video}}
        &lt;div class="channel_block_description short"&gt;
        &lt;div class="small_txt"&gt;
        &lt;div class="show_thumb_title timeline_wrap_text font_block_{{channel}}"&gt;&lt;a class="font_block_{{channel}}" href="{{url}}" title="{{title}}"&gt;{{title}}&lt;/a&gt;&lt;/div&gt;
        &lt;span class="show_thumb_time"&gt;{{time}}&lt;/span&gt;
        &lt;/div&gt;
        &lt;/div&gt;
        &lt;a href="{{url}}" title="{{title}}"&gt;&lt;img src="{{img}}" border="0" width="192" height="128" alt="{{title}}" /&gt;&lt;/a&gt;
        &lt;div class="{{original}}"&gt;&lt;/div&gt;
        &lt;/div&gt;
        {{/each}}
    </script>

<?php include("footerlink.php"); ?>  
<?php include("copyright.php"); ?>  
</div>
<script type="text/x-handlebars-template" id="now-showing-block-template">
    &lt;span class="font_content font_header"&gt;{{header}}&lt;/span&gt; &lt;span class="font_content"&gt;{{time}}&lt;/span&gt;&lt;br /&gt;
    &lt;span class="font_content font_show_name"&gt;&lt;a href="{{url}}" class="shows_font show_thumb_title_large" title="{{title}}"&gt;&lt;span&gt;{{title}}&lt;/span&gt;&lt;/a&gt;&lt;/span&gt;&lt;br /&gt;

</script>
<script type="text/x-handlebars-template" id="shows-popup-block-template">
    {{#each this}}
    &lt;div class="nav_shows_popup_content_column"&gt;
    &lt;span class="font_content font_small_header"&gt;{{column_name}}&amp;nbsp;&lt;/span&gt;
    &lt;div class="column weekly_block_small_thumb"&gt;
    &lt;a class="shows_font" href="{{url_1}}" title="{{title_1}}"&gt;&lt;img src="{{img_1}}" border="0" width="195" height="130" /&gt;&lt;/a&gt;
    &lt;div class="{{original_1}}"&gt;&lt;/div&gt;
    &lt;div class="column weekly_block_small_thumb nav_shows_popup_show_first"&gt;
    &lt;div class="show_thumb_title timeline_wrap_text shows_font"&gt;&lt;a class="shows_font" href="{{url_1}}" title="{{title_1}}"&gt;{{title_1}}&lt;/a&gt;&lt;/div&gt;
    &lt;span class="show_thumb_time"&gt;{{time_1}}&lt;/span&gt;
    &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class="column weekly_block_small_thumb nav_shows_popup_show"&gt;
    &lt;div class="show_thumb_title timeline_wrap_text shows_font"&gt;&lt;a class="shows_font" href="{{url_2}}" title="{{title_2}}"&gt;{{title_2}}&lt;/a&gt;&lt;/div&gt;
    &lt;span class="show_thumb_time"&gt;{{time_2}}&lt;/span&gt;
    &lt;/div&gt;
    &lt;div class="column weekly_block_small_thumb nav_shows_popup_show"&gt;
    &lt;div class="show_thumb_title timeline_wrap_text shows_font"&gt;&lt;a class="shows_font" href="{{url_3}}" title="{{title_3}}"&gt;{{title_3}}&lt;/a&gt;&lt;/div&gt;
    &lt;span class="show_thumb_time"&gt;{{time_3}}&lt;/span&gt;
    &lt;/div&gt;
    &lt;/div&gt;
    {{/each}}
</script>
<script type="text/javascript">
    var home_schedule_ajax = '';
    var now_showing_ajax = '';
</script>
<?php include("googleanalytics.php"); ?>
</body>
</html>