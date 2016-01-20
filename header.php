<?php
$sql = "SELECT * FROM `a_territories` WHERE `Name`='" . $_SESSION[TerritoryName] . "'";
$res = mysql_query($sql);
if (mysql_num_rows($res) > 0) {
    $row = mysql_fetch_array($res);
    $banner1 = $row['Banner1Path'];
    $banner2 = $row['Banner2Path'];
}
?>
<section class="visible-desktop" id="page_header">
    <nav id="main_nav">
        <div class="clearfix block_background_menu" id="main_nav_container">
            <div class="container clearfix">
                <ul id="country_selector">
                    <li> <a id="selector" href="#">
                            <div class="glyph globe"></div>
                            <div class="font_content country_name"> <?php echo $_SESSION[TerritoryName]; ?> </div>
                            <div class="glyph arrow"></div>
                        </a>
                        <div style="display: none;" id="country_popup">
                            <div class="glyph" id="country_popup_arrow"></div>
                            <div class="country_popup_list_segment">
                                <div class="country_popup_list_segment_header"><span class="font_content font_small_header">English</span></div>
                                <div class="country_popup_list_segment_column">
                                    <ul class="country_list">
                                        <li><a class="font_content font_small" href="<?php echo $site; ?>/selectcountry.php?id=3">Bangladesh</a></li>
                                        <li><a class="font_content font_small" href="<?php echo $site; ?>/selectcountry.php?id=1">India</a></li>
                                        <li><a class="font_content font_small" href="<?php echo $site; ?>/selectcountry.php?id=4">Maldives</a></li>
                                        <li><a class="font_content font_small" href="<?php echo $site; ?>/selectcountry.php?id=2">Pakistan</a></li>
                                        <li><a class="font_content font_small" target="_blank" href="http://www.hboasia.com/family">HBO Asia</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>                
                <ul class="fb-userinfo">
                      <li><!--<img src="images/connect.png">-->
                        <?php include("fbconn/index.php"); ?>
                    </li>
                </ul>
                <div class="fb-btn-wrap">
                    <!--span><img src="images/fb-icn.png" alt=""/></span-->
                    <a href="http://www.facebook.com/HBOIndia" target="_blank"><img src="assets/img/core/connect-fb.png" alt=""/></a>
                    <!--a href="http://www.facebook.com/HBOIndia" target="_blank">Connect with facebook</a-->
                </div>
                <div id="social_bar">
                    <ul>
                        <li><a href="http://www.facebook.com/HBOIndia" target="_blank" rel="nofollow"><img src="images/fb-logo.png" alt="Facebook Logo" title="Facebook Logo" /></a></li>
                        <li><a href="http://twitter.com/#!/hboindia" target="_blank" rel="nofollow"><img src="images/twitter-logo.png" alt="Twitter Logo" title="Twitter Logo"/></a></li>
                        <li><a href="https://plus.google.com/107257115661832425654" rel="publisher" target="_blank"><img src="images/google_plus_icon.png" alt="G+ Logo" title="G+ Logo" /></a></li>
                        <li><a href="http://www.youtube.com/indiahbo" target="_blank" rel="nofollow"><img src="images/youtube-logo.png" alt="YouTube Logo" title="YouTube Logo" /></a></li>
                        <li><a href="http://www.pinterest.com/hboindia/" target="_blank" rel="nofollow"><img src="images/pint.png" alt="Pinterest Logo" title="Pinterest Logo" /></a></li>
                        <!--li><a class="font_content font_small" href="<?php echo $site; ?>/talktous.php">Sign up for newsletter</a></li-->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page_nav_bottom_line page_nav_bottom_line_position_hbo_8">
            <div class="page_nav_bottom_line_mask"></div>
        </div>
        <div class="clearfix" id="page_nav_container">
            <div class="container clearfix">
                <ul id="channel_nav">
                    <li>
                        <a class="menu_channel menu_channel_hbo menu_channel_selected" href="./">
                            <h1>                                
                                <img alt="HBOIndia – English Movies Channel, blockbuster Movies Channel" title="HBOIndia – English Movies Channel, blockbuster Movies Channel" src="assets/img/core/hbo_logo.png">
                            </h1>
                        </a>
                    </li>
                    <!--                    <li><a class="menu_channel menu_channel_hits " href="http://hbohits.in/" target="_blank"></a></li>
                                        <li><a class="menu_channel menu_channel_defined " href="http://hbodefined.in/" target="_blank"></a></li>-->
                </ul>
                <!--div id="nav_now_showing">
                    <div id="now_showing" class="show_thumb_title" style="float: left; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 255px;"> </div>
                    <div class="pre-nav hm_mobile">
                        <a class="font_content font_small" href="<?php echo $site; ?>/index.php">Home</a>
                    </div>
                </div-->
                <div id="nav_main_menu">
                    <ul>
                        <li class="glyph"> <a class="font_content font_header" href="<?php echo $site; ?>/movies.php">Movies</a></li>
                       <!-- <li class="glyph"><a class="font_content font_header" href="<?php //echo $site;   ?>/hbo-originals.php">HBO ORIGINALS</a></li> -->
                        <li class="glyph"> <a class="font_content font_header" href="<?php echo $site; ?>/aboutus.php">About Us</a></li>
                        <li class="glyph"> <a class="font_content font_header" href="<?php echo $site; ?>/movie-schedule.php">Schedule</a></li>
                    </ul>
                </div>
                <div id="nav_search_bar">
                    <form action="search.php" method="get" name="nav_search_form" id="nav_search_form">
                        <input type="text" placeholder="Search" value="<?php if ($_REQUEST['search_name'] != '') echo $_REQUEST['search_name']; ?>" id="top_search" name="search_name" class="glyph nav_search_box_string font_content font_smaller font_light">
                        <input type="hidden" value="search_go">
                    </form>
                </div>
            </div>
        </div>
    </nav>
</section>