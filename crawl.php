<?php
set_time_limit(0);
$archived = [];

function download_annotations($id)
{
	global $archived;
	
	if(empty($archived[$id]))
	{
		exec("start /b youtube-dl/youtube-dl.exe --config-location youtube-dl https://www.youtube.com/watch?v=$id", $output, $return);
		$downloaded = find_file($id, $output);
		if(empty($downloaded))
		{
			return;
		}
		
		$archived[$id] = $downloaded;
		
		$annotation = htmlspecialchars_decode(file_get_contents($downloaded), ENT_NOQUOTES);
		preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $annotation, $match);
		
		$videos = [];

		foreach($match[0] as $url)
		{
			$video = explode("?", $url);
			$v = explode("&v=", $video[1]);
			$time = explode("#", $v[1]);
			
			if(empty($time[0]) == false)
			{
				download_annotations($time[0]);
			}
		}
	}
}

function find_file($id, $output)
{
	foreach($output as $line)
	{
		if(substr($line, 0, 37) == "[info] Writing video annotations to: ")
		{
			//Doesn't play well with UTF-8 file names, so this will just skip them
			if(file_exists(substr($line, 37)))
			{
				return substr($line, 37);
			}
		}
	}

	//Fall back on iterating through Videos directory for the XML that was just downloaded
	$iterator = new RecursiveDirectoryIterator("Videos");

	foreach(new RecursiveIteratorIterator($iterator) as $file)
	{
		if(in_array(pathinfo($file)["extension"], ["xml"]) && strpos($file, $id))
		{
			return $file;
		}
	}
}

if(isset($_GET["v"]) && empty($_GET["v"] == false))
{
	$id = urldecode($_GET["v"]);
	download_annotations($id);
	$output = "<br>Downloaded " . count($archived) . " files:<br>" . implode("<br>", $archived);
}
?>
<!DOCTYPE html>
<html>
	<body>
		<form action = "<?php echo basename(__FILE__); ?>" method = "GET">
			Video ID: <input type = "text" name = "v" />
			<input type = "submit" value = "Grab annotations" />
		</form>
		<?php echo $output; ?>
	</body>
</html>