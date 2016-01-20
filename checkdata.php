<?php 
date_default_timezone_set("Asia/Calcutta");

function ListFiles($dir) {

    if($dh = opendir($dir)) {

        $files = Array();
        $inner_files = Array();

        while($file = readdir($dh)) {
            if($file != "." && $file != ".." && $file[0] != '.') {
                if(is_dir($dir . "/" . $file)) {
                    $inner_files = ListFiles($dir . "/" . $file);
                    if(is_array($inner_files)) $files = array_merge($files, $inner_files); 
                } else {
                    array_push($files, $dir . "/" . $file);
                }
            }
        }

        closedir($dh);
        return $files;
    }
}

function my_search($haystack) {
	global $needle;
    return(stripos($haystack, $needle)); // or stripos() if you want case-insensitive searching.
}

		
			$filesArr = ListFiles($_SERVER['DOCUMENT_ROOT'].'/uploads'); // All Filenames existing in THUMBS Folder
			
		
echo "<pre>";	
print_r($filesArr);
echo "</pre>";	
?>
