<?php
session_start();
$imgpath = '';
if(isset($_SESSION['newpath']))
{
	$imgpath = $_SESSION['newpath'];
}
else
{
	$imgpath = @$_SESSION['filepath'];
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
<body class="container">
<h2 class="text-center">View Image</h2>
<p></p>
	<div class=" row">
	
	<div class="col-sm-4 form-group">
		<form action="img.php" method="POST">
			<input type="text" class="form-control" required name="lside" placeholder="Left Space"/>
			<input type="text" class="form-control" required name="tside" placeholder="Top Space"/>
			<input type="text" class="form-control" required name="height" placeholder="Height"/>
			<input type="text" class="form-control" required name="width" placeholder="Width"/>
			<input type="submit" class="btn btn-success" value="Add Rectangle"/>
		</form>
		<br>
		<p>
			<a class="btn btn-danger" href="index.php?reset=1">Upload Other Image</a> 
			<a class="btn btn-danger" href="<?php echo $imgpath ?>" download>Download file</a>
		</p>
	</div>
	<div class="img_preview col-sm-6" id="image-holder" style="">
		<img width="800" height="400" id="large-preview" src="<?php echo $imgpath ?>" />
	</div>
	<div class="col-sm-12">
	<?php
	if(isset($_SESSION['arr_img']))
	{
	?>
	<table class="table table-bordered table-hover">
	<tr>
		<th>
			No
		</th>
		<th>
			Left Space
		</th>
		<th>
			Top Space
		</th>
		<th>
			Height
		</th>
		<th>
			Width
		</th>
		<th>
			Action
		</th>
	</tr>
	<?php
		$arr_img = $_SESSION['arr_img'];
	
		for($i = 0; $i < sizeof($_SESSION['arr_img']) ; $i++ )
		{
			echo "<tr>";
			echo "<td>". ($i+1) ."</td>";
			echo "<td>".$arr_img[$i]['lside']."</td>";
			echo "<td>".$arr_img[$i]['tside']."</td>";
			echo "<td>".$arr_img[$i]['height']."</td>";
			echo "<td>".$arr_img[$i]['width']."</td>";
			echo "<td><a class='btn btn-dark' href='img.php?delete=$i'>Remove</a></td>";
			echo "</tr>";
				
		}
	?>
	
	</table>
	<?php
	}	
	?>
	</div>
	</div>
</body>