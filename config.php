<?php

error_reporting(0);

session_start();

$cookie_name = 'MyHboSouthAsiaCookie';
$cookie_time = 3600 * 24 * 15; // 15 days

$site = 'http://apps.ombuzz13.com/hbosouthasia';

$countrysession = 'Asia/Calcutta';
if (isset($_COOKIE[$cookie_name])) {
    $user_creds = base64_decode($_COOKIE[$cookie_name]);
    $countrysession = $user_creds;
}
ini_set("date.timezone", "$countrysession");

include("dbconfig.php");

$sql_date = "select * from a_territories where IniSet='" . $countrysession . "' and Status=1";
$res_date = mysql_query($sql_date);
if (mysql_num_rows($res_date) > 0) {
    $row_date = mysql_fetch_array($res_date);
    $_SESSION[diffmin] = $row_date['DiffMin'];
    $_SESSION[TerritoryName] = $row_date['Name'];
    $_SESSION[AddSub] = $row_date['AddSub'];
    ;
}

header('Cache-control: private'); // IE 6 FIX
// always modified 
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
// HTTP/1.1 
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
// HTTP/1.0 
header('Pragma: no-cache');

include("include/commonfunctions.php");
// ---------- LOGIN INFO ---------- //

if ($_SERVER['PHP_SELF'] == "/contact-us.php") {
    $pagetitle = "HBO India - Hollywood Movies TV Channel. Contact us @hbosa@hboasia.com";
    $pagedescription = "Welcome to HBO South Asia - Your Home of Blockbuster Hollywood Movies Channel. Contact Us on hbosa@hboasia.com.";
} else if ($_SERVER['PHP_SELF'] == "/faq.php") {
    $pagetitle = "HBO Southasia FAQ's - Hollywood Movies HD Channel";
    $pagedescription = "Welcome to HBO South Asia - HBO is a 24-hour, HD Quality premium movie channel that offers the best of Hollywood Films";
} else if ($_SERVER['PHP_SELF'] == "/hbo.php") {
    $pagetitle = "24/7 HD Movies channel- HBO Southasia";
    $pagedescription = "Enjoy Best & High quality 24 hours english movie channel in India, Bangladesh, Maldives and Pakistan";
} else if ($_SERVER['PHP_SELF'] == "/milestones.php") {
    $pagetitle = "HBO Southasia- English Television Channels in India | Milestones";
    $pagedescription = "Incepted in the year 1992 as HBO Asia, in 2000 service of HBO India launched in Bangladesh, India, Pakistan and Maldives.";
} else if ($_SERVER['PHP_SELF'] == "/privacy-policy.php") {
    $pagetitle = "Privacy Policy of HBO Southasia - English Movie Timings.";
    $pagedescription = "HBO Southasia protects your personal Data from unauthorize parties. Enjoy blockbuster movie premieres.";
} else if ($_SERVER['PHP_SELF'] == "/search.php") {
    $pagetitle = "HBO South Asia, Its Not TV, Its HBO - English Movie Channel India, Pakistan, Bangladesh, Maldives";
    $pagedescription = "Search your queries on hbosouthasia and enjoy blockbuster and latest english films on tv with your loved ones.";
} else if ($_SERVER['PHP_SELF'] == "/talktous.php") {
    $pagetitle = "HBO Southasia - Talk to Us - Hollywood Movies tv Channel";
    $pagedescription = "You can Talk to  HBOSouthasia through email or a form. We usually revert back as soon as possible. Get in touch today!";
} else if ($_SERVER['PHP_SELF'] == "/term-of-use.php") {
    $pagetitle = "Read Terms and Conditions - HBO Southasia";
    $pagedescription = "Kindly Read Terms and Conditions of HBOSouthasia and enjoy uninterrupted english movies in india.";
} else if ($_SERVER['PHP_SELF'] == "/territories.php") {
    $pagetitle = "HBO South Asia, Its Not TV, Its HBO - English Movie Channel India, Pakistan, Bangladesh, Maldives";
    $pagedescription = "It's HBO, It's not TV. HBO brings the best of Hollywood by premiering top blockbuster movies in India, Bangladesh, Pakistan and Maldives";
} else {
    $pagetitle = "HBO South Asia, Its Not TV, Its HBO - English Movie Channel India, Pakistan, Bangladesh, Maldives";
    $pagedescription = "Welcome to HBO South Asia - Your Home of Blockbuster Hollywood Movies. Experience the difference every time you tune in to the English movie channel from India, Bangladesh, Maldives or Pakistan. It's not TV, It's HBO.";
}
$pagekeywordsack = "hbo south asia, english movie channel india, bangladesh, maldives, pakistan, blockbuster english movies, hollywood movies";
?>