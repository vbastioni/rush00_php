<?PHP

$articles = mysqli_query($sql, "SELECT * FROM articles ORDER BY name");
while ($article = mysqli_fetch_array($articles)) { ?>
		<div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?= $article['photo']?>" alt="<?= $article['name']?>" height=18rem>
            <div class="card-body">
                <h5 class="card-title"><?= $article['name'] ?></h5>
                <p class="card-text"><?= $article['price'] ?>&euro;</p>
            </div>
        </div>
<?php }
?>