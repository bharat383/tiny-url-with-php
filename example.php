<?php 
@include("class/tinyurl.class.php");
$TinyURL = new TinyURL();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tiny URL with PHP : Bharat Parmar</title>
	</head>
<body>
	<h4>Make Tiny URL : </h4>
	<form method="post">
		<div>
				<input type="text" name="long_url" value="" placeholder="Enter Your Original URL" size="100">
				<input type="submit" name="submit_url" value="Generate Tiny URL">
		</div>
	</form>

	<div><br><?php $TinyURL->DisplayTinyURL();?></div>

</body>
</html>

