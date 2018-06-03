<?PHP
include "header.php";
$ok = false;
if (isset($_GET['id'])) {
	$id = ceil($_GET['id']);
	$category = mysqli_query($sql, "SELECT name FROM categories WHERE id = ".$id." LIMIT 1");
	if (mysqli_num_rows($category) == 1) {
		$name = mysqli_fetch_array($category);
		$name = $name['name'];
		$ok = true;
	}
}
if ($ok) {
	echo "<h1>".$name."</h1><br /><table id='articles'>";
	$articles = mysqli_query($sql, "SELECT * FROM articles WHERE id_category = ".$id." ORDER BY name");
	while ($article = mysqli_fetch_array($articles)) {
		?>
		<tr>
			<td><img alt='<?PHP echo $article['name']; ?>' src='<?PHP echo $article['photo']; ?>' title='<?PHP echo $article['name']; ?>' /></td>
			<td><?PHP echo $article['name']; ?></td>
			<td><?PHP echo $article['price']; ?>&euro;</td>
			<td><a href='category.php?id=<?PHP echo $id; ?>&add=<?PHP echo $article['id']; ?>'>Ajouter au panier</a></td>
		</tr>
		<?PHP
	}
	echo "</table>";
} else {
	echo "Cette categorie n'existe pas ou n'existe plus.";
}
include "footer.php";
?>
