<?PHP
include "header.php";
?>
<div class="container">
    <form method="post" action="connexion.php" class="left-part">
        <table>
            <tr>
                <td>Email</td>
                <td>
                    <input type="text" name="email" placeholder="Email" <?PHP if (isset($email)) { echo "value='".$email. "'";
                        } ?> /></td>
            </tr>
            <tr>
                <td>Mot de passe</td>
                <td>
                    <input type="password" name="mdp" placeholder="****" />
                </td>
            </tr>
        </table>
        <input class="center" type="submit" name="connexion" value="Connexion" />
	</form>
	<form method="post" action="connexion.php" class="right-part">
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
</div>

<?PHP
if (isset($msg)) {
	echo "<p>".$msg."</p>";
}
?>
<?PHP
include "footer.php"
?>
