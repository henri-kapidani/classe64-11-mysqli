<?php
include __DIR__ . '/constants.php';

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
// var_dump($conn);

if ($conn && $conn->connect_error) {
	echo 'c\'è stato un errore di connessione';
	exit;
}

$sql_str = 'SELECT name
				FROM departments';
$results = $conn->query($sql_str);

// var_dump($results);

if ($results) { ?>
	<ul><?php
		while ($row = $results->fetch_assoc()) {
			// var_dump($row);
			echo "<li>{$row['name']}</li>";
		} ?>
	</ul><?php
}