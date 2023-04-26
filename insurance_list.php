<?php
$host = "localhost";
$dbname = "pojisteni";
$username = "root";
$password = "";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $stmt = $pdo->prepare("SELECT * FROM insured");
  $stmt->execute();
  $data = $stmt->fetchAll();
} catch(PDOException $e) {
  echo "Připojení k databázi selhalo: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Seznam pojištěných</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="footer.css">
	<link rel="stylesheet" type="text/css" href="insurance_list.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-blue">
			<a class="navbar-brand" href="index.html">
				<img src="img/glosso-logo.png" alt="Glosso logo" width="200" height="60">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
				aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="the_insured.html">Pojištěnci</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="insurance_list.php">Pojištění</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="kontakt.html">Kontakt</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="login.html">Klientská zóna</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="admin.html">Admin</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>

	<div class="container">
		<table>
			<thead>
				<tr>
					<th>Jméno</th>
					<th>Příjmení</th>
					<th>Věk</th>
					<th>Adresa</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (array_reverse($data) as $row): ?>
					<tr>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['surname']; ?></td>
						<td><?php echo $row['age']; ?></td>
						<td><?php echo $row['address']; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</body>
</html>
