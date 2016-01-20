<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Remind Me - HBO South Asia</title>
        <?php include("mainheader.php"); ?>        
        <script type="text/javascript">
            function alertmeSubmit() {
                //name field validation
                var name = document.getElementById('txtname');
                if (name.value.trim() == "") {
                    alert('Please enter your name.');
                    name.focus();
                    return false;
                }
                //email id validation
                var email = document.getElementById('txtemail');
                if (email.value.trim() == "") {
                    alert('Please enter your email.');
                    email.focus();
                    return false;
                }

                //email id validation               
                if (email.value.search(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/) == -1) {
                    alert('Please enter valid email.');
                    email.focus();
                    return false;
                }

                //alert time validation
                var alertme = document.getElementById('cmbhour');
                if (alertme.value.trim() == "") {
                    alert('Please select alert time.');
                    alertme.focus();
                    return false;
                }
            }
        </script>       
        
    </head>
    <body>
    <div id="smsg"></div>
    
    
        <?php
		include ('config.php');
		 $movieid = mysql_real_escape_string($_GET['id']); ?>
        <div class="popup" id="main_form_div">            
            <?php
            //getting date for display movie id day
            $sql_movie = "SELECT * FROM b_movies WHERE MovieID = '" . $movieid . "'";
            $res_movie = mysql_query($sql_movie);
            if (mysql_num_rows($res_movie) > 0) {
                $row_back = mysql_fetch_array($res_movie);
				$movieurl = getmoviename($row_back['Title'], $row_back['MovieID']);
				$servername = $_SERVER['SERVER_NAME'];
                ?>
				<script type="text/javascript">
					//alert(window.top.location.href);
					var movieurltext = "<?php echo $movieurl; ?>";
					var str = window.top.location.href;
					var res = str.substr(0, 40); /////http://www.hbosouthasia.com/remindme.php
					var matchurl = "http://www.hbosouthasia.com/remindme.php";
					if("<?php echo $servername?>"=="localhost")
					{
						var matchurl = "http://localhost/hbosouthasia.com/remind";
					}
					if(res == matchurl)
					{
						window.location.href=movieurltext;
					}
					
				</script>
                <div class="container clearfix font_content font_block_header shows_font special_font title_block">
                    <div class="movie_title"><?php echo $row_back['Title']; ?></div>
                    <div class="glow glow_position"></div>
                </div>    
                <?php
                if (date('Y-m-d H:i:s') < $row_back['AiringDateTime']) {
					
					
					//$airivingTime = strtotime($row_back['AiringDateTime']);
					
					            $airivingTime = strtotime($row_back['AiringDateTime']);
								$currentTime  = strtotime(date('Y-m-d H:i:s'));
								$remainingHr  = ($airivingTime-$currentTime)/3600;
								
								if($remainingHr >= 1) {
								 ?>
                                
                                
                                
                    <div class="popup_leftblock">

                        <form action="" method="post" name="alert-me" id="alert-me">
                            <h4 style="color: #fff">Remind Me</h4>
                            <div class="popup_box">
                                Name:<br/>
                                <input type="text" name="txtname" id="txtname" maxlength="100" />
                                <input type="hidden" name="mscheduleid" id="mscheduleid" value="<?php echo $movieid; ?>"/>
                                <input type="hidden" name="arivingtime" id="arivingtime" value="<?php echo $row_back['AiringDateTime']; ?>"/>
                                <input type="hidden" name="movie_name" id="movie_name" value="<?php echo $row_back['Title']; ?>"/>
                            </div>
                            <div class="popup_box">
                                Email:<br/>
                                <input type="text" name="txtemail" id="txtemail" maxlength="100" />
                            </div>

                            <div class="popup_box">
                                Alert Before:<br/>
                                <select style="width:145px;" name="cmbhour" id="cmbhour">
                                <?php if($remainingHr >= 1) { ?>
                                    <option value="1">1 hours</option>
                                    <?php } if($remainingHr >= 2) { ?>
                                    <option value="2">2 hours</option>
                                    <?php } if($remainingHr >= 3) { ?>
                                    <option value="3">3 hours</option>
                                    <?php } if($remainingHr >= 4) { ?>
                                    <option value="4">4 hours</option>
                                    <?php } if($remainingHr >= 5) { ?>
                                    <option value="5">5 hours</option>
                                    <?php } ?>
                                </select>
                            </div>   
                            <div class="popup_box"> 
                                <input type="submit" name="btnsubmit" id="btnsubmit" class="formsubmit" onclick="return alertmeSubmit();"  value='Submit' />
                            </div>
                        </form>


                    </div>
                <?php } else {?>

					<div class="popup_leftblock">                        
                        <p>Thanks for using the HBO South Asia website.</p>
                        <p>The movie will air at <?php echo DateFormatAMPM($row_back['AiringDateTime']); ?>. Don't forget to watch it on HBO.</p>                                                  
                    </div>
					
					
					<?php }
				
				} else {
                    ?>
                    <div class="popup_leftblock">                        
                        <p>Thanks for using the HBO South Asia website.</p>
                        <p>However, the movie has been aired already. Please choose another movie to use the reminder functionality.</p>                                                  
                    </div>
                <?php }
                ?>
                <div class="popup_rightblock">   
                    <!-- <div class="popup_rightblock remind_full">   -->

                    <div class="col span_6_of_15 font_content"> 
                        <img src="http://www.hbosouthasia.com/<?php echo $row_back['FilePath']; ?>" border="0" alt = "<?php echo $row_back['Title'] . '-' . $row_back['Genre'] . ' Movie' ?>" />
                    </div>
                    <div class="col span_9_of_15 font_content">
                        <?php if ($row_back['Starring']) { ?>
                            <div class="show_divider special_font"><span class="font_small">Starring:</span> <?php echo $row_back['Starring']; ?></div>
                        <?php } if ($row_back['DirectedBy']) { ?>
                            <div class="show_divider special_font"><span class="font_small">Directed by:</span> <?php echo $row_back['DirectedBy']; ?></div>
                            <?php
                        } if ($row_back['Genre']) {
                            if (strtolower($row_back['Genre']) == "romance")
                                $genre = 'romantic';
                            else
                                $genre = strtolower($row_back['Genre']);
                            ?>
                            <div class="show_divider special_font"><span class="font_small">Genre:</span> <?php echo '<a href="' . $genre . '-movies.php" style="text-decoration:underline; font-size:16px; color:#ffffff;">' . $row_back['Genre'] . '</a>'; ?></div>
                        <?php } if ($row_back['Duration']) { ?>
                            <div class="show_divider special_font"><span class="font_small">Duration:</span> <?php echo formatduration($row_back['Duration']); ?></div>
                        <?php } ?>                        

                        <div class="about_show_timer_box">
                            <div class="font_header show_divider"> Showtime </div>
                            <div class="show_divider font_content about_show_timer_box_timing"> <?php echo DateFormat($row_back['AiringDateTime']); ?>
                            
                            
                            </div>
                        </div>                       
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <script>
		$(function() {
			$("#alert-me").submit(function() {
				var datastrg = $( "#alert-me" ).serialize();
				 $.ajax({
					 type: "POST",
					 url: "alert_insert.php",
					 data: datastrg,
					 success: function(save_result) {
						 $("#main_form_div").hide();
						 $("#smsg").html(save_result);
						 return false;
						 }
					}); 
					return false;
			});
					
	    });
		</script>
    <?php include("footeranalytics.php"); ?>
	</body>
</html>
