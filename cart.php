<?php include "header.php"; ?>
		<td valign="top">
			<h1>Panier</h1>
			<br />
			<?php
			if (!isset($_SESSION['panier']) || count($_SESSION['panier']) == 0) {
			echo "Votre panier est vide";
			} else {
			echo "<table id='panier'>";
			$total = 0;
			foreach($_SESSION['panier'] as $id_article => $nb_article) {
			$retour = mysqli_query($sql, "SELECT * FROM articles WHERE id = ".$id_article." LIMIT 1");
			if (mysqli_num_rows($retour) > 0) {
			$article = mysqli_fetch_array($retour);
			?>
			<tr>
				<td><img alt='<?php echo $article['name']; ?>' src='<?php echo $article['photo']; ?>' title='<?php echo $article['name']; ?>' /></td>
				<td>
					<?php echo $article['name']; ?>
					<br />
					Quantité: <?php echo $nb_article; ?>
					<br />
					<a href="index.php?remove=<?php echo $id_article; ?>">Moins</a> - 
					<a href="index.php?add=<?php echo $id_article; ?>">Plus</a>
				</td>
				<td><?php echo $article['price'] * $nb_article; ?>&euro;</td>
			</tr>
			<?php
			$total += $article['price'] * $nb_article;
			}
			}
			if ($total > 0) {
			?>
			<tr>
				<td colspan="2">Total: </td>
				<td><?php echo $total; ?>&euro;</td>
			</tr>
			<?php
			}
			echo "</table><br /><a href='valider.php'>Valider mes achats</a>";
			}
			?>
        </td>
<?php include "footer.php"; ?>