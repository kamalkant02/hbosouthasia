<?php 
ini_set('max_execution_time', 300); 
date_default_timezone_set("Asia/Calcutta");
function createFilename($title, $sep = "_") {
	$titleArr = explode(chr(32), trim($title));
	$array = range("A", "Z"); //array("a", "b", "c", "d", "e", "f", "g", "h", "i"); //array_merge(range("a", "z"), range("A", "Z"), range(0, 9));
	$array = array_merge($array, range("a", "z"));
	$array = array_merge($array, range(0,9));
	$newArr = array();
	foreach($titleArr as $no => $val) {
		$newWord = "";
		$val = trim($val);
		if(!is_numeric($val)) {
			for($ii=0; $ii < strlen($val); $ii++) {
				$char = substr($val, $ii, 1);
				if(in_array($char, $array)) {
					$newWord .= $char;
				}
			}
			if(!empty($newWord)) $newArr[] = strtolower($newWord);
		}
		else {
			$newArr[(sizeof($newArr) - 1)] = end($newArr).$val;
		}
	}
	return implode($sep, $newArr).".png";
}
/*
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
*/

function my_search($haystack) {
	global $needle;
    return(stripos($haystack, $needle)); // or stripos() if you want case-insensitive searching.
}

$msg = "";


//print $pat_array[0][0]." <br> ".$pat_array[0][1]."\n";\

//echo '<pre>'; 
//print_r($matches);
//print_r($filesArr);

/*If FOrm has been submitted then */
if($_SERVER['REQUEST_METHOD'] == "POST") {
	//Check if a file has been selected
	
	$con = mysql_connect("mysql.apps.ombuzz13.com", "newhbosausr1", "Asia@2015!#RC4") or die('Could not connect: ' . mysql_error());
	
	// Select Database
	mysql_select_db("hbosanewdb", $con) or die('Could not connect: ' . mysql_error());
	
	if(isset($_FILES['hbo']) && !empty($_FILES['hbo'])) {
		//check if selected file is excel (xls)
		$pathinfo = pathinfo($_FILES['hbo']['name']);
		if(strtolower($pathinfo['extension']) == "xls") {
			
			//include mandatory files for reading the excel
			require_once 'Excel/reader.php';

			// ExcelFile($filename, $encoding);
			$data = new Spreadsheet_Excel_Reader();			
			
			// Set output Encoding.
			$data->setOutputEncoding('CP1251');
			
			$data->read($_FILES['hbo']['tmp_name']);
			
			$table = '<table width="100%" border="1" cellspacing="0" cellpadding="4">';
			$table .= '<tr>';
			$table .= '<th>MovieID</th>	<th>SeriesID</th>	<th>Title</th>	<th>AiringDateTime</th>	<th>Starring</th>	<th>DirectedBy</th>	<th>ProductionYears</th> <th>Genre</th> <th>Duration</th>	<th>Synopsis</th>	<th>FilePath</th>	<th>FilePathBig</th>	<th>ImgSrcWidget</th>	<th>BlockBuster</th>	<th>Originals</th>	<th>Soap</th>	<th>HomeCarouselPath</th>	<th>VideoPath</th>	<th>IsHighlight</th>	<th>promospot</th>	<th>seeitfirstsunday</th>	<th>Upcoming</th>	<th>TwitterText</th>	<th>Background</th>	<th>AddDate</th>	<th>EditDate</th>	<th>Status</th>';
			$table .= '</tr>';
			
			//$filesArr = ListFiles($_SERVER['DOCUMENT_ROOT'].'/uploads'); // All Filenames existing in THUMBS Folder
			
			
			for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
				$table .= '<tr>';
				
				//HBO Excel Values---
				$date =  isset($data->sheets[0]['cells'][$i][1]) ? strtoupper($data->sheets[0]['cells'][$i][1]) : "&nbsp;"; //echo "<br />";
				$dateArr = explode("/", $date);
				//echo '<pre>'; print_r($dateArr);
				
				$finishdate =  isset($data->sheets[0]['cells'][$i][4]) ? strtoupper($data->sheets[0]['cells'][$i][4]) : "&nbsp;";
				$finishdateArr = explode("/", $finishdate);
				
				$time = isset($data->sheets[0]['cells'][$i][2]) ? strtoupper(stripslashes($data->sheets[0]['cells'][$i][2])) : "&nbsp;";
				$endtime = isset($data->sheets[0]['cells'][$i][5]) ? strtoupper(stripslashes($data->sheets[0]['cells'][$i][5])) : "&nbsp;";
				
				//$timeArr = explode(" ", $time);
				$hrMin = explode(":", $time);
				$hr = $hrMin[0];
			    $minutes = $hrMin[1]; //echo "<br />";
			
				
				$endhrMin = explode(":", $endtime);
				$endhr = $endhrMin[0];
			    $endminutes = $endhrMin[1];
				
				//echo $dateTime = $dateArr[2]."-".$dateArr[1]."-".$dateArr[0]." ".$time; echo "<br />";
				$dateTime = mktime($hr, $minutes, 0, $dateArr[1], $dateArr[0], $dateArr[2]);
				$formattedDate = date("Y-m-d H:i:s", $dateTime);
				
				$enddateTime = mktime($endhr, $endminutes, 0, $finishdateArr[1], $finishdateArr[0], $finishdateArr[2]);
				$endformattedDate = date("Y-m-d H:i:s", $enddateTime);
				
				
				$startTime = strtotime($formattedDate);
				$finishTime = strtotime($endformattedDate);
				
				$slotDuration = $finishTime - $startTime;
				
				$slotName = isset($data->sheets[0]['cells'][$i][3]) ? stripslashes($data->sheets[0]['cells'][$i][3]) : "&nbsp;";
				
				$sql = "SELECT * FROM b_movies WHERE Title = '".addslashes($slotName)."' ORDER BY MovieID DESC LIMIT 0,1";
				$res = mysql_query($sql);
				
				$movdata = mysql_fetch_array($res);
				
				//Our Excel Vars---
				if(!empty($movdata)) {
					$movieID = "";
					$seriesID = "0";
					$title = ucwords($slotName);
					$airingDateTime = $formattedDate;
					$starring = $movdata['Starring'];
					$directedBy = $movdata['DirectedBy'];
					$productionYears = $movdata['ProductionYears'];
					$genre = $movdata['Genre'];
					$duration = $slotDuration;
					$synopsis = $movdata['Synopsis'];
					$filepath = $movdata['FilePath'];
					$filepathbig = $movdata['FilePathBig'];
					$imgSrcWidget = NULL;
					$blockBuster = "0";
					$originals = "0";
					$soap = "0";
					$homeCarouselPath = "";
					$videoPath = "";
					$isHighlight = "0";
					$promospot = "0";
					$seeitfirstsunday = "0";
					$upcoming = "0";
					$twitterText = "";
					$background = "";
					$addDate = "0000-00-00  00:00:00";
					$editDate = "0000-00-00  00:00:00";
					$status = "1";
				}
				else {
					$movieID = "";
					$seriesID = "0";
					$title = ucwords($slotName);
					$airingDateTime = $formattedDate;
					$starring = "";
					$directedBy = "";
					$productionYears = "";
					$genre = "";
					$duration = $slotDuration;
					$synopsis = "";
					$filepath = "";
					$filepathbig = "";
					$imgSrcWidget = NULL;
					$blockBuster = "0";
					$originals = "0";
					$soap = "0";
					$homeCarouselPath = "";
					$videoPath = "";
					$isHighlight = "0";
					$promospot = "0";
					$seeitfirstsunday = "0";
					$upcoming = "0";
					$twitterText = "";
					$background = "";
					$addDate = "0000-00-00  00:00:00";
					$editDate = "0000-00-00  00:00:00";
					$status = "1";
				}
			
				$table .= '<td>'.$movieID.'</td>
							<td>'.$seriesID.'</td>
							<td>'.ucwords(strtolower($title)).'</td>
							<td>'.(string)$airingDateTime.'</td>
							<td>'.ucwords(strtolower($starring)).'</td>
							<td>'.ucwords(strtolower($directedBy)).'</td>
							<td>'.$productionYears.'</td>
							<td>'.ucwords(strtolower($genre)).'</td>
							<td>'.$duration.'</td>
							<td>'.$synopsis.'</td>
							<td>'.$filepath.'</td>
							<td>'.$filepathbig.'</td>
							<td>'.$imgSrcWidget.'</td>
							<td>'.$blockBuster.'</td>
							<td>'.$originals.'</td>
							<td>'.$soap.'</td>
							<td>'.$homeCarouselPath.'</td>
							<td>'.$videoPath.'</td>
							<td>'.$isHighlight.'</td>
							<td>'.$promospot.'</td>
							<td>'.$seeitfirstsunday.'</td>
							<td>'.$upcoming.'</td>
							<td>'.$twitterText.'</td>
							<td>'.$background.'</td>
							<td>'.$addDate.'</td>
							<td>'.$editDate.'</td>
							<td>'.$status.'</td>';
				
				$table .= '</tr>';
			}
			//echo $table;
			//print_r($movdata);
			
			//exit();
			
			//List of all Pics---
			/*$table .= '<tr><td colspan="27"><strong>LIST OF ALL PICS</strong></td></tr>';
			foreach($filesArr as $fno => $fname) {
				$table .= '<tr><td colspan="27">'.$fname.'</td></tr>';
			}*/

			$table .= '</table>';
			$filename="hbosa.xls";
			header("Content-Type: application/ms-excel");
			header("Content-Disposition: attachment; filename=$filename");
			header("Pragma: no-cache");
			header("Expires: 0");
			echo $table;
			exit();
		}
		else {
			$msg = "Please select XLS file only.";
		}
	}
	
mysql_close($con);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Excel</title>
</head>
<body>
<h1>Create Excel</h1>
<form action="" method="post" enctype="multipart/form-data" name="frm">
  <table width="500" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="40%"><strong>Select HBO Excel:</strong></td>
      <td><input type="file" name="hbo" id="hbo" value="" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="cmd" id="cmd" border="Submit" /></td>
    </tr>
  </table>
</form>
</body>
</html>