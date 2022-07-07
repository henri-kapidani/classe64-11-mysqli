<?php
include __DIR__ . '/constants.php';

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
// var_dump($conn);

if ($conn && $conn->connect_error) {
	echo 'c\'è stato un errore di connessione';
	exit;
}

$name = $_GET['name'] ?? '';

// versione non sicura
// $sql_str = "SELECT *
// 				FROM teachers
// 				WHERE name = '$name'";
// echo $sql_str;
// $results = $conn->query($sql_str);
// end versione non sicura

// versione sicura
$sql_str = "SELECT *
				FROM teachers
				WHERE name = ?";

$stmt = $conn->prepare($sql_str);
$stmt->bind_param('s', $name);
$stmt->execute();
$results = $stmt->get_result();
// end versione sicura

if ($results && $results->num_rows > 0) { ?>
	<ul><?php
		while ($row = $results->fetch_assoc()) {
			echo "<li>{$row['name']} {$row['surname']} - {$row['email']}</li>";
		} ?>
	</ul><?php
} elseif ($results) {
	echo '<h1>no results</h1>';
} else {
	echo '<h1>error</h1>';
}

$conn->close();
