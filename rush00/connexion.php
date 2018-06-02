<?PHP
include "header.php";
?>
<h1>Connexion</h1>
<?PHP
if (isset($msg)) {
	echo "<p>".$msg."</p>";
}
?>
<form method="post" action="connexion.php">
	<table>
		<tr>
			<td>Email</td>
			<td><input type="text" name="email" placeholder="Email" <?PHP if (isset($email)) { echo "value='".$email."'"; } ?> /></td>
		</tr>
		<tr>
			<td>Mot de passe</td>
			<td><input type="password" name="mdp" placeholder="****" /></td>
		</tr>
	</table>
	<input class="center" type="submit" name="connexion" value="Connexion" />
</form>
<?PHP
include "footer.php"
?>
