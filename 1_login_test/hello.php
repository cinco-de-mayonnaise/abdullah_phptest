<!DOCTYPE html>
<html>
    <script src="main.js"></script>
    <link rel="stylesheet" href="styles.css">
    <head>
        <title>Page Title that appears on the tab</title>
    </head>

    <body>
	<form method="post" action="login_check.php">
	  <div class="form-group">
		<label for="exampleInputEmail1">Email address</label>
		<!-- id is for CSS/JS crap, name is for access by post(the sql thingy)-->
		<input type="text" name="id_textfield" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter id">
	  </div>
	  <div class="form-group">
		<label for="exampleInputPassword1">Password</label>
		<input type="password" name="pass_textfield" class="form-control" id="exampleInputPassword1" placeholder="Password">
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
    </body>
</html>