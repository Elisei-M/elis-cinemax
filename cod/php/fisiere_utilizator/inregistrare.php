<?php
session_start(); // Inceperea sesiunii pentru a retine ID-ul si numele complet al utilizatorului
require "../../html/navBar.php";
require "../Tables-MakeDB/makeDBConnection.php";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$table = 'users';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["name"]) && !empty($_POST["lname"]) && !empty($_POST["email"]) && !empty($_POST["pw"]) && !empty($_POST["cpw"])) {

        $name = test_input($_POST["name"]);
        $lname = test_input($_POST["lname"]);
        $email = test_input($_POST["email"]);
        $pw = test_input($_POST["pw"]);
        $cpw = test_input($_POST["cpw"]);

        if (stripos($email, "@worker.com") !== false) {
            $error_message = "Inregistrarea cu acest email nu este permisa.";
        } else {
            $hashedPassword = password_hash($pw, PASSWORD_DEFAULT);

            try {
                $sql = "INSERT INTO $table (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $name, $lname, $email, $hashedPassword);
                $stmt->execute();

                header("Location: autentificare.php");
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) {
                    $exists = "Un utilizator cu acest email exista deja.";
                } else {
                    echo "Eroare: " . $e->getMessage();
                }
            }
            $stmt->close();
            $conn->close();
        }
    } else {
        $provide = "Va rugam sa completati toate campurile obligatorii.";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <title>Inregistrare</title>
</head>

<body style="background-color: black;">

    <div class="outer-container ">
        <div class="form-container" style=" margin-top:70px; ">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="w3-container w3-card-4 w3-light-grey w3-round-large" style="max-width:500px; margin:auto">
                <h3 style="text-align: center;"><b>Inregistreaza un cont</b></h3>
                <br>
                <p>
                    <label for="InputName" class="w3-large">Prenume</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Introdu prenumele">
                </p>
                <p>
                    <label for="InputLastName" class="w3-large">Nume</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Introdu numele">
                </p>
                <p>
                    <label for="InputEmail2" class="w3-large">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Introdu adresa de email">
                </p>
                <p>
                    <label for="InputPassword2" class="w3-large">Parola</label>
                    <input type="password" class="form-control" id="pw" placeholder="Creeaza o parola" name="pw" onkeyup="checkPasswordStrength(this.value)">
                    <span id="passwordStrength" style="font-size: small;"></span>
                </p>
                <p><label for="InputConfirm" class="w3-large">Confirma parola</label>
                    <input type="password" class="form-control" id="cpw" name="cpw" placeholder="Introdu parola din nou" oninput="validatePassword()">
                    <h6>
                        <div id="passwordError" style="color: red;"></div>
                    </h6>
                </p>
                <input type="submit" value="Trimite" class="bttn">

                <p>
                <h6 style="color:#4d4d4d;"><b>Ai deja un cont? <a href="autentificare.php" style="color: #3982D8;">Autentifica-te</b></a></h6>
                </p>
                <br>

                <?php
                if (isset($provide)) {
                    echo "<p style='color: red;'>$provide</p>";
                }
                if (isset($exists)) {
                    echo "<p style='color: red;'>$exists</p>";
                }
                if (isset($error_message)) {
                    echo "<p style='color: red;'>$error_message</p>";
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
            <p class="text-center text-white">&copy; <?php echo date("Y"); ?> Cinemax</p>
        </footer>
    </div>

</body>

</html>

<script>
    function validatePassword() {
        var password = document.getElementById("pw").value;
        var confirmPassword = document.getElementById("cpw").value;
        var errorDiv = document.getElementById("passwordError");

        if (password !== confirmPassword) {
            errorDiv.innerHTML = "Parolele nu se potrivesc!";
            return false;
        } else {
            errorDiv.innerHTML = "";
            return true;
        }
    }

    function checkPasswordStrength(password) {
        var passwordStrengthElement = document.getElementById("passwordStrength");

        if (password.length < 5) {
            passwordStrengthElement.innerText = "slaba";
            passwordStrengthElement.style.color = "red";
        } else if (password.length === 5) {
            passwordStrengthElement.innerText = "medie";
            passwordStrengthElement.style.color = "orange";
        } else {
            passwordStrengthElement.innerText = "puternica";
            passwordStrengthElement.style.color = "green";
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
