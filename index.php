<?php

	date_default_timezone_set("America/Toronto");

	try {

		// Get variables from the configs file
		// in the configs folder that we use in our
		// connection string.
		require "./assets/configs/config.php";
		
		// Get a function from the common.php file.
		require "./utilities/common.php";

		// Create a variable that will perform our connection.
		$connection = new PDO($dsn, $username, $password, $options);

		// Create a variable that contains our first SQL
		// statement, getting all the data from the `tasks`
		// table.
		$sql = "SELECT * FROM tasks";

		// Tells the database to get the data ready, 'cause
		// we're going to be asking for it.
		$statement = $connection->prepare($sql);

		// Asks the database to return the data.
		$statement->execute();

		// Get all the rows returned by the database,
		// and put them in a variable called '$result'.
		$result = $statement->fetchAll();

	} catch (PDOException $error) {
		// If something goes wrong, show the SQL statement
		// and the error message.
		echo $sql . "<br>" . $error->getMessage();

	}

?>


<?php 
	// Get the HTML from the header.php file in the templates folder.
	require "./templates/header.php";

?>

  <div class="container">
    
    <?php
    	// Get the HTML from the nav.php file in the templates folder.
			require "./templates/nav.php";

			// If there's nothing the $result variable
			// and there's no rows in the $statement variable,
			// show an HTML tag with text letting us know
			// that there's nothing to show.
			if (!$result && $statement->rowCount() == 0) { 
		?>
    	<div> No tasks to display. Add one above.</div>

    <?php } else {

    	// If there IS a result, then for each one of them,
    	// put the data from the row into the file in 
    	// the templates folder called showtask.php
			foreach ($result as $task) {
				require "./templates/showtask.php";
			} // <!-- foreach -->
			
		}?> <!-- else -->
    
  </div> <!-- container -->

<!-- 
	Get the HTML from the footer.php file.
 -->
<?php require "./templates/footer.php";?>