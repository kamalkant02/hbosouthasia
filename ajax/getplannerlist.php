<?php
include("../config.php");
//print_r($_REQUEST);
$date = $_POST['movie_date'];
$start_limit = $_POST['start_limit'];
$end_limit = $_POST['end_limit'];
$sql1 = "SELECT * FROM (SELECT *
FROM b_movies
WHERE DATE(AiringDateTime) = '" . $date . "'
ORDER BY AiringDateTime DESC
LIMIT " . $start_limit . "," . $end_limit . ") AS tab1 ORDER BY AiringDateTime";

$res1 = mysql_query($sql1);
if (mysql_num_rows($res1) > 0) {
    while ($row1 = mysql_fetch_array($res1)) {
        ?>
        <div class="show_thumb_block">
            <div class="show_thumb_container channel_block_third_thumb">
                <div class="show_thumb_image"> <a title="<?php echo $row1['Title']; ?>" class="shows_font" href="<?php echo getmoviename($row1['Title'], $row1['MovieID']) ?>"><img width="192" height="128" border="0" alt="<?php echo $row1['Title']; ?>" src="http://www.hbosouthasia.com/<?php echo $row1['FilePath']; ?>"></a>
                    <div class="show_non_original"></div>
                </div>
            </div>
            <div class="show_thumb_bg">
                <div class="schedule_block_channel">
                    <div class="schedule_block_channel channel_block_description short">
                        <div class="small_txt">
                            <p class="show_thumb_title timeline_wrap_text"><a title="<?php echo $row1['Title']; ?>" class="shows_font" href="<?php echo getmoviename($row1['Title'], $row1['MovieID']) ?>"><?php echo $row1['Title']; ?></a></p>
                            <p class="show_thumb_time"><?php echo DateFormatAMPM($row1['AiringDateTime']); ?></p>
                        </div>
                    </div>
                </div>
                <div class="show_thumb_time en"><?php
                    if (strlen($row1['Synopsis']) > 112) {
                        echo substr($row1['Synopsis'], 0, 110) . "..";
                    } else {
                        echo $row1['Synopsis'];
                    }
                    ?></div>
                <div class="schedule_block_channel_fb_like">
                    <div class="schedule_bottom_findoutmore"><a class="shows_font show_thumb_time" title="Find Out More" href="<?php echo getmoviename($row1['Title'], $row1['MovieID']) ?>">Find Out More &gt;&gt;</a></div>
                    <iframe scrolling="no" frameborder="0" allowtransparency="true" style="border:none; overflow:hidden; width:135px; height:25px;" src="https://www.facebook.com/plugins/like.php?href=http://www.hbosouthasia.com/<?php echo getmoviename($row1['Title'], $row1['MovieID']) ?>&amp;layout=button_count&amp;show_faces=false&amp;width=135&amp;action=like&amp;colorscheme=light&amp;height=25"></iframe>
                </div>
            </div>
        </div>
        <?php
    }
}?>