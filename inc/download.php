<?php 
if (isset($_GET['vdata'])) 
{ 
	$file = base64_decode($_GET['vdata']);
	header("Content-disposition: attachment; filename="."ytseotools.mp4");
	header("Content-type: application/mp4");
	readfile($file);
	exit;
}

if (isset($_GET['mpdata'])) 
{
	$file = base64_decode($_GET['mpdata']);
	header("Content-disposition: attachment; filename="."yt-mp3.mp3");
	header("Content-type: application/mp3");
	readfile($file);
	exit;
}

if (isset($_GET['at'])) 
{
	$file = urldecode($_GET['at']);
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.'animted-thumbnail.gif');
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: public'); //for i.e.
	header('Pragma: public');

	ob_clean();
	flush();
	readfile($file);
	exit;
}

if (isset($_GET['t'])) 
{
	$file = $_GET['t'];

	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($file));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: public'); //for i.e.
	header('Pragma: public');

	ob_clean();
	flush();
	readfile($file);
	exit;
}
 ?>