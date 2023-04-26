<?php
// připojení k databázi
$host = "localhost";
$dbname = "pojisteni";
$username = "root";
$password = "";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Připojení k databázi selhalo: " . $e->getMessage();
}

// zpracování odeslaných dat z formuláře
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $surname = test_input($_POST["surname"]);
  $age = test_input($_POST["age"]);
  $address = test_input($_POST["address"]);

  // validace formuláře
  $error_message = "";
  if (empty($name)) {
    $error_message .= "<p style='color:red;'>Zadejte jméno.</p>";
  }
  if (empty($surname)) {
    $error_message .= "<p style='color:red;'>Zadejte příjmení.</p>";
  }
  if (empty($age)) {
    $error_message .= "<p style='color:red;'>Zadejte věk.</p>";
  }
  if (empty($address)) {
    $error_message .= "<p style='color:red;'>Zadejte adresu.</p>";
  }

  // zápis dat do tabulky "insured"
  if (empty($error_message)) {
    try {
      $stmt = $pdo->prepare("INSERT INTO insured (name, surname, age, address) VALUES (:name, :surname, :age, :address)");
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':surname', $surname);
      $stmt->bindParam(':age', $age);
      $stmt->bindParam(':address', $address);
      $stmt->execute();
      // uložení zprávy o úspěšné registraci do session proměnné
      session_start();
      $_SESSION['success_message'] = 'Byl jste úspěšně zaregistrován.';
      header("Location: the_insured.html");
      exit();
    } catch(PDOException $e) {
      echo "Chyba při zápisu dat do databáze: " . $e->getMessage();
    }
  } else {
    // uložení chybových hlášek do session proměnné
    session_start();
    $_SESSION['error_message'] = $error_message;
    header("Location: the_insured.html");
    exit();
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
