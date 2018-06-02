<?PHP
include "header.php";
?>
<h1>Inscription</h1>
<?PHP
if (isset($msg)) {
	echo "<p>".$msg."</p>";
}
?>
<form method="post" action="inscription.php">
	<table>
		<tr>
			<td>Email</td>
			<td><input type="text" name="email" placeholder="Email" <?PHP if (isset($email)) { echo "value='".$email."'"; } ?> /></td>
		</tr>
		<tr>
			<td>Mot de passe</td>
			<td><input type="password" name="mdp" placeholder="****" <?PHP if (isset($mdp)) { echo "value='".$mdp."'"; } ?> /></td>
		</tr>
		<tr>
			<td>Mot de passe</td>
			<td><input type="password" name="mdp_verif" placeholder="****" <?PHP if (isset($mdp_verif)) { echo "value='".$mdp_verif."'"; } ?> /></td>
		</tr>
	</table>
	<p><input class="center" type="submit" name="inscription" value="Inscription" /></p>
</form>
<?PHP
include "footer.php"
?>
