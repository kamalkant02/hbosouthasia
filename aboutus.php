<?php
//testing by kk
//about us
include("config.php");
$pagetitle = "About Us - Hello Testing HBO South Asia";
$pagedescription = "HBO India brings the top blockbuster movies to Asia first through exclusive licensing with the major Hollywood studios - Paramount Pictures, Universal Studios and Warner Bros and many more. Experience the difference, every time you tune in to HBO";
$pagekeywordsack = "";
?>
<?php include("mainheader.php"); ?>
<body>
    <div id="wrapper">
        <?php include_once("header.php"); ?>
        <div id="block_schedule_header" class="clearfix movie_title">
            <div class="container clearfix font_content font_block_header shows_font special_font title_block">
                <h2 class="page_title">About Us</h2>
                <div class="glow glow_position"></div>
            </div>
        </div>

        <div class="block_container" style="min-height: 200px;">
            <div class="container clearfix section group">
                <div class="font_content font_block_header shows_font special_font channel_section_header bottom_spacing">

                    <div class="highlight-list2">

                        <ul>
                            <li><a href="aboutus.php" class="active"  class = "shows_font">Studios</a></li>
                            <li><a href="hbo.php"  class = "shows_font">HBO</a></li>
                            <li><a href="milestones.php"  class = "shows_font">Milestones</a></li>
                            <li><a href="territories.php"  class = "shows_font">Territories</a></li>
                        </ul>
                    </div>
                    <div class="about-us-text">
                        <p>HBO Asia is able to bring the best of Hollywood to Asia first because of its exclusive licensing deals with major Hollywood studios. In addition   to the proprietary and award-winning HBO Original programs that are   produced exclusively for HBO viewers, HBO Asia works with a large number   of major independent production companies to secure exclusive rights to   a host of quality movies. In Asia, HBO Asia offers five subscription   movie channels with uninterrupted programming in SD and HD formats &ndash;   HBO, HBO SIGNATURE, HBO FAMILY, HBO HITS and CINEMAX &ndash; as well as a   subscription video-on-demand service, HBO ON DEMAND. In South Asia, it offers HBO, <a href="http://www.hbodefined.in/" class = "shows_font">HBO DEFINED</a> and <a href="http://www.hbohits.in/" class = "shows_font">HBO HITS</a> in SD and HD formats. HBO Asia is a joint venture of HBO (a Time Warner company) and Paramount.</p>
                        <p><br />For more information,<br />please visit:&nbsp;<a href="http://www.hboasia.com/about" class = "shows_font" target="_blank">www.hboasia.com</a>&nbsp;or&nbsp;<a href="http://www.hbosouthasia.com/" class = "shows_font" target="_blank">www.hbosouthasia.com</a></p>

                        <div style="margin-left: -25px;padding-top: 100px;">
                            <!-- facebook, twitter and google plus like button  -->

                            <div id="tweet-follow">
                                <iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/follow_button.1338995330.html#_=1339147760315&amp;id=twitter-widget-2&amp;lang=en&amp;screen_name=HBOIndia&amp;show_count=true&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button" style="width: 222px; height: 20px;" title="Twitter Follow Button"></iframe>
                                <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
                            </div>

                            <!--plugin wherever you want the facebook like button to appear  -->
                            <div id="tweet-follow" style="width: 180px;">

                                <!-- Place this tag in your head or just before your close body tag. -->
                                <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

                                <!-- Place this tag where you want the +1 button to render. -->
                                <g:plusone size="medium" href="https://plus.google.com/107257115661832425654"></g:plusone>



                                <div>

                                    <fb:like font="arial" show_faces="true" width="450" layout="button_count" send="false" href="http://www.facebook.com/HBOIndia" class=" fb_edge_widget_with_comment fb_iframe_widget"></fb:like>
                                    <script>
                                        (function(d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0];
                                            if (d.getElementById(id)) {
                                                return;
                                            }
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));
                                    </script><br /><br /><br /><br /><br />

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php include("footerlink.php"); ?>  
        <?php include("copyright.php"); ?> 
    </div>
    <?php include("footeranalytics.php"); ?>
</body>
</html>
