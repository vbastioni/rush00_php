<?PHP
include "header.php";
?>
<div class="cat-container">
<h1>Valider votre commande</h1><br />
<?PHP
if (ft_logged()) {
	if (!isset($_SESSION['panier']) || count($_SESSION['panier']) == 0) {
		echo "Votre panier est vide";
	} else {
		if (isset($msg)) {
			echo "<p>".$msg."</p>";
		}
		?>
		<form method="post" action="valider.php">
			<p><input type="submit" name="valider" value="Valider ma commande" /></p>
		</form>
		<?PHP
	}
} else {
	echo "Vous devez vous connecter pour valider votre commande";
}?>
</div>
<?php
include "footer.php";
?>
