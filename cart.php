<?php include "header.php"; ?>
<div class="cat-container">
	<h1>Panier</h1>
	<div class="card-columns">
	<?php
    if (!isset($_SESSION['panier']) || count($_SESSION['panier']) == 0) {
        echo "Votre panier est vide";
    } else {
        $total = 0;
        foreach($_SESSION['panier'] as $id_article => $nb_article) {
            $retour = mysqli_query($sql, "SELECT * FROM articles WHERE id = ".$id_article." LIMIT 1");
            if (mysqli_num_rows($retour) > 0) {
                $article = mysqli_fetch_array($retour);
                ?>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" 
                        src="<?php echo $article['photo']; ?>"
                        alt="<?php echo $article['name']; ?>"
                        height=18rem />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $article['name']; ?></h5>
                        <p>Quantité: <?php echo $nb_article; ?></p>
                        <a href="cart.php?remove=<?php echo $id_article; ?>">Moins</a>
                        <a href="cart.php?add=<?php echo $id_article; ?>">Plus</a>
                        <p class="card-text"><?php echo $article['price'] * $nb_article; ?>&euro;</p>
                    </div>
                </div>
                <?php
                $total += $article['price'] * $nb_article;
            }
        }
	if ($total > 0) { ?>
    </div>
	<h1>
		<p><?php echo $total; ?>&euro;</p>
	</h1>
<?php } ?>
	<a href='valider.php'>Valider mes achats</a>
<?php } ?>
</div>
<?php include "footer.php"; ?>