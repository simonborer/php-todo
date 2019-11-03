<?php

require "../assets/configs/config.php";

try {

	// Open a connection to the database.
	$connection = new PDO($dsn, $username, $password, $options);

	// Get the query parameter 'id'.
	$id = $_GET['id'];

	// Note that the colon (:) is a placeholder,
	// meaning it will be 'filled in' before the 
	// query is sent to the database.
	$sql = "SELECT isComplete FROM tasks WHERE id = :id";
	$statement = $connection->prepare($sql);

	// Fill in the placeholder with the '$id' variable.
	$statement->bindValue(':id', $id);

	$statement->execute();

	$state = $statement->fetch(PDO::FETCH_ASSOC);

	if ($state['isComplete'] == 'false') {
		$isComplete = 'true';
	} else {
		$isComplete = 'false';
	}

	$sql = "UPDATE tasks
                SET
                    isComplete  = :isComplete
                WHERE id = :id";

	$statement = $connection->prepare($sql);
	$statement->bindValue(':id', $id);
	$statement->bindValue(':isComplete', $isComplete);
	$statement->execute();

	header("location: ../index.php");

} catch (PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}

?>