<div class="block_container block_background_footer block_bottom_space">
    <div style="position: relative;" class="container clearfix font_content">
        <div class="glow glow_footer_position"></div>
<!--        <div style="margin-left:0;" class="col span_3_of_15">
            <div class="footer_items_block">
                <div class="font_header shows_font footer_items_title">Channels</div>
                <ul>
                    <li><a class="font_content font_large" href="http://hbodefined.in/" target="_blank">HBO Defined</a></li>
					<li><a class="font_content font_large" href="http://hbohits.in/" target="_blank">HBO Hits</a></li>
                </ul>
                <div id="questions"> Questions on "HBO Films Asia"
                  <div class="questions_tipstool">IT HAS COME TO OUR ATTENTION THAT INDIVIDUALS ARE USING THE NAME "HBO FILMS ASIA"  IN A MISLEADING WAY, WITHOUT OUR CONSENT.  PLEASE BE ADVISED THAT ANY ENTITY USING THAT NAME IS NOT CONNECTED IN ANY WAY WITH HBO, HBO ASIA, HBO FILMS, HOME BOX OFFICE OR ANY OTHER HBO COMPANY. ANY BUSINESS TRANSACTED WITH "HBO FILMS ASIA" OR ANY INDIVIDUALS RELATED THERETO IS NOT ON OUR BEHALF.  PLEASE CONTACT YOUR LOCAL AUTHORITIES IF YOU BELIEVE SOMETHING INAPPROPRIATE HAS OCCURRED.</div>
                </div>
            </div>
        </div>-->
        <div class="col span_4_of_15" style="margin-left:0;">
            <div class="footer_items_block">
                <div class="font_header shows_font footer_items_title">Quick Links</div>
                <ul>
                    <li><a class="font_content font_large" href="<?php echo $site; ?>/index.php">Home</a></li>
                    <li><a class="font_content font_large" href="<?php echo $site; ?>/movies.php">Movies</a></li>
                    <li><a class="font_content font_large" href="<?php echo $site; ?>/movie-schedule.php">Schedule</a></li>
                    <!--li><a class="font_content font_large" href="<?php echo $site; ?>/hbo-originals.php">HBO Originals</a></li-->
                    <li><a class="font_content font_large" href="<?php echo $site; ?>/talktous.php">Subscribe</a></li>
                </ul>
            </div>
        </div>
        <div class="col span_4_of_15">
            <div class="footer_items_block">
                <div class="font_header shows_font footer_items_title">HBO South Asia</div>
                <ul>
                    <li><a class="font_content font_large" href="<?php echo $site; ?>/aboutus.php">About us</a></li>
                    <li><a class="font_content font_large" href="<?php echo $site; ?>/contact-us.php">Contact Us</a></li>
                    <li><a class="font_content font_large" href="http://www.hboasia.com/contact/career" target="_blank">Careers at HBO Asia</a></li>
                    <li><a class="font_content font_large" href="<?php echo $site; ?>/faq.php">FAQs</a></li>
                </ul>
            </div>
        </div>
        <div class="col span_4_of_15">
            <div class="footer_items_block">
                <div class="font_header shows_font footer_items_title">Terms/Policy</div>
                <ul>
                    <li><a class="font_content font_large" href="<?php echo $site; ?>/term-of-use.php">Terms Of Use</a></li>
                    <li><a class="font_content font_large" href="<?php echo $site; ?>/privacy-policy.php">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="col span_3_of_15">
            <div class="footer_items_block">
                <h3 class="download-btn">
                    <a target="_blank" href="http://www.facebook.com/HBOIndia/app_264664263579737" class="btn-ui">Download HBO Planner</a>
                </h3>
                <div style="text-align:right" class="footer-search">
                    <form action="search.php" method="get" name="nav_search_form" id="nav_search_form">
                        <input type="text" placeholder="Search" value="<?php if ($_REQUEST['search_name'] != '') echo $_REQUEST['search_name']; ?>" id="top_search" name="search_name" class="glyph nav_search_box_string font_content font_smaller font_light">
                        <input type="hidden" value="search_go">
                    </form>
                </div>
            </div>
        </div>
        <div style="position:absolute; bottom: 0px; right: 0px;" class="col span_3_of_15">
                <div style="text-align:right"> <a class="back_to_top shows_font" id="BackToTop" href="" title="Back to Top"></a> </div>
        </div>
    </div>
</div>
<?php mysql_close($link); ?>