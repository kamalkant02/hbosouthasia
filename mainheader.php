<!DOCTYPE html>
<html lang="en" class="wf-proximanova-n4-inactive wf-proximanova-n6-inactive wf-proximanovacondensed-i6-inactive wf-proximanovacondensed-n3-inactive wf-proximanovacondensed-n4-inactive wf-inactive">
    <head>
        <link href="//use.typekit.net" rel="dns-prefetch">
        <link href="//ajax.googleapis.com" rel="dns-prefetch">
        <link href="//s3-ap-southeast-1.amazonaws.com" rel="dns-prefetch">
        <link href="//releases.flowplayer.org" rel="dns-prefetch">
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="canonical" href="<?php
        if ($_SERVER['PHP_SELF'] == "/index.php") {
            echo "http://www.hbosouthasia.com";
        } elseif($movieurl!=''){
			echo "http://www.hbosouthasia.com/" . $movieurl;			
		} else {
            echo "http://www.hbosouthasia.com" .  $_SERVER['PHP_SELF'];
        }
        ?>" />
        <meta charset="utf-8" content="text/html" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title><?php echo $pagetitle; ?></title>
        <meta name="description" content="<?php echo $pagedescription; ?>" />
        <?php if (!empty($pagekeywordsack)) { ?>
            <meta name="keywords" content="<?php echo $pagekeywordsack; ?>" />
<?php } ?>
        <meta content="HBO Asia" name="author">
        <meta content="index, follow" name="robots">
        <meta content="HBO Asia" property="og:title">
        <meta content="assets/img/fb-hbo-480x320.jpg" property="og:image">
        <meta content="HBO Asia" property="og:site_name">
        <meta content="" property="og:description">
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/themes/smoothness/jquery-ui.css" type="text/css">
        <link href="//releases.flowplayer.org/5.4.3/skin/minimalist.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/normalize.css">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="assets/css/styles-hbo.css">
        <script src="assets/js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="//use.typekit.net/pop6qev.js" type="text/javascript"></script>        
        <script src="assets/js/jquery-migrate-1.1.1.min.js" type="text/javascript"></script>
        <style type="text/css">
            .tk-proxima-nova-condensed{font-family:"proxima-nova-condensed",sans-serif;}.tk-proxima-nova{font-family:"proxima-nova",sans-serif;}
        </style>
        <link rel="stylesheet" href="http://use.typekit.net/c/e04417/proxima-nova:n4:n6,proxima-nova-condensed:i6:n3:n4.W0V:N:2,W0X:N:2,SCd:N:2,SCX:N:2,SCZ:N:2/d?3bb2a6e53c9684ffdc9a9bf21c5b2a620701c6661cd66453615bc1e876c78b743eeb6de419ce549fa7bb3512c8ffce4c4b18ea6c1a89b4ce88d338329554af79dab4fa779636100676db1d11113e20ab8884db654ff9a6aff8691c71d917dac78a6287d39928352200a8d3ceb411b69c2a8297b1362b8f31527416ba9bf2fd2ee7d823253df6e1b5386c56bff13d771df58e">
        <script type="text/javascript">try {
                Typekit.load();
            } catch (e) {
            }</script>       
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script src="//releases.flowplayer.org/5.4.3/commercial/flowplayer.min.js" type="text/javascript"></script>
        <script src="assets/js/video-player.js" type="text/javascript"></script>
        <script src="assets/js/handlebars.js" type="text/javascript"></script>
        <script src="assets/js/commons.js" type="text/javascript"></script>
        <?php include("googleanalytics.php"); ?>
    </head>