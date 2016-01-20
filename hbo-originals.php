<?php
include("config.php");
$pagetitle = "HBO Originals | HBO Original Movies | HBO Series";
$pagedescription = "Find all of your favorite HBO Original Series. Experience the difference, every time you tune in to HBO!";
$pagekeywordsack = "";
?>
<?php include("mainheader.php");?>
<body>
<div id="wrapper">
<?php include_once("header.php");

$start_with = 'a-z';
$view = 'thumb';
if($_GET['view'])
{
$view = $_GET['view'];
}
if($_GET['start_with'])
{
$start_with = $_GET['start_with'];
}
?>

<div id="block_schedule_header" class="clearfix movie_title">
  <div class="container clearfix font_content font_block_header shows_font special_font title_block">
	<h2 class="page_title">HBO Originals</h2>
	<div class="glow glow_position"></div>
  </div>
</div>
  
<div class="block_container" style="min-height: 200px;">
<div class="container clearfix section group">
<div class="font_content font_block_header shows_font special_font channel_section_header bottom_spacing" style="font-size:18px;">Original TV series centered around various real and surreal themes that get you hooked!</div>
<div class="block_background_body_bottom">
    
    <script language="javascript">
$(document).ready(function(){
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
			
			window.location = 'movies.php?' + showlisting_search_criteria_to_string(search_criteria) + "#search_result";
			return false;
		}
	);
	<?php if($view == 'thumb') { ?>
	start_with_ids = "showlisting_start_with_";
	$('a[id^=' + start_with_ids + ']').click(
		function() {
			search_criteria_start_with = $(this).attr("id").substring(start_with_ids.length);
			search_criteria = showlisting_search_parse();
			
			window.location = 'hbo-originals.php?view=thumb' + '&start_with=' + search_criteria_start_with + showlisting_search_criteria_to_string(search_criteria) + "#search_result";
			return false;
		}
	);
	
	view_type_ids = "showlisting_view_";
	$('a[id^=' + view_type_ids + ']').click(
		function() {
			search_criteria_start_with = $(this).attr("id").substring(view_type_ids.length);
			search_criteria = showlisting_search_parse();
			
			window.location = 'hbo-originals.php?view=' + search_criteria_start_with + '&start_with=a-z' + showlisting_search_criteria_to_string(search_criteria) + "#search_result";
			return false;
		}
	);
	<?php } else {  ?>
	start_with_ids = "showlisting_start_with_";
	$('a[id^=' + start_with_ids + ']').click(
		function() {
			search_criteria_start_with = $(this).attr("id").substring(start_with_ids.length);
			search_criteria = showlisting_search_parse();
			
			window.location = 'hbo-originals.php?view=list' + '&start_with=' + search_criteria_start_with + showlisting_search_criteria_to_string(search_criteria) + "#search_result";
			return false;
		}
	);
	
	view_type_ids = "showlisting_view_";
	$('a[id^=' + view_type_ids + ']').click(
		function() {
			search_criteria_start_with = $(this).attr("id").substring(view_type_ids.length);
			search_criteria = showlisting_search_parse();
			
			window.location = 'hbo-originals.php?view=' + search_criteria_start_with + '&start_with=a-z' + showlisting_search_criteria_to_string(search_criteria) + "#search_result";
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
    <div class="block_container block_background4 block_bottom_space">
      <div class="container clearfix section group">
        <div class="col span_15_of_15">
          <!--<div class="col shows_listing_block border_shadow">
            <div class="shows_listing_group group_genre">
              <div class="shows_listing_clear_check"><a href="" id="shows_listing_genre_clear_all" title="Clear All">Clear All</a><a href="" id="shows_listing_genre_check_all" title="Check All">Check All</a></div>
              <div class="shows_listing_title">Genre</div>
              <ul class="shows_listing_items three_col">
                <li>
                  <input type="checkbox" name="showlisting_genre" value="action/adventure" id="showlisting_genre_action/adventure" checked/>
                  <label for="genre_action/adventure">Action/Adventure</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_genre" value="comedy" id="showlisting_genre_comedy" checked/>
                  <label for="genre_comedy">Comedy</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_genre" value="drama" id="showlisting_genre_drama" checked/>
                  <label for="genre_drama">Drama</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_genre" value="family" id="showlisting_genre_family" checked/>
                  <label for="genre_family">Family</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_genre" value="horror/thriller" id="showlisting_genre_horror/thriller" checked/>
                  <label for="genre_horror/thriller">Horror/Thriller</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_genre" value="romance" id="showlisting_genre_romance" checked/>
                  <label for="genre_romance">Romance</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_genre" value="sci-fi" id="showlisting_genre_sci-fi" checked/>
                  <label for="genre_sci-fi">Sci-Fi</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_genre" value="specials" id="showlisting_genre_specials" checked/>
                  <label for="genre_specials">Specials</label>
                </li>
              </ul>
            </div>
            <div class="shows_listing_group group_showing">
              <div class="shows_listing_title">Showing</div>
              <ul class="shows_listing_items one_col">
                <li>
                  <input type="radio" name="showlisting_showing" value="any_time" id="showlisting_showing_any_time" checked/>
                  <label for="showing_any_time">All Shows</label>
                </li>
                <li>
                  <input type="radio" name="showlisting_showing" value="today" id="showlisting_showing_today" />
                  <label for="showing_today">Today</label>
                </li>
                <li>
                  <input type="radio" name="showlisting_showing" value="this_week" id="showlisting_showing_this_week" />
                  <label for="showing_this_week">This Week</label>
                </li>
                <li>
                  <input type="radio" name="showlisting_showing" value="this_month" id="showlisting_showing_this_month" />
                  <label for="showing_this_month">This Month</label>
                </li>
              </ul>
            </div>
            <div class="shows_listing_group group_showtime">
              <div class="shows_listing_title">Showtime</div>
              <ul class="shows_listing_items one_col">
                <li>
                  <input type="checkbox" name="showlisting_showtime" value="morning" id="showlisting_showtime_morning" checked/>
                  <label for="showtime_morning">Morning</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_showtime" value="afternoon" id="showlisting_showtime_afternoon" checked/>
                  <label for="showtime_afternoon">Afternoon</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_showtime" value="primetime" id="showlisting_showtime_primetime" checked/>
                  <label for="showtime_primetime">Primetime</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_showtime" value="latenight" id="showlisting_showtime_latenight" checked/>
                  <label for="showtime_latenight">Late Night</label>
                </li>
              </ul>
            </div>
            <div class="shows_listing_group group_format">
              <div class="shows_listing_title">Show Type</div>
              <ul class="shows_listing_items">
                <li>
                  <input type="checkbox" name="showlisting_format" value="original_movies" id="showlisting_format_original_movies" checked/>
                  <label for="format_original_movies">Originals (Movies)</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_format" value="movies" id="showlisting_format_movies" checked/>
                  <label for="format_movies">Movies</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_format" value="original_series" id="showlisting_format_original_series" checked/>
                  <label for="format_original_series">Originals (Series)</label>
                </li>
                <li>
                  <input type="checkbox" name="showlisting_format" value="series" id="showlisting_format_series" checked/>
                  <label for="format_series">Series</label>
                </li>
              </ul>
              <br clear="all">
              <div style="margin-top:10px;"><a href="" id="showlisting_search_link" class="shows_font font_header" onClick="return false;">search</a></div>
            </div>
          </div>-->
<?php 
if($view == 'thumb')
{
?>
?>
<div class="column shows_listing_view_type">
<div class="shows_listing_alphabet"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_a-z" class="<?php if($_GET['start_with'] == '' || $_GET['start_with'] == 'a-z') echo 'show_thumb_title special_font'; ?>">All</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_a-c" class="<?php if($_GET['start_with'] == 'a-c') echo 'show_thumb_title special_font'; ?>">A - C</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_d-g" class="<?php if($_GET['start_with'] == 'd-g') echo 'show_thumb_title special_font'; ?>">D - G</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_h-m" class="<?php if($_GET['start_with'] == 'h-m') echo 'show_thumb_title special_font'; ?>">H - M</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_n-s" class="<?php if($_GET['start_with'] == 'n-s') echo 'show_thumb_title special_font'; ?>">N - S</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" onClick="return false;" id="showlisting_start_with_t-z" class="<?php if($_GET['start_with'] == 't-z') echo 'show_thumb_title special_font'; ?>">T - Z</a> </div>
<div class="shows_listing_view_type_txt"> <span>View&nbsp;&nbsp;</span> <a class="shows_listing_view_thumb selected" href="" id="showlisting_view_thumb"></a>&nbsp;&nbsp; <a class="shows_listing_view_list " href="" id="showlisting_view_list"></a>&nbsp;&nbsp; </div>
</div>
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

$sql1 = "select * from b_originalsmovies where Title REGEXP '^[" . $start_with . "]' and Status=1 ORDER BY Title";
$res1 = mysql_query($sql1);
if (mysql_num_rows($res1) > 0) {
if($view == 'list')
{
?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="shows_listing_tbl font_content">
          <tr>
            <th class="font_small_header" width="100%">Title</th>
          </tr>
<?php
}

$i=1;
while ($row1 = mysql_fetch_array($res1)) {
$design = '';
if($i%5==1)
$design = 'new_column';
if($view == 'thumb'){
?>		
        <div class="col span_3_of_15 border_shadow channel_block_third_thumb <?php echo $design;?>">
          <div class="channel_block_description short">
            <div class="small_txt">
              <div class="show_thumb_title shows_font"><?php echo $row1['Title']?></div>
              </div>
          </div>
          <img src="http://www.hbosouthasia.com/<?php echo $row1['FilePath']?>" border="0" width="192" height="128" alt="<?php echo $row1['Title']?>" /></div>
<?php
}
if($view == 'list')
{
if($row1['Genre']){ 
if (strtolower($row1['Genre']) == "romance")
	$genre = 'Romantic';
else
	$genre = $row1['Genre'];
}
?>
<tr>
            <td><span class="show_thumb_title shows_font"><?php echo $row1['Title']?></span>
              <div class="show_non_original" style="position: relative; display: inline-block; top: 2px; left: 5px;"></div></td>
          </tr>
<?php
}
$i++; 
} 
if($view == 'list')
{
?>
</table>
<?php
}
}
else
{
?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="shows_listing_tbl font_content">
          <tr>
            <td class="font_small_header" width="100%">No Record Found!</td>
          </tr>
</table>
<?php
}
?>
        
     </div>
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
<?php include("footeranalytics.php"); ?>
</body>
</html>
