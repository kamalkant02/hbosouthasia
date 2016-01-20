<?php
include("config.php");
$datestring = date("jS", strtotime($_GET['weekdate'])) . ', ' . date("jS", strtotime($_GET['weekdate'] . "+ 1 day")) . ' & ' . date("jS F Y", strtotime($_GET['weekdate'] . "+ 2 day"));
?>
<html><head>
        <title>HBO South Asia Schedule - <?php echo $datestring; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="stylesheet" href="assets/css/responsive.css"/>
    </head>

    <body>



        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Welcome to HBO South Asia</title>
        <style type="text/css">
            body {font: 12px Arial; color: black}
        </style>

        <?php
        $name = 'Guest';
        $sqlname = "select * from f_newsletter where userEmail='" . $_GET['email'] . "'";
        $resname = mysql_query($sqlname);
        if (mysql_num_rows($resname) > 0) {
            $rowname = mysql_fetch_array($resname);
            $name = $rowname['userName'];
        }
        ?>

        <table width="580" border="0" cellpadding="0" cellspacing="0">
            <tbody><tr valign="top">
                    <td><font face="Arial, Helvetica, sans-serif" size="2">Subject:- See what's on HBO on <?php echo $datestring; ?><br><br>Hi,<br>
                        <br>
                        Here's what to look out for on HBO during the next 3 days!<br>
                        </font>
                        <p>
                            <strong>HBO South Asia Schedule – <?php echo $datestring; ?></strong>
                            <font face="Arial, Helvetica, sans-serif" size="2"><br>
                            </font>
                        </p>
                        <?php
                        $sql1 = "select * from b_movies where DATE(AiringDateTime) ='" . $_GET['weekdate'] . "' AND Status=1 ORDER BY AiringDateTime ASC";
                        $res1 = mysql_query($sql1);
                        if (mysql_num_rows($res1) > 0) {
                            ?>                   
                            <table width="580" border="0" cellpadding="1" cellspacing="0">
                                <tbody><tr valign="top">
                                        <td colspan="3"><font face="Arial, Helvetica, sans-serif" size="2"><strong><u><?php echo date("l, jS F Y", strtotime($_GET['weekdate'])) ?></u></strong></font></td>
                                    </tr>            
                                    <?php
                                    while ($row1 = mysql_fetch_array($res1)) {
                                        ?>
                                        <tr valign="top">
                                            <td width="65" align="right"><font face="Arial, Helvetica, sans-serif" size="2"><?php echo DateFormatAMPM($row1['AiringDateTime']) ?></font></td>
                                            <td><font face="Arial, Helvetica, sans-serif" size="2">-</font></td>
                                            <td width="600"><a href="<?php echo getmoviename($row1['Title'], $row1['MovieID']) ?>" target="_blank"><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $row1['Title'] ?></font></a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody></table>
                        <?php } ?>
                        <br>
                        <?php
                        $sql1 = "select * from b_movies where DATE(AiringDateTime) ='" . date('Y-m-d', strtotime($_GET['weekdate'] . "+ 1 day")) . "' AND Status=1 ORDER BY AiringDateTime ASC";
                        $res1 = mysql_query($sql1);
                        if (mysql_num_rows($res1) > 0) {
                            ?>                   
                            <table width="580" border="0" cellpadding="1" cellspacing="0">
                                <tbody><tr valign="top">
                                        <td colspan="3"><font face="Arial, Helvetica, sans-serif" size="2"><strong><u><?php echo date("l, jS F Y", strtotime($_GET['weekdate'] . "+ 1 day")) ?></u></strong></font></td>
                                    </tr>            
                                    <?php
                                    while ($row1 = mysql_fetch_array($res1)) {
                                        ?>
                                        <tr valign="top">
                                            <td width="65" align="right"><font face="Arial, Helvetica, sans-serif" size="2"><?php echo DateFormatAMPM($row1['AiringDateTime']) ?></font></td>
                                            <td><font face="Arial, Helvetica, sans-serif" size="2">-</font></td>
                                            <td width="600"><a href="<?php echo getmoviename($row1['Title'], $row1['MovieID']) ?>" target="_blank"><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $row1['Title'] ?></font></a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody></table>
                        <?php } ?>
                        <br>
                        <?php
                        $sql1 = "select * from b_movies where DATE(AiringDateTime) ='" . date('Y-m-d', strtotime($_GET['weekdate'] . "+ 2 day")) . "' AND Status=1 ORDER BY AiringDateTime ASC";
                        $res1 = mysql_query($sql1);
                        if (mysql_num_rows($res1) > 0) {
                            ?>                   
                            <table width="580" border="0" cellpadding="1" cellspacing="0">
                                <tbody><tr valign="top">
                                        <td colspan="3"><font face="Arial, Helvetica, sans-serif" size="2"><strong><u><?php echo date("l, jS F Y", strtotime($_GET['weekdate'] . "+ 2 day")) ?></u></strong></font></td>
                                    </tr>            
                                    <?php
                                    while ($row1 = mysql_fetch_array($res1)) {
                                        ?>
                                        <tr valign="top">
                                            <td width="65" align="right"><font face="Arial, Helvetica, sans-serif" size="2"><?php echo DateFormatAMPM($row1['AiringDateTime']) ?></font></td>
                                            <td><font face="Arial, Helvetica, sans-serif" size="2">-</font></td>
                                            <td width="600"><a href="<?php echo getmoviename($row1['Title'], $row1['MovieID']) ?>" target="_blank"><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $row1['Title'] ?></font></a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody></table>
                        <?php } ?>
                        <br>
                    </td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr valign="top">
                    <td>
                        <p><font face="Arial, Helvetica, sans-serif" size="2">Schedule subject to changes, please log on to <a href="http://www.hbosouthasia.com/" target="_blank">http://www.hbosouthasia.com/</a> for updated schedules.</font><br></p>

                        <p><font face="Arial, Helvetica, sans-serif" size="1" color="#333333">©  2011 HBO Asia. All Rights Reserved.<br>
                            Home Box Office®, HBO® and Cinemax® are registered  trademarks of Home Box Office, Inc.<br>
                            All other names and marks are the property of their respective  owners. All Rights Reserved.</font></p></td>
                </tr>
            </tbody></table>
        <p><br>
            To Unsubscribe from this mailing list, <a href="mailto:info@hboindia.co.in?subject=Unsubscribe from 3 days schedule">Click Here</a>.
        </p>
    <?php include("footeranalytics.php"); ?>
	</body>
</html>