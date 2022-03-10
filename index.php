<!DOCTYPE html>
<html>
<?php

require('src/log.php');

session_start();

if (!empty($_POST['email']) && !empty($_POST['password'])) {

	require('src/connect.php');

	// VARIABLES

	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);

	// Adresse email valide

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

		header('location: index.php?error=1&message=Votre adresse email est invalide.');
		exit();
	}

	// CHIFFRAGE DU MOT DE PASSE

	$password = "aq1" . sha1($password . '123') . '25';

	// EMAIL DEJA UTILISE
	$req = $db->prepare('SELECT count(*) as numberEmail FROM user WHERE email = ?');
	$req->execute(array($email));

	while ($email_verification = $req->fetch()) {

		if ($email_verification['numberEmail'] != 1) {

			header('location: index.php?error=1&message=Impossible de vous authentifier correctement.');
			exit();
		}
	}

	// CONNEXION

	$req = $db->prepare('SELECT * FROM user WHERE email = ?');
	$req->execute(array($email));

	while ($user = $req->fetch()) {

		if ($password == $user['password']) {
			$_SESSION['connect'] = 1;
			$_SESSION['email'] = $user['email'];

			if (isset($_POST['auto'])) {
				setcookie('auth', $user['secret'], time() + 365 * 24 * 3600, '/', null, false, true);
			};

			header('location: index.php?success=1');
			exit();
		} else {
			header('location: index.php?error=1&message=Impossible de vous authentifier correctement.');
			exit();
		}
	}
}

?>

<head>
	<meta charset="utf-8">
	<title>Netflix</title>
	<link rel="stylesheet" type="text/css" href="design/default.css">
	<link rel="icon" type="image/pngn" href="img/favicon.png">
</head>

<body>

	<?php include('src/header.php'); ?>

	<section>
		<div id="login-body">
			<?php if (!isset($_SESSION['connect'])) {
			?>
				<h1>S'identifier</h1>


				<?php
				if (isset($_GET['error'])) {

					if ($_GET['message']) {

						echo '<p class="alert error">' . $_GET['message'] . '</p>';
					}
				}

				?>

				<form method="post" action="index.php">
					<input type="email" name="email" placeholder="Votre adresse email" required />
					<input type="password" name="password" placeholder="Mot de passe" required />
					<button type="submit">S'identifier</button>
					<label id="option"><input type="checkbox" name="auto" checked />Se souvenir de moi</label>
				</form>


				<p class="grey">Première visite sur Netflix ? <a href="inscription.php">Inscrivez-vous</a>.</p>
		</div>

	<?php } else {
	?>
		<div>
			<h1>Bienvenue sur Netflix !</h1>
			<p class="alert success">Vous êtes connecté avec l'email <?php echo $_SESSION['email'] ?>.</p>
			<a href="src/logout.php" style='color: red;'>Se déconnecter</a>

		</div>
	</section>
<?php }; ?>

<?php include('src/footer.php'); ?>
</body>

</html>