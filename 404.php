<?php
// Permanent redirection
//header("HTTP/1.1 301 Moved Permanently");
header("HTTP/1.0 404 Not Found");
header("Location: http://www.hbosouthasia.com/error.php");
exit();
?>