<?php
session_start();
$arr_img = $arr = array();

if(isset($_REQUEST['lside']))
{
	if(isset($_SESSION['arr_img'])){
		$arr_img = $_SESSION['arr_img'];
	};
	$arr['tside'] = $_REQUEST['tside'];
	$arr['lside'] = $_REQUEST['lside'];
	$arr['width'] = $_REQUEST['width'];
	$arr['height'] = $_REQUEST['height'];
	$arr_img[] = $arr;
	$_SESSION['arr_img'] = $arr_img;
	header('location: view.php');
}

if(isset($_REQUEST['delete']))
{
	$arr_img = $_SESSION['arr_img'];
	unset($arr_img[$_REQUEST['delete']]);
	$_SESSION['arr_img'] = array_values($arr_img);
	header('location: view.php');
}

header('Content-Type: image/jpeg'); 
$img_create = imagecreatefromjpeg($_SESSION['filepath']);
$color = ImageColorallocate($img_create, 128, 0, 0);
$arr_img = $_SESSION['arr_img'];
for($i = 0; $i < sizeof($_SESSION['arr_img']) ; $i++ )
{
	ImageFilledRectangle($img_create,$arr_img[$i]['lside'],$arr_img[$i]['tside'],$arr_img[$i]['lside'] + $arr_img[$i]['width'],$arr_img[$i]['tside'] + $arr_img[$i]['height'],$color);
}
$_SESSION['newpath'] = 'myimg/download'.date('ih').".jpg";
ImageJPEG($img_create, $_SESSION['newpath']); 
imagedestroy($img_create);
