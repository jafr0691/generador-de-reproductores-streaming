<?php
/* ----------- Server configuration ---------- */
$I = "$IP";
$P = "$CPuerto";
// This is an example PHP code to call the JSON API.

// Available Data Output
// Now Playing Song Title
// Now Playing Song Album Image URL (High Quality)
// Online Listeners
// Unique Listeners
// Bitrate
// DJ Username if there is a DJ live streaming
// DJ Profile Picture if there is a DJ live streaming
// Last played 5 songs

	$url = "https://$IP/cp/get_info.php?p=$CPuerto";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	$return_json = curl_exec($ch);

	$obj = json_decode($return_json);
	$nowplaying = $obj->{'title'};
	$image = $obj->{'art'};
	$unique_listeners = $obj->{'ulistener'};
	$online_listeners = $obj->{'listeners'};
	$bitrate = $obj->{'bitrate'};
	$djusername = $obj->{'djusername'};
	$djprofile = $obj->{'djprofile'};
	$played_last20 = $obj->{'history'};

//	foreach($played_last20 as $tracks)
//	{
//	echo $tracks; // Prints played last 20 tracks.
//	}

	echo '{"isMobile":false,"streamingStatus":1,"streamingType":"audio\/mpeg","currentTrack":"';echo "$nowplaying";echo '"}';

//	echo "<img src='$image'>";


// Any data provided on this page can be used as you like.
 ?>