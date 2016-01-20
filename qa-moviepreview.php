<?php
include("config.php");

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
} else {
    header("location:index.php");
}
$videopath = "";
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
<?php include_once("header.php");?>
<script>
var loading_spinner_rectangle = '<div align="left"><img src="images/ajax-loader.gif"/></div>';                      
                     
                        $(document).ready(function(){
                            //load data
                             like('<?php echo $movieid; ?>',1);
                        });
function like(movieid,insert){
	
                var url = "ajax/likemovie.php";


                $("#likediv").html(loading_spinner_rectangle);

                $.post(
                url,
                {
                    movie_id : movieid,
                    insert : insert
                },
                function(data) {
                    $("#likediv").html(data);
                }
            );
            }
</script>
    <div id="block_schedule_header" class="clearfix movie_title">
      <div class="container clearfix font_content font_block_header shows_font special_font title_block">
        <div class="movie_title"><?php echo $row_back['Title'];?></div>
        <div class="glow glow_position"></div>
      </div>
  </div>
  <div class="block_container block_bottom_space block_top_space block_background3 highlight_block_line">
    <div class="container clearfix font_content">
      <div class="col span_6_of_15 font_content" style="position: relative;"> <img src="http://www.hbosouthasia.com/<?php echo $row_back['FilePathBig'];?>" border="0" width="95%" alt = "<?php echo $row_back['Title'] . '-' . $row_back['Genre'] . ' Movie' ?>" /><br><br><img src="http://www.hbosouthasia.com/<?php echo $row_back['FilePath'];?>" border="0" width="192" height="128" alt = "<?php echo $row_back['Title'] . '-' . $row_back['Genre'] . ' Movie' ?>" /> </div>
      <div class="col span_9_of_15 font_content">
	    <div class="show_divider special_font"><span class="font_small">Movie ID:</span> <?php echo $row_back['MovieID'];?></div>
		<?php if($row_back['Starring']) {?>
        <div class="show_divider special_font"><span class="font_small">Starring:</span> <?php echo $row_back['Starring'];?></div>
		<?php } if($row_back['DirectedBy']) {?>
        <div class="show_divider special_font"><span class="font_small">Directed By:</span> <?php echo $row_back['DirectedBy'];?></div>
		<?php } if($row_back['Genre']) {
		if (strtolower($row_back['Genre']) == "romance")
			$genre = 'romantic';
		else
			$genre = strtolower($row_back['Genre']);
			?>
        <div class="show_divider special_font"><span class="font_small">Genre:</span> <?php echo $row_back['Genre']; ?></div>
		<?php } if($row_back['Duration']) {?>
        <div class="show_divider special_font"><span class="font_small">Duration:</span> <?php echo formatduration($row_back['Duration']);?></div>
		<?php } if($row_back['Synopsis']) {?>
        <br />
        <div class="special_font"><?php echo $row_back['Synopsis'];?></div>
        <br />
		<?php } ?>
        <div class="about_show_timer_box" style="width: 259px;">
          <div class="font_header show_divider"> Showtime </div>
          <div class="show_divider font_content about_show_timer_box_timing"> <?php echo DateFormat($row_back['AiringDateTime']);?> </div>
        </div>
        <p>
          <iframe src="https://www.facebook.com/plugins/like.php?href=http://www.hbosouthasia.com/<?php echo getmoviename($row_back['Title'],$row_back['MovieID'])?>&amp;layout=button_count&amp;show_faces=false&amp;width=135&amp;action=like&amp;colorscheme=light&amp;height=25" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:135px; height:25px;" allowtransparency="true"></iframe>
		  <div id="like"><img src="images/like.png" onClick="like('<?php echo $row_back['MovieID'];?>',1)" style="cursor:pointer;" /></div>
		  <div id="like-text"><span id="likediv">&nbsp;</span> Likes</div>
        </p>
      </div>
    </div>
  </div>
  <div class="block_background_body_bottom">
    <div class="block_container block_background_recommended block_bottom_space highlight_block_line weekly_update_block">
	<?php 
	if($row_back['HomeCarausalPath'] != '')
		{
		   echo '<h1 style="text-align:center; color:red">Look Below For Home Carousel Image</h1><br/>
			 <img src="http://hbosouthasia.com/'.$row_back['HomeCarausalPath'].'" style="margin-left: 32px;" border="0" /> 	';
		}
	?>
    <div class="container clearfix font_content">
	  <div class="col shows_listing_block border_shadow" style="width:952px; margin:20px 0px 0px 0px;">
                                    <div class="text"><h2 class="cl-text">Tweet</h2></div>
                                    <span>Watch Movie <?php echo $row_back['Title']?> on HBO at <?php echo DateFormat($row_back['AiringDateTime'])?>
                                    <a href="https://twitter.com/intent/tweet?text=Watch Movie <?php echo $row_back['Title']?> on HBO at <?php echo DateFormat($row_back['AiringDateTime'])?>&url=http://www.hbosouthasia.com" target="_blank" alt="Share on Twitter" title="Share on Twitter"><img src="images/tweet.png"></a> <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script></span>
                                </div>
    </div>
  </div>
  </div>
<?php include("footerlink.php");?>  
<?php include("copyright.php");?> 
</div>
<script type="text/javascript">
var home_schedule_ajax = '';
var now_showing_ajax = '';
</script>
</body>
</html>
