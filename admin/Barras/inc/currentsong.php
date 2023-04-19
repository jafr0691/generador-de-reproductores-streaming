<?php
/* ----------- Server configuration ---------- */
$I = "$IP";
$P = "$BPuerto";

/* ----- No need to edit below this line ----- */
/* ------------------------------------------- */

$fp = @fsockopen($I,$P,$errno,$errstr,1);
if (!$fp) 
	{ 
	echo 'RADIO APAGADA'; // Displays when sever is offline
	} 
	else
	{ 
	fputs($fp, "GET /7.html HTTP/1.0\r\nUser-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.2) Gecko/20070219 Firefox/2.0.0.2\r\n\r\n");
	while (!feof($fp)) 
		{
		$info = fgets($fp);
		}
	$info = str_replace("</body></html>", "", $info);
	$split = explode(",", $info);
	if (empty($split[6]) )
		{
		echo 'en línea pero sin título de canción'; // Displays when sever is online but no song title
		}
	else
		{
		$title = str_replace("\"", "`", $split[6]);
		$title = str_replace(",", " ", $title);
echo '{"isMobile":false,"streamingStatus":1,"streamingType":"audio\/mpeg","currentTrack":"';echo "$title";echo '"}'; // Displays song
		}
	}
?>
