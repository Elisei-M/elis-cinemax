<?php
session_start(); // Pornirea sesiunii

require "../Tables-MakeDB/makeDBConnection.php";
require "../../html/navBar.php";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$message = ""; // Variabila pentru mesaje

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);

        // Verificare in tabelul "users"
        $sql_users = "SELECT id, firstname, lastname, email, password, role FROM users WHERE email = ?";
        $stmt_users = $conn->prepare($sql_users);
        $stmt_users->bind_param("s", $email);
        $stmt_users->execute();
        $result_users = $stmt_users->get_result();

        if ($result_users->num_rows > 0) {
            $row = $result_users->fetch_assoc();

            // Verificare parola
            if (password_verify($password, $row["password"])) {
                $_SESSION["loggedin"] = true;
                $_SESSION["userid"] = $row["id"];
                $_SESSION["username"] = $row["firstname"] . " " . $row["lastname"];
                $_SESSION["role"] = $row["role"];

                // Redirecționare pe baza rolului
                switch ($row["role"]) {
                    case "admin":
                        header("Location: ../fisiere_operator/admin.php");
                        break;
                    default:
                        header("Location: acasa.php");
                        break;
                }
                exit();
            } else {
                $message = "Parola invalida. Va rugam sa incercati din nou.";
            }
        } else {
            // Daca utilizatorul nu este gasit in `users`, verificam in `workers`
            $sql_workers = "SELECT id, firstname, lastname, email, password FROM workers WHERE email = ?";
            $stmt_workers = $conn->prepare($sql_workers);
            $stmt_workers->bind_param("s", $email);
            $stmt_workers->execute();
            $result_workers = $stmt_workers->get_result();

            if ($result_workers->num_rows > 0) {
                $row = $result_workers->fetch_assoc();

                // Verificare parola
                if (password_verify($password, $row["password"])) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["userid"] = $row["id"];
                    $_SESSION["username"] = $row["firstname"] . " " . $row["lastname"];
                    $_SESSION["role"] = "worker";

                    // Redirecționare către operator.php
                    header("Location: ../fisiere_operator/operator.php");
                    exit();
                } else {
                    $message = "Parola invalida. Va rugam sa incercati din nou.";
                }
            } else {
                $message = "Utilizatorul nu a fost gasit. Verificati emailul si incercati din nou.";
            }

            $stmt_workers->close();
        }

        $stmt_users->close();
        $conn->close();
    } else {
        $message = "Va rugam sa furnizati atat email-ul cat si parola pentru autentificare.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/navBar.css">
    <style>
        .outer-container {
            background-color: #f2f2f2;
            margin: 30px auto;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            max-width: 550px;
            margin: auto;
            padding-bottom: 20px;
            padding: 20px;
            border-radius: 10px;
        }

        .bttn {
            color: black;
            background-color: #d9d9d9;
            border: 2px solid #c9c9c9;
            border-radius: 8px;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin: 10px 2px;
            transition: all 0.2s;
            cursor: pointer;
        }

        .bttn:hover {
            background-color: #cccccc;
            border-color: #bbbbbb;
        }

        .bttn:active {
            background-color: #bdbdbd;
            border-color: #acacac;
        }

        .bttn:focus {
            outline: none;
        }

        label {
            font-size: 18px;
            color: #212121;
        }
    </style>
    <title>Autentificare</title>
</head>

<body style="background-color: black;">
    <div class="outer-container">
        <div class="form-container" style=" margin-top:70px; ">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="w3-container w3-card-4 w3-light-grey w3-round-large" style="max-width:500px; margin:auto">
                <h3 style="text-align: center;"><b>Autentificare</b></h3>
                <br>
                <p>
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Introdu adresa de email">
                </p>
                <p>
                    <label for="password">Parola</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Introdu parola">
                </p>
                <input type="submit" value="Autentificare" class="bttn">
                <br><br>
                <p>
                    <h6 style="color:#4d4d4d;"><b>Esti nou? <a href="inregistrare.php" style="color: #3982D8;">Inregistreaza-te</b></a></h6>
                </p>
                <?php
                if (!empty($message)) {
                    echo "<p style='color: red;'>$message</p>";
                }
                ?>
            </form>
        </div>
    </div>

    <div class="container" style="margin-top: 70px;">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="acasa.php" class="nav-link px-2 text-white">Acasa</a></li>
                <li class="nav-item"><a href="maiMulteFilme2.php" class="nav-link px-2 text-white">Filme</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link px-2 text-white">Contact</a></li>
                <li class="nav-item"><a href="despre.php" class="nav-link px-2 text-white">Despre</a></li>
            </ul>
            <p class="text-center text-white">&copy; <?php echo date("Y"); ?> Eli's Cinemax</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"></script>
</body>

</html>
