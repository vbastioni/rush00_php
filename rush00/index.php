<?php
include "header.php";
$prev = false;
$categories = mysqli_query($sql, "SELECT id, name FROM categories ORDER BY name LIMIT 2");
while ($category = mysqli_fetch_row($categories)) {
	if ($prev) {
		echo "<br />";
	} else {
		$prev = true;
	}
	echo "<h1>".$category['name']."</h1><br /><table id='articles'>";
	$articles = mysqli_query($sql, "SELECT * FROM articles WHERE id_category = ".$category['id']." ORDER BY RAND() LIMIT 2");
    if ($articles)
    {
    while ($article = mysqli_fetch_row($articles)) {
?>
		<tr>
			<td><img alt='<?php echo $article['name']; ?>' src='<?php echo $article['photo']; ?>' title='<?php echo $article['name']; ?>' /></td>
			<td><?php echo $article['name']; ?></td>
			<td><?php echo $article['price']; ?>&euro;</td>
			<td><a href='index.php?add=<?php echo $article['id']; ?>'>Ajouter au panier</a></td>
		</tr>
		<?php
    }
}
	echo "</table>";
}

include "footer.php"
?> 
