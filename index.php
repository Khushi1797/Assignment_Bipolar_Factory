<?php
session_start();
	if(isset($_REQUEST['reset']))
	{
		session_destroy();
		header('location:index.php');
	}
	if(isset($_FILES['image_file']))
	{
		$allowedImageType = array("image/jpg", "image/JPG"  , "image/jpeg",   "image/png");	
		if ($_FILES['image_file']["error"] > 0) {
			$output['error']= "File Error";
		}
		elseif (!in_array($_FILES['image_file']["type"], $allowedImageType)) {
			$output['error']= "Invalid image format";
		}
		else {
			$filetmp = $_FILES['image_file']['tmp_name'];
			$fileName = $_FILES['image_file']['name'];
			$imgtype = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));			
			$targetFilePath = "myimg/imgs/";			
			if (!file_exists($targetFilePath)) {
				mkdir($targetFilePath, 0755, TRUE);
			}
			$targetFilePath = $targetFilePath . $fileName;
			move_uploaded_file($filetmp,$targetFilePath);
			$_SESSION['filepath']= $targetFilePath;
			header('location:view.php');
		}
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Image Processing</title>
<link rel="stylesheet" href="extra/bootstrap.min.css">
<script src="extra/jquery-3.2.1.min.js"></script>
<script src="extra/jquery.form.min.js"></script>
</head>

<body>
	
	<br>
	<div class="text-center">
	<h2> Upload Image</h2>
		
			<form enctype="multipart/form-data" 
				method="post">
						<span>Choose Image</span> <input type="file" accept="image/*"
							name="image_file" required>
					<button class="btn btn-primary" id="sub">Submit</button>
				
			</form>
		
				
	</div>
</body>
</html>
