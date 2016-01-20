<?php
include("config.php");
$datestring = date("jS", strtotime($_GET['weekdate'])) . ' & ' . date("jS F Y", strtotime($_GET['weekdate'] . "+ 1 day"));
?>
<html><head>
        <title>HBO South Asia Schedule - <?php echo $datestring; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="robots" content="noindex,nofollow">
    </head>

    <body>       
        <table border="0" cellpadding="0" cellspacing="0" width="90%" align="center">
            <tr valign="top">
                <td>
                    <p>
                        <span style="float:left;"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?weekdate=<?php echo date("Y-m-d", strtotime($_GET['weekdate'] . "- 2 day")) ?>"><<-Previous</a></span>
                        <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HBO South Asia Schedule – <?php echo $datestring; ?></strong>
                        <span style="float:right;"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?weekdate=<?php echo date("Y-m-d", strtotime($_GET['weekdate'] . "+ 2 day")) ?>">Next->></a></span>
                        <font face="Arial, Helvetica, sans-serif" size="2"><br>
                        </font>
                    </p>
                    <?php
                    $sql1 = "select * from b_movies where DATE(AiringDateTime) ='" . $_GET['weekdate'] . "' AND Status=1 ORDER BY AiringDateTime ASC";
                    $res1 = mysql_query($sql1);
                    if (mysql_num_rows($res1) > 0) {
                        ?>                   
                        <table width="100%" border="0" cellpadding="3" cellspacing="3">                               
                            <tr valign="top">
                                <td colspan="3">
                                    <h2><font face="Arial, Helvetica, sans-serif" ><strong><u><?php echo date("l, jS F Y", strtotime($_GET['weekdate'])) ?></u></strong></font></h2>
                                </td>
                            </tr>            
                            <?php
                            while ($row1 = mysql_fetch_array($res1)) {
                                ?>
                                <tr valign="top" bgcolor="#f2f2f2">
                                    <td width="15%" align="right">
                                        <font face="Arial, Helvetica, sans-serif" size="2"><?php echo DateFormatAMPM($row1['AiringDateTime']) ?></font>
                                    </td>
                                    <td><font face="Arial, Helvetica, sans-serif" size="2">-</font></td>
                                    <td width="30%">
                                        <a href="http://hbosouthasia.com/qa-moviepreview.php?id=<?php echo $row1['MovieID'] ?>" target="_blank"><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $row1['Title'] ?></font></a>
                                    </td>
                                    <td width="45%">
                                        http://hbosouthasia.com/movie-<?php echo strtolower(preg_replace('![^a-z0-9]+!i', '-', $row1['Title'])); ?>-<?php echo $row1['MovieID']; ?>.php
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                        </table>
                    <?php } ?>
                    <br>
                    <?php
                    $sql1 = "select * from b_movies where DATE(AiringDateTime) ='" . date('Y-m-d', strtotime($_GET['weekdate'] . "+ 1 day")) . "' AND Status=1 ORDER BY AiringDateTime ASC";
                    $res1 = mysql_query($sql1);
                    if (mysql_num_rows($res1) > 0) {
                        ?>                   
                        <table width="100%" border="0" cellpadding="3" cellspacing="3">
                            <tr valign="top">
                                <td colspan="4">
                                    <h2>
                                        <font face="Arial, Helvetica, sans-serif">
                                        <strong>
                                            <u>
                                                <?php echo date("l, jS F Y", strtotime($_GET['weekdate'] . "+ 1 day")) ?>
                                            </u>
                                        </strong>
                                        </font>
                                    </h2>
                                </td>

                            </tr>            
                            <?php
                            while ($row1 = mysql_fetch_array($res1)) {
                                ?>
                                <tr valign="top" bgcolor="#f2f2f2">
                                    <td width="15%" align="right">
                                        <font face="Arial, Helvetica, sans-serif" size="2"><?php echo DateFormatAMPM($row1['AiringDateTime']) ?></font>
                                    </td>
                                    <td><font face="Arial, Helvetica, sans-serif" size="2">-</font></td>
                                    <td width="30%">
                                        <a href=" http://hbosouthasia.com/qa-moviepreview.php?id=<?php echo $row1['MovieID'] ?>" target="_blank"><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $row1['Title'] ?></font></a>
                                    </td>
                                    <td width="45%">
                                        http://hbosouthasia.com/movie-<?php echo strtolower(preg_replace('![^a-z0-9]+!i', '-', $row1['Title'])); ?>-<?php echo $row1['MovieID']; ?>.php
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                        </table>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>

        </table>       
    </body>
</html>