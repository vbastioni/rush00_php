<?PHP
include "header.php";
$ok = false;
$all_cat = false;
if (isset($_GET['id'])) {
	$id = ceil($_GET['id']);
	$category = mysqli_query($sql, "SELECT name FROM categories WHERE id = ".$id." LIMIT 1");
	if (mysqli_num_rows($category) == 1) {
		$name = mysqli_fetch_array($category);
		$name = $name['name'];
		$ok = true;
	}
} else {
	$all_cat = true;
}
?>
	<div class="cat-container">
		<?php if ($name) { ?>
			<h1><?=$name?></h1>
		<?php } ?>
		<div class="card-columns">
<?PHP
if ($ok) {
	$articles = mysqli_query($sql, "SELECT * FROM articles WHERE gamme = ".$id." ORDER BY name");
	while ($article = mysqli_fetch_array($articles)) {
		?>
		<div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?= $article['photo']?>" alt="<?= $article['name']?>" height=18rem>
            <div class="card-body">
                <h5 class="card-title"><?= $article['name'] ?></h5>
                <p class="card-text"><?= $article['price'] ?>&euro;</p>
                <a href="cart.php?add=<?php echo $article['id']; ?>">+</a>
            </div>
        </div>
		<?PHP
	}
	$articles = mysqli_query($sql, "SELECT * FROM articles WHERE type = ".$id." ORDER BY name");
	while ($article = mysqli_fetch_array($articles)) {
		?>
		<div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?= $article['photo']?>" alt="<?= $article['name']?>" height=18rem>
            <div class="card-body">
                <h5 class="card-title"><?= $article['name'] ?></h5>
                <p class="card-text"><?= $article['price'] ?>&euro;</p>
                <a href="cart.php?add=<?php echo $article['id']; ?>">+</a>
            </div>
        </div>
		<?PHP
	}
} else if ($all_cat) {
	include("all_cat.php");
} else {
	echo "<p style=\"text-transform: uppercase;\">Cette categorie est introuvable.</p>";
}
include "footer.php";
?>
	</div>
</div>
