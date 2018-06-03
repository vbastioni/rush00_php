<?PHP
include "header.php";
?>
<h1>Commande #<?php echo $id_commande; ?> (<a href='admin_orders.php'>Retour</a>)</h1><br />
<?PHP
echo "<table>";
$total = 0;
foreach($content as $id_article => $nb_article) {
	$retour = mysqli_query($sql, "SELECT * FROM articles WHERE id = ".$id_article." LIMIT 1");
	if (mysqli_num_rows($retour) > 0) {
		$article = mysqli_fetch_array($retour);
		?>
		<tr>
			<td><img alt='<?PHP echo $article['name']; ?>' src='<?PHP echo $article['photo']; ?>' title='<?PHP echo $article['name']; ?>' /></td>
			<td><?php echo $article['name']; ?><br />Quantité: <?PHP echo $nb_article; ?></td>
			<td><?php echo $article['price'] * $nb_article; ?>&euro;</td>
		</tr>
		<?PHP
		$total += $article['price'] * $nb_article;
	}
}
?>
<tr>
	<td>Total: </td>
	<td><?PHP echo $total; ?>&euro;</td>
</tr></table>
<?PHP
include "footer.php";
?>