<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="crypt.php">
		<label>Votre texte à encrypter:</label>
		<br>
		<input type="text" name="txtToCrypt" required>
		<br>
		<button type="submit" name="btnSubmit">encrypter</button>
	</form>
	<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$txtToCrypt = $_POST['txtToCrypt'];
		$txtEncrypt = password_hash($txtToCrypt, PASSWORD_BCRYPT);

		echo "<br><br>";
		echo "Votre texte encrypté:<br>";
		echo $txtEncrypt;
	}
	?>
</body>
</html>