<?php session_start(); // Pornirea sesiunii pentru a retine starea utilizatorului

require "../Tables-MakeDB/makeDBConnection.php";
require "../../html/Operator1.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../css/woker1.css">
	<title>Sterge Film</title>
	<style>
		.delete {
			width: 100%;
			margin: auto;
		}

		.inner {
			margin: auto;
			text-align: center;
			padding: 20px;
		}

		.deletebttn {
			background-color: #f44336;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		.deletebttn:hover {
			background-color: #d32f2f;
		}

		.movie-card {
			width: 78%;
		}

		#movie_id1 {
			padding: 5px;
			font-size: 14px;
		}

		label {
			font-size: 20px;
		}

		.table-container {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 20px;
			padding: 10px;
			margin-top: 17px;
		}

		@media (max-width: 1310px) {
			.table-container {
				grid-template-columns: repeat(3, 1fr);
			}

			.movie-card {
				width: 370px;
			}

			.movie-card img {
				width: 180px;
				height: 270px;
			}
		}

		@media (max-width: 1195px) {
			.table-container {
				grid-template-columns: repeat(3, 1fr);
			}

			.movie-card {
				width: 330px;
			}

			.movie-card img {
				width: 160px;
				height: 250px;
			}
		}

		@media (max-width: 1100px) {
			.table-container {
				grid-template-columns: 1fr 1fr;
			}

			.movie-card {
				width: 400px;
			}

			.movie-card img {
				width: 170px;
				height: 250px;
			}
		}

		@media (max-width: 900px) {
			.table-container {
				grid-template-columns: 1fr;
			}

			.movie-card {
				width: 500px;
			}

			.movie-card img {
				width: 180px;
				height: 250px;
			}
		}

		@media (max-width: 600px) {
			.table-container {
				grid-template-columns: 1fr;
			}

			.movie-card {
				width: 350px;
			}

			.movie-card img {
				width: 180px;
				height: 250px;
			}
		}
	</style>
</head>

<body>

	<div class="delete">
		<div class="inner">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<label for="movie_id1">ID Film:</label>
				<input type="text" id="movie_id1" name="movie_id1">
				<input type="submit" value="Sterge" class="deletebttn">
			</form>
		</div>
	</div>
</body>

</html>

<?php
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (!empty($_POST["movie_id1"])) {
	$id = test_input($_POST["movie_id1"]);
}

if (isset($id)) {
	$id = mysqli_real_escape_string($conn, $id);

	$tables = ['showtimes', 'rooms', 'movies']; // Array cu toate tabelele pentru stergeri multiple

	foreach ($tables as $table) {
		// Utilizare prepared statements pentru securitate
		$stmt = $conn->prepare("DELETE FROM $table WHERE movie_id = ?");
		$stmt->bind_param("i", $id);

		try {
			if (!$stmt->execute()) {
				throw new Exception($stmt->error);
			}
			echo "Inregistrarea a fost stearsa cu succes din $table<br>";
		} catch (mysqli_sql_exception $ex) {
			// Verificare daca eroarea este cauzata de constrangeri ale cheilor externe
			if ($ex->getCode() == 1451) {
				echo "Eroare: Trebuie sa stergeti rezervarile utilizatorului inainte de a sterge filmul<br>";
				break;
			} else {
				echo "Eroare la stergerea inregistrarii: " . $ex->getMessage() . "<br>";
			}
		} catch (Exception $e) {
			echo "Eroare la stergerea inregistrarii: " . $e->getMessage() . "<br>";
		}
		$stmt->close();
	}
}
?>

<table style="border:1px; border-style:solid; border-color:black">
	<?php
	if ($conn->connect_error) {
		die("Conexiunea a esuat: " . $conn->connect_error);
	}

	require "../Tables-MakeDB/makeDBConnection.php";
	?>
	<div class="table-container">
		<?php
		$sql = "SELECT 
                movies.movie_id, 
                movies.title, 
                movies.image_path
            FROM movies ";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo "<div class='movie-card'>";

				echo "<img src='" . $row["image_path"] . "' alt='Imagine Film'>";

				echo "<div class='movie-info'><strong>ID Film:</strong> " . $row["movie_id"];
				echo "</div>";

				echo "<div class='movie-info'><strong>Titlu:</strong> " . $row["title"];
				echo "</div>";

				echo "</div>";
			}
		} else {
			echo "<p>Nu s-au gasit filme.</p>";
		}
		?>
	</div>
</table>
