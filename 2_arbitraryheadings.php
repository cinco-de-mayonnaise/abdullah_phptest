<!DOCTYPE html>
<html>
    <head>
        <title>Many headings yay</title>
    </head>

    <body>
	<form method="post">
	  <div>
		<input type="number" name="looptimes" placeholder="Enter number of times to loop">
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
	
	<?php
		$looptimes = $_POST['looptimes'];
		for ($i = 0; $i < $looptimes; $i++) { ?>
			<h1>This is a heading, the <?php echo $i;?> to be precise</h1>
	<?php 
		} 
	?>
	
	<?php
		echo "<br><br><br><p> Debug: This is what exists inside the _POST variable </p><br>";
		foreach($_POST as $key => $value) {
			echo "$key : $value";
		}
	?>
	
    </body>
</html>