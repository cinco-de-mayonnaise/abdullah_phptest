<html>
<body>
<h1>Login Results</h1>
<p>Hey, this is where the webpage starts, notice how this is basically html</p><br><br>



<?php    // this is like a sudden interjection at the point in html where the php tag starts... from this point code begins to run on the server side that can access anything and everything that has been loaded in the html upto this point
	// identify input field in html form
	$id = $_POST['id_textfield'];
	$pass = $_POST['pass_textfield'];
	
	// Connect to the database
	$servername = "localhost:3307";
	$username = "root";
	$dbpassword = "root";
	$dbname = "abdullahtest";
	
	// Create a new mysqli instance
	$conn = new mysqli($servername, $username, $dbpassword, $dbname);
	
	// Check connection
		if ($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}
	
	// Prepare for SQL Query
	$stmt = $conn->prepare("SELECT * FROM login WHERE id = ?");       // TURNS OUT  we need prepare and bind_param when we need to modify our query depending on input from the user. If your query is fixed, you can just use $result = $conn->query('SELECT * FROM login');
	$stmt->bind_param("s", $id);   // specify type and what we are binding to the parameter in the sql
	
	// Execute the Query
	$stmt->execute();
	
	// Get the result
	$result = $stmt->get_result();

	
	if ($result->num_rows > 0)
	{
		// User account found, fetch the row
		$row = $result->fetch_assoc();   //understand this func later
		
		if ($pass === $row['password'])   // password matches
		{
			echo "<p>Gometo, please enter. If you see this, you entered the correct password.</p><br>";  // echo, think of it as something that spits out single-line html code AT THE EXACT POINT WHERE IT WAS FOUND IN HTML
		}
		else
		{
			echo "<p>Wrong password but the user exists!</p><br>";
		}
	}
	
	echo "<p>If you see this, either login was successful ORRR wrong user id was given</p><br>";
	
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false) {   // check type of browser
		echo 'You are using Firefox.<br>';
	}
	echo $_SERVER['HTTP_USER_AGENT'];   // print info about the browser(agent)

	
	// Close the prepared statement and database
	$stmt->close();
	$conn->close();
?>

</body>
</html>