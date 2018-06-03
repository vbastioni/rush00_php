<?php
include "init.php";
$root = dirname($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ft_minishop</title>
		<link rel="stylesheet" href="<?=$root?>/css/style.css">
		<link rel="stylesheet" href="<?=$root?>/css/header.css">
		<link rel="stylesheet" href="<?=$root?>/css/card.css">
	</head>
	<body>
	<header>
        <nav id="left-nav">
            <ul>
                <li class="cat"><a href="index.php">FT_MINISHOP</a>
                </li>
                <li class="cat"><a>Par type:</a>
                    <ul class="submenu">
						<?php
						$type = 0;
						$categories = mysqli_query($sql, "SELECT id, name FROM categories WHERE cat_type = '$type' ORDER BY id");
						if ($categories !== false) {
							while ($category = mysqli_fetch_array($categories)) {
								echo "<li><a href='category.php?id=".$category['id']."'>".$category['name']."</a></li>";
								}
						} ?>
                    </ul>
                </li>
                <li class="cat"><a>Par gamme:</a>
                    <ul class="submenu">
						<?php
						$gamme = 1;
						$categories = mysqli_query($sql, "SELECT id, name FROM categories WHERE cat_type = '$gamme' ORDER BY id");
						if ($categories !== false) {
							while ($category = mysqli_fetch_array($categories)) {
								echo "<li><a href='category.php?id=".$category['id']."'>".$category['name']."</a></li>";
								}
						} ?>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav id="right-nav">
            <ul>
				<li><a class="cat" href="cart.php">Panier</a></li>
				<?php if (ft_logged() === false ) { ?>
				<li><a class="cat" href="connexion.php">ACCOUNT</a></li>
				<?php } else { ?>
				<li class="cat">
				<a>ACCOUNT (<?= $user['email'] ?>)</a>
					<ul class="submenu">
						<?php if (ft_admin()) { ?>
						<li><a href="admin.php">ADMIN_PANEL</a></li>
						<?php } ?> 
						<li><a onclick="return confirm('Voulez-vous vraiment desactiver votre compte? Cette action est irreversible !');" href="connexion.php?desactivation=1">Desactiver ce compte</a></li>
						<li><a href="connexion.php?deconnexion=1">SIGN OUT</a></li>
					</ul>
				</li>
				<?php } ?>
			</ul>
        </nav>
    </header>