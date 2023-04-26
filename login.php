<?php
session_start();

// Kontrola, zda byl formulář odeslán
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kontrola, zda jsou pole pro jméno a heslo vyplněna
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        // Získání zadaných údajů
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Kontrola, zda jsou zadané údaje správné
        if ($email == "admin" && $password == "password") {
            // Nastavení session proměnné pro přihlášeného uživatele
            $_SESSION["loggedin"] = true;

            // Přesměrování na stránku pro administrátora
            header("location: admin.html");
            exit;
        } else {
            $errorMessage = "Nesprávné uživatelské jméno nebo heslo.";
        }
    } else {
        $errorMessage = "Prosím, vyplňte všechna pole.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="email">email:</label>
        <input type="text" id="email" name="email"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Submit">
    </form>

    <?php if (isset($errorMessage)) { ?>
        <p class="error"><?php echo $errorMessage; ?></p>
    <?php } ?>
</body>
</html>
