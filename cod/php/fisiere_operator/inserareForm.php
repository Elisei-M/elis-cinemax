<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        h3 {
            background-color: darkgray;
            text-align: center;
        }
    </style>
</head>

<?php
require "../Tables-MakeDB/makeDBConnection.php";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Stergerea operatorilor
    if (isset($_POST["delete1"]) && !empty($_POST["worker_id"])) {
        $workerId = test_input($_POST["worker_id"]);

        $sqlDeletew = "DELETE FROM workers WHERE id = ?";
        $stmt = $conn->prepare($sqlDeletew);
        $stmt->bind_param("i", $workerId);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "<h3>Operator sters cu succes</h3>";
            } else {
                echo "<h3>ID operator invalid</h3>";
            }
        } else {
            echo "<h3>Eroare la stergerea operatorului: </h3>" . $stmt->error;
        }
        $stmt->close();
    }

    // Stergerea utilizatorilor
    if (isset($_POST["delete2"]) && !empty($_POST["id"])) {
        $id = test_input($_POST["id"]);

        $sqlDelete = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sqlDelete);
        $stmt->bind_param("i", $id);

        try {
            if (!$stmt->execute()) {
                throw new Exception($stmt->error);
            }

            if ($stmt->affected_rows > 0) {
                echo "<h3>Utilizator sters cu succes</h3>";
            } else {
                echo "<h3>ID Utilizator invalid</h3>";
            }

            // Eroare cauzata de constrangerile cheilor externe, utilizatorul avand rezervari active
        } catch (mysqli_sql_exception $ex) {
            echo "<h3>Eroare: Nu se poate sterge utilizatorul cu ID $id. Va rugam sa stergeti mai intai rezervarile utilizatorului. <a href='cereri.php'>CLICK pentru a vedea rezervarile</a> </h3>";
        } catch (Exception $e) {
            echo "<h3>Eroare la stergerea utilizatorului: " . $e->getMessage() . "</h3>";
        }

        $stmt->close();
    }
}

$conn->close();
