<?php
include("config.php");
?>
<?php include("mainheader.php"); ?>
<body>
    <div id="wrapper">
        <?php include_once("header.php"); ?>
        <div id="block_schedule_header" class="clearfix movie_title">
            <div class="container clearfix font_content font_block_header shows_font special_font title_block">
                <h2 class="page_title">Talk to us</h2>
                <div class="glow glow_position"></div>
            </div>
        </div>

        <?php
        $InsertCheck = 0;
        if ($_GET['a'] == 's') {
            $InsertCheck = 1;
        }

        if (isset($_POST['btnSubmit']) && !empty($_POST['txtEmail'])) {
            $InsertData['txtName'] = DoSecure($_POST['txtName']);
            $InsertData['txtEmail'] = DoSecure($_POST['txtEmail']);
            $InsertData['txtCity'] = (DoSecure($_POST['txtCity']) != 'City :' ? DoSecure($_POST['txtCity']) : '');
            $InsertData['txtCmnt'] = DoSecure($_POST['txtCmnt']);

///////////////////////////////////////////Server side validation for contact/////////////////////////////////////
            $error_msg = '';
            if ($InsertData['txtName'] == 'Name :' || $InsertData['txtName'] == '') {
                $error_msg.="Please enter your first name.<br>";
            }
            if ($InsertData['txtEmail'] == 'Email :' || $InsertData['txtEmail'] == '') {
                $error_msg.="Please enter your email.<br>";
            }
            if (!ereg("[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]", $InsertData['txtEmail'])) {
                $error_msg.= "Please enter a valid email" . "<br>";
            }

            if ($InsertData['txtCmnt'] == 'Comments :' || $InsertData['txtCmnt'] == '') {
                $error_msg.="Please enter your comments.<br>";
            }

            if ($error_msg == '') {
                $headers = "From: " . $InsertData['txtName'] . "<" . $InsertData['txtEmail'] . ">";
                /* $headers .= "Bcc: Parijaat Sharma <parijaat.sharma@omlogic.com>"; */
                $headers = $headers . "\r\n";
                $headers = $headers . 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $to = "hbosa@hboasia.com";

                $subject = "User Contact Details";

                $body = ' <html>
		 <body>
		 <table width="80%" border="solid" align="center" cellpadding="2" cellspacing="2" >
             
		  <tr valign="top" class="text"> 
          <td valign="middle">Name:</td>
          <td>' . $_POST['txtName'] . '</td>
          </tr>
		  
		  <tr valign="top" class="text"> 
          <td valign="middle">E-mail:</td>
          <td>' . $_POST['txtEmail'] . '</td>
          </tr>
		  
		   <tr valign="top" class="text"> 
          <td valign="middle">City:</td>
          <td>' . $_POST['txtCity'] . '</td>
          </tr>
		  
		  <tr valign="top" class="text"> 
          <td valign="middle">Comments:</td>
          <td>' . $_POST['txtCmnt'] . '</td>
          </tr>
		  
  </table>
</body>
  </html>
  ';
//echo $body;


                if ($_POST['chkfb'] == '1') {
                    echo "<script>
window.open('http://www.facebook.com/dialog/feed?app_id=290373271008258&display=popup&link=http://www.hbosouthasia.com/&picture=http://www.hbosouthasia.com/images/hbo_90_90.jpg&name=Welcome to HBO South Asia&description=" . $_POST['txtCmnt'] . "&message=" . $_POST['txtCmnt'] . "&redirect_uri=http://www.hbosouthasia.com/fbconnect/response/','','height=250, width=540, top=100 scrollbars=0');
</script>";
                }
                if ($_POST['chktw'] == '1') {
                    if (strlen($_POST['txtCmnt']) > 119) {
                        $tweettext = substr($_POST['txtCmnt'], 0, 115) . "...";
                    } else {
                        $tweettext = $_POST['txtCmnt'];
                    }
                    echo "<script>
window.open('http://twitter.com/share?url=http://www.hbosouthasia.com&text=" . $tweettext . "','','height=250, width=540, left=600,top=100 scrollbars=0');
</script>";
                }
                $InsertCheck = 1;
                /* mail($to, $subject, $body, $headers); */
                if (mail($to, $subject, $body, $headers)) {
                    header("location:talktous.php?a=s");
                }
                $InsertCheck = 1;
            } else {
                $InsertCheck = 2;
            }
        }
        $message = '';
        switch ($InsertCheck) {
            case 1: $message .="<span class=\"successmsg\">Thank You for your time. we will contact you soon.</span>";
                break;
            case 2: $message .="<span class=\"errormsg\">" . $error_msg . "</span>";
                break;
        }
        ?>

        <?php
        if ($_GET['a'] == 'n') {
            $InsertCheck = 3;
        }

        if (isset($_POST['btnSubmit1']) && !empty($_POST['txtEmail1'])) {
            $InsertData['txtName1'] = DoSecure($_POST['txtName1']);
            $InsertData['txtEmail1'] = DoSecure($_POST['txtEmail1']);
            $InsertData['txtCable'] = (DoSecure($_POST['txtCable']) != 'Cable Operator :' ? DoSecure($_POST['txtCable']) : '');
            $InsertData['userIPAddress'] = $_SERVER["REMOTE_ADDR"];
            $InsertData['addDate'] = DateFormatDB(date("Y-m-d H:i:s"));
            $InsertData['VerificationCode'] = date('YmdHis') . rand('10000', '99999');

///////////////////////////////////////////Server side validation for Newsletter/////////////////////////////////////
            $error_msg1 = '';
            if ($InsertData['txtName1'] == 'Name :' || $InsertData['txtName1'] == '') {
                $error_msg1.="Please enter your name.<br>";
            }
            if ($InsertData['txtEmail1'] == 'Email :' || $InsertData['txtEmail1'] == '') {
                $error_msg1.="Please enter your email.<br>";
            }
            if (!ereg("[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]", $InsertData['txtEmail1'])) {
                $error_msg1.= "Please enter a valid email" . "<br>";
            }
            $isusernameactive = mysql_num_rows(mysql_query("SELECT * FROM f_newsletter WHERE userEmail='" . $InsertData['txtEmail1'] . "' AND isDeleted=0 AND Verified=1"));
            //echo $isusernameactive;
            if ($InsertData['txtEmail1'] != 'Email :' && $InsertData['txtEmail1'] != '' && ereg("[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]", $InsertData['txtEmail1']) && $isusernameactive > 0) {
                $error_msg1.="Your email address already exists in our database.<br>";
            }

            if ($error_msg1 == '') {
                // insert query

                $ins_sql = "INSERT INTO f_newsletter
		set
		userName = '" . addslashes(ucwords($InsertData['txtName1'])) . "',
		UserEmail = '" . $InsertData['txtEmail1'] . "',
		cableOperator = '" . addslashes(ucwords($InsertData['txtCable'])) . "',
		userIPAddress = '" . $InsertData['userIPAddress'] . "',
		VerificationCode = '" . $InsertData['VerificationCode'] . "',
		country = '" . $_SESSION[TerritoryName] . "',
		addDate	= '" . $InsertData['addDate'] . "'";

                mysql_query($ins_sql);
                $genid = mysql_insert_id();
                if ($genid) {
/////////////////////////////////////Send mail to admin personal//////////////////////////////////////////
                    $headers2 = "From: " . $InsertData['txtName1'] . "<" . $InsertData['txtEmail1'] . ">";
                    /* $headers2 .= "Bcc: Parijaat Sharma <parijaat.sharma@omlogic.com>"; */
                    $headers2 = $headers2 . "\r\n";
                    $headers2 = $headers2 . 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $to2 = "hbosa@hboasia.com";

                    $subject2 = "Newsletter Contact Details";

                    $body2 = ' <html>
		 <body>
		 <table width="80%" border="solid" align="center" cellpadding="2" cellspacing="2" >
             
		  <tr valign="top" class="text"> 
          <td valign="middle">Name:</td>
          <td>' . $_POST['txtName1'] . '</td>
          </tr>
		  
		  <tr valign="top" class="text"> 
          <td valign="middle">E-mail:</td>
          <td>' . $_POST['txtEmail1'] . '</td>
          </tr>
		  
		   <tr valign="top" class="text"> 
          <td valign="middle">Cable operator:</td>
          <td>' . $_POST['txtCable'] . '</td>
          </tr>
		  </table>
			</body>
		  </html>
  			';
                    if (mail($to2, $subject2, $body2, $headers2)) {
                        include("verificationemail.php");
                        header("location:talktous.php?a=n");
                    }
                    $InsertCheck = 3;
                } else {
                    $InsertCheck = 4;
                }
            } else {
                $InsertCheck = 4;
            }
        }
        $message1 = '';
        switch ($InsertCheck) {
            case 3: $message1 .="<span class=\"successmsg\">Thank You for your time. Your request for newsletter subscription has been successfully submitted.<br>An Email has been sent on your email for activation. Please check spam emails also.</span>";
                break;
            case 4: $message1 .="<span class=\"errormsg\">" . $error_msg1 . "</span>";
                break;
        }
        ?> 




        <div class="block_container" style="min-height: 200px;">
            <form id="form2" name="form2" method="post" action="" onSubmit="return validateInfoOnSubmit1()" class="form-ui">
                <div class="block_container">
                    <div class="container clearfix section group plain_content_section_header">
                        <div class="row">
                        <div class="col-xs-12 col-sm-9 font_content">
                            <p class="special_font no_up_spacing" style="margin-top: 20px;">Stay updated. Know what's coming on air in the next few days via our newsletter.</p>
                            <div class="column span_15_of_15 newsletter_highlight_box">    
                                <div class="span_15_of_15 column newsletter_highlight_box_content">
                                    <div id="newsletter_email_error"> 
                                        <?php
                                        if ($message1 != '') {
                                            echo $message1;
                                        }
                                        ?>
                                    </div>
                                    <div class="column span_7_of_15">
                                        <!--p class="less_spacing">Name *</p-->
                                        <input type="text" id="txtName1" placeholder="Name" name="txtName1" maxlength="50" value="" onFocus="blank(this)" onBlur="unblank(this)" class="hbo_subscribe_input"  />
                                    </div>
                                    <div class="column span_1_of_15">&nbsp;</div>
                                    <div class="column span_7_of_15">
                                        <!--p class="less_spacing">Email *</p-->
                                        <input type="text" id="txtEmail1"  placeholder="Email" name="txtEmail1" maxlength="255" value="" onFocus="blank(this)" onBlur="unblank(this)" class="hbo_subscribe_input" />
                                    </div>
                                </div>
                                <div class="span_15_of_15 column newsletter_highlight_box_content">
                                    <div id="newsletter_cable_error" class="column span_15_of_15 newsletter_error_msg_hide">Please provide your cable operator name:</div>
                                    <div class="column span_7_of_15">
                                        <!--p class="less_spacing special_font">Cable Operator</p-->
                                        <input type="text" id="txtCable" placeholder="Cable Operator" name="txtCable" maxlength="50" value="" onFocus="blank(this)" onBlur="unblank(this)" class="hbo_subscribe_input" />
                                    </div>
                                    <div class="column span_1_of_15">&nbsp;</div>
                                </div>
                                <div class="span_15_of_15 column newsletter_highlight_box_content"> 
                                    <p class="less_spacing special_font space-mb">&nbsp;</p>                    
                                    <div>
                                        <input type="submit" name="btnSubmit1" class="hboSubmit btn-ui" value="Submit" />
                                    </div>
                                </div>
                            </div>            
                        </div>
                    </div> 
                        </div>
                </div>
            </form>

            <form id="form1" name="form1" method="post" action="" onSubmit="return validateInfoOnSubmit()" class="form-ui">
                <div class="block_container">
                    <div class="container clearfix section group plain_content_section_header">
                        <div class="row">
                        <div class="col-xs-12 col-sm-9 font_content">
                            <p class="special_font no_up_spacing">Talk to Us</p>
                            <div class="column span_15_of_15 newsletter_highlight_box">              

                                <div class="span_15_of_15 column newsletter_highlight_box_content">
                                    <div id="newsletter_email_error"> 
                                        <?php
                                        if ($message != '') {
                                            echo $message;
                                        }
                                        ?>
                                    </div>
                                    <div class="column span_7_of_15">
                                        <!--p class="less_spacing">Name *</p-->
                                        <input type="text" id="txtName" placeholder="Name" name="txtName" maxlength="50"  tabindex="1" value="" onFocus="blank(this)" onBlur="unblank(this)" class="hbo_subscribe_input"/>
                                    </div>
                                    <div class="column span_1_of_15">&nbsp;</div>
                                    <div class="column span_7_of_15">
                                        <!--p class="less_spacing">Email *</p-->
                                        <input type="text" id="txtEmail" placeholder="Email"  name="txtEmail" maxlength="255"   value="" onFocus="blank(this)" onBlur="unblank(this)" class="hbo_subscribe_input" v  />
                                    </div>

                                </div>
                                <div class="span_15_of_15 column newsletter_highlight_box_content">
                                    <div class="column span_7_of_15">
                                        <!--p class="less_spacing special_font">Comment *</p-->
                                        <textarea style="width:330px;height:100px;" placeholder="Comment" name="txtCmnt" id="txtCmnt" onFocus="blank(this)" onBlur="unblank(this)"></textarea>
                                    </div>
                                    <div class="column span_1_of_15">&nbsp;</div>
                                    <div class="column span_7_of_15">
                                        <div id="talktous_city" class="column span_15_of_15 newsletter_error_msg_hide">Please indicate your city:</div>
                                        <!--p class="less_spacing special_font">City</p-->
                                        <input type="text" id="txtCity"  name="txtCity" placeholder="City" maxlength="50" value="" onFocus="blank(this)" onBlur="unblank(this)"  class="hbo_subscribe_input" />
                                    </div>

                                    <div class="column span_1_of_15">&nbsp;</div>

                                </div>
                                <div class="span_15_of_15 column newsletter_highlight_box_content"> 
                                        <div id="talktous_city" class="column span_15_of_15 newsletter_error_msg_hide">Please indicate your city:</div>
                                        <p class="less_spacing special_font space-mb">&nbsp;</p>                    
                                        <div> 
                                                <input type="submit" value="Submit" name="btnSubmit" id="btnSubmit" class="hboSubmit btn-ui"/>
                                        </div>



                                </div>
                            </div></div>
                        </div>            
                    </div>
                </div>
            </form>
            <div style="height:50px;"></div>

        </div>
        <?php include("footerlink.php"); ?>  
        <?php include("copyright.php"); ?> 
    </div>
    <?php include("footeranalytics.php"); ?>
</body>
</html>
