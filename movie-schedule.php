<?php
include("config.php");
$pagetitle = "HBO Schedule | HBO TV Schedule | HBO Upcoming Movies on TV | HBO Weekly Schedule";
$pagedescription = "Check out the schedule for what's playing this week on HBO. Your Home of Blockbuster Movies.";
$pagekeywordsack = "";
?>
<?php include("mainheader.php"); ?>
<body>
    <!--<body id="servererror">
    <div class="server_error">
        503 Service Unavailable
        Server busy or connection refused by host.
    </div> -->
    <div id="wrapper">
        <?php
        include_once("header.php");
        $day1 = date('Y-m-d');
        $day2 = date('Y-m-d', strtotime(date('Y-m-d') . "+ 1 day"));
        $day3 = date('Y-m-d', strtotime(date('Y-m-d') . "+ 2 day"));
        ?>
        <div class="block_container" style="min-height: 200px;">
            <div class="block_background_body_bottom">
                <div id="block_schedule" class="block_container">
                    <div id="block_schedule_header" class="clearfix movie_title">
                        <div class="container clearfix font_content font_block_header shows_font special_font title_block">
                            <h2 class="movie_title">Movie Schedule</h2>
                            <div class="glow glow_position"></div>
                        </div>
                    </div>
                </div>
                <div class="container clearfix section group">
                    <div class="channel_section_header schedule_section_header"></div>   
                    <div class="block_container schedule_wrap">                        
                            <div class="col span_15_of_15">
                                <div id="schedule_date_nav" class="schedule_time_section font_schedule">
                                    <div class="calendar_container calendar_align_right">
                                        <input type="hidden" id="schedule_primetime" value="6:00 PM" />
                                        <input type="hidden" id="schedule_morning" value="8:00 AM" />
                                        <input type="hidden" id="schedule_afternoon" value="12:00 PM" />
                                        <input type="hidden" id="schedule_timenow" value="<?php echo date('g:i A'); ?>" />
                                    </div>
                                    <div id="timeline_time_now_quote" style="display: none;"><a class="special_font" href="javascript:void(0);" id="timeline_time_now">Now</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; </div>
                                    <div id="hide-xs">
                                    <a class="special_font" href="javascript:void(0);" id="timeline_time_morning">Morning</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a class="special_font" href="javascript:void(0);" id="timeline_time_afternoon">Afternoon</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a class="special_font" href="javascript:void(0);" id="timeline_time_primetime">Primetime</a>
                                    </div>
                                    <div class="schedule_time_section font_schedule block_top_space" style="padding-top:20px; padding-bottom:45px;"> <a href="" class="left_btn" id="timeline_left_arrow"> </a><a href="" id="timeline_right_arrow" class="right_btn"> </a>
                                        <div class="schedule_time_wrap">
                                            <ul class="schedule_timer_list" style="position: absolute; top: 6px; left: 0; width: 9600px;">
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="schedule_timeline_section">
                                        <div class="column span_15_of_15 block_schedule_top_space">
                                            <div class="column shows_font special_font font_large"><?php echo DateFormatInTitle($day1); ?></div>
                                            <!-- <a href="" class="document_view"></a> -->
                                        </div>
                                        <?php
                                        $sql1 = "SELECT bm.* FROM b_movies bm WHERE DATE(bm.AiringDateTime) ='" . $day1 . "' AND bm.Status=1 ORDER BY bm.AiringDateTime ASC ";										

                                        $res1 = mysql_query($sql1);
                                        if (mysql_num_rows($res1)) {
											$ctr = 1;
                                                $AiringDateTime = array();
                                                while ($row1 = mysql_fetch_array($res1)) {
                                                    $AiringDateTime[] = $row1['AiringDateTime'];
                                                }
                                                ?>
                                            <div class="column span_15_of_15 schedule_timeline_mask">
                                                <div class="timeline_full_width">
                                                    <?php
                                                        $i = 1;
                                                        $currMovieTime = $nextMovieTime = "";
                                                        $ctr = 1;
                                                        mysql_data_seek($res1, 0);
                                                        while ($row1 = mysql_fetch_array($res1)) {
                                                            //$width = $row1['DiffMin']*6;
                                                            $currMovieTime = $row1['AiringDateTime'];
                                                            $nextMovieTime = isset($AiringDateTime[$ctr]) ? $AiringDateTime[$ctr] : "";
                                                            //echo $currMovieTime." ### ".$nextMovieTime."<br />"; 
                                                            $width = 0;
                                                            if (!empty($nextMovieTime)) {
                                                                $datetime1 = strtotime($currMovieTime);
                                                                $datetime2 = strtotime($nextMovieTime);
                                                                $interval = round(($datetime2 - $datetime1) / 60);
                                                                $width = $interval * 6;
                                                            } else {
                                                                $duration = round($row1['Duration'] / 60);
                                                                $width = $duration * 6;
                                                            }

                                                            $ctr++;

                                                            /* if($row1['MovieID'] == "761") {
                                                              echo $currMovieTime." ### ".$nextMovieTime."<br />";
                                                              $width1 = 98+((strtotime($row1['AiringDateTime'])-strtotime($day1))/10);
                                                              echo "Width = ".$width."<br />";
                                                              echo "Width1 = ".$width1."<br />";
                                                              exit();
                                                              } */

                                                            if ($i == 1) {
                                                                $width1 = 98 + ((strtotime($row1['AiringDateTime']) - strtotime($day1)) / 10);
                                                                ?>
                                                            
                                                            
                                                            <div class="column schedule_timeline_odd" style="width:<?php echo $width1; ?>px">
                                                                <div class="channel_block_secondary_thumb font_content">
                                                                    <div class="font_large timeline_wrap_text"></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        <?php }
                                                        ?>
                                                        <div class="column schedule_timeline_odd" style="width:<?php echo $width; ?>px">
                                                            <div class="schedule_timeline_block font_content font_block_hbo">
                                                                <div class="schedule_timeline_non_original"></div>
                                                                <div class="font_large timeline_wrap_text"><a class="font_block_hbo" href="<?php echo getmoviename($row1['Title'], $row1['MovieID']) ?>" title="<?php echo $row1['Title'] ?>"><?php echo $row1['Title'] ?></a></div>
                                                                <div class="font_content"><?php echo DateFormatAMPM($row1['AiringDateTime']) ?></div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="column span_15_of_15 block_schedule_top_space">
                                            <div class="column shows_font special_font font_large"><?php echo DateFormatInTitle($day2); ?></div>
                                            <!-- <a href="" class="document_view"></a> -->
                                        </div>
                                        <?php
                                        $sql1 = "SELECT bm.* FROM b_movies bm WHERE DATE(bm.AiringDateTime) ='" . $day2 . "' AND bm.Status=1 ORDER BY bm.AiringDateTime ASC";
										$res1 = mysql_query($sql1);
                                        if (mysql_num_rows($res1)) {
                                                $AiringDateTime = array();
                                                while ($row1 = mysql_fetch_array($res1)) {
                                                    $AiringDateTime[] = $row1['AiringDateTime'];
                                                }
                                                ?>
                                                <div class="column span_15_of_15 schedule_timeline_mask">
                                                    <div class="timeline_full_width">
                                                <?php
                                                $i = 1;
                                                $ctr = 1;
                                                mysql_data_seek($res1, 0);
                                                while ($row1 = mysql_fetch_array($res1)) {
                                                    //$width = $row1['DiffMin']*6;

                                                    $currMovieTime = $row1['AiringDateTime'];
                                                    $nextMovieTime = isset($AiringDateTime[$ctr]) ? $AiringDateTime[$ctr] : "";
                                                    //echo $currMovieTime." ### ".$nextMovieTime."<br />"; 

                                                    $width = 0;
                                                    if ($nextMovieTime) {
                                                        $datetime1 = strtotime($currMovieTime);
                                                        $datetime2 = strtotime($nextMovieTime);
                                                        $interval = round(($datetime2 - $datetime1) / 60);
                                                        $width = $interval * 6;
                                                    } else {
                                                        $duration = round($row1['Duration'] / 60);
                                                        $width = $duration * 6;
                                                    }
                                                    $ctr++;

                                                    if ($i == 1) {
                                                        $width1 = 98 + ((strtotime($row1['AiringDateTime']) - strtotime($day2)) / 10);
                                                        ?>
                                                                <div class="column schedule_timeline_odd" style="width:<?php echo $width1; ?>px">
                                                                    <div class="channel_block_secondary_thumb font_content">
                                                                        <div class="font_large timeline_wrap_text"></div>
                                                                        <div></div>
                                                                    </div>
                                                                </div>
        <?php }
        ?>
                                                            <div class="column schedule_timeline_odd" style="width:<?php echo $width; ?>px">
                                                                <div class="schedule_timeline_block font_content font_block_signature">
                                                                    <div class="schedule_timeline_non_original"></div>
                                                                    <div class="font_large timeline_wrap_text"><a class="font_block_signature" href="movie-<?php echo strtolower(preg_replace('![^a-z0-9]+!i', '-', $row1['Title'])); ?>-<?php echo $row1['MovieID']; ?>.php" title="<?php echo $row1['Title'] ?>"><?php echo $row1['Title'] ?></a></div>
                                                                    <div class="font_content"><?php echo DateFormatAMPM($row1['AiringDateTime']) ?></div>
                                                                </div>
                                                            </div>
        <?php
        $i++;
    }
    ?>
                                                    </div>
                                                </div>
                                                    <?php } ?>
                                        <div class="column span_15_of_15 block_schedule_top_space">
                                            <div class="column shows_font special_font font_large"><?php echo DateFormatInTitle($day3); ?> </div>
                                            <!-- <a href="" class="document_view"></a> -->
                                        </div>
                                        <?php
                                        $sql1 = "SELECT bm.* FROM b_movies bm WHERE DATE(bm.AiringDateTime) ='" . $day3 . "' AND bm.Status=1 ORDER BY bm.AiringDateTime ASC";
                                        $res1 = mysql_query($sql1);
                                        if (mysql_num_rows($res1)) {
											    $AiringDateTime = array();
    while ($row1 = mysql_fetch_array($res1)) {
        $AiringDateTime[] = $row1['AiringDateTime'];
    }

                                            ?>
                                            <div class="column span_15_of_15 schedule_timeline_mask">
                                                <div class="timeline_full_width">
                                                    <?php
                                                $i = 1;
                                                $ctr = 1;
                                                mysql_data_seek($res1, 0);
                                                while ($row1 = mysql_fetch_array($res1)) {
                                                    //$width = $row1['DiffMin']*6;

                                                    $currMovieTime = $row1['AiringDateTime'];
                                                    $nextMovieTime = isset($AiringDateTime[$ctr]) ? $AiringDateTime[$ctr] : "";

                                                    $width = 0;
                                                    if ($nextMovieTime) {
                                                        $datetime1 = strtotime($currMovieTime);
                                                        $datetime2 = strtotime($nextMovieTime);
                                                        $interval = round(($datetime2 - $datetime1) / 60);
                                                        $width = $interval * 6;
                                                    } else {
                                                        $duration = round($row1['Duration'] / 60);
                                                        $width = $duration * 6;
                                                    }
                                                    $ctr++;

                                                    if ($i == 1) {
                                                        $width1 = 98 + ((strtotime($row1['AiringDateTime']) - strtotime($day3)) / 10);
                                                        ?>
                                                            <div class="column schedule_timeline_odd" style="width:<?php echo $width1; ?>px">
                                                                <div class="channel_block_secondary_thumb font_content">
                                                                    <div class="font_large timeline_wrap_text"></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        <?php }
                                                        ?>
                                                        <div class="column schedule_timeline_odd" style="width:<?php echo $width; ?>px">
                                                            <div class="schedule_timeline_block font_content font_block_family">
                                                                <div class="schedule_timeline_non_original"></div>
                                                                <div class="font_large timeline_wrap_text"><a class="font_block_family" href="<?php echo getmoviename($row1['Title'], $row1['MovieID']) ?>" title="<?php echo $row1['Title'] ?>"><?php echo $row1['Title'] ?></a></div>
                                                                <div class="font_content"><?php echo DateFormatAMPM($row1['AiringDateTime']) ?></div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="column span_15_of_15 block_top_space font_content vertical_align_top"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <script language="javascript">
                $(document).ready(function() {
                    schedule_page_datepicker_month_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

                    schedule_pagetimeline = new Array("12:00 AM", "12:30 AM", "1:00 AM", "1:30 AM", "2:00 AM", "2:30 AM", "3:00 AM", "3:30 AM", "4:00 AM", "4:30 AM", "5:00 AM", "5:30 AM", "6:00 AM", "6:30 AM", "7:00 AM", "7:30 AM", "8:00 AM", "8:30 AM", "9:00 AM", "9:30 AM", "10:00 AM", "10:30 AM", "11:00 AM", "11:30 AM", "12:00 PM", "12:30 PM", "1:00 PM", "1:30 PM", "2:00 PM", "2:30 PM", "3:00 PM", "3:30 PM", "4:00 PM", "4:30 PM", "5:00 PM", "5:30 PM", "6:00 PM", "6:30 PM", "7:00 PM", "7:30 PM", "8:00 PM", "8:30 PM", "9:00 PM", "9:30 PM", "10:00 PM", "10:30 PM", "11:00 PM", "11:30 PM");
                    schedule_slot_names = Array('now', 'morning', 'afternoon', 'primetime');
                    schedule_choosen_slot = 'primetime_now';

                    $('#schedule_datepicker').datepicker({dateFormat: 'yy-mm-dd',
                        minDate: '2013-08-01',
                        maxDate: '2013-09-30',
                        monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]});

                });
            </script>
            <script type="text/javascript" src="js/schedule.js"></script>
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
