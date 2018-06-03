<?php
include "init.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ft_minishop</title>
		<link rel="stylesheet" href="/rush00/rush00/css/style.css">
		<link rel="stylesheet" href="/rush00/rush00/css/header.css">
	</head>
	<body>
	<header>
        <nav id="left-nav">
            <ul>
                <li class="cat"><a href="index.php">FT_MINISHOP</a>
                    <!-- <ul class="submenu">
                        <li><a>Club Poulet C&eacute;sar</a></li>
                        <li><a>Pain aux c&eacute;r&eacute;ales jambon crudit&eacute;s</a></li>
                        <li><a>Wrap bacon laitue tomate</a></li>
                        <li><a>Navette fromage frais</a></li>
                        <li><a>Navette jambon beurre</a></li>
                    </ul> -->
                </li>
                <li class="cat"><a>Par type:</a>
                    <ul class="submenu">
						<?php
						$categories = mysqli_query($sql, "SELECT id, name FROM categories ORDER BY name");
						if ($categories !== false) {
							while ($category = mysqli_fetch_array($categories)) {
								echo "<a href='category.php?id=".$category['id']."'>".$category['name']."</a>";
								}
						} ?>
                        <!--
							<li><a>Soupe carotte coriandre BIO</a></li>
							<li><a>Salade chou asiatique</a></li>
							<li><a>Salade de lentilles saumon sauce gravlax</a></li>
						-->
                    </ul>
                </li>
                <li class="cat"><a>Par gamme:</a>
                    <ul class="submenu">
						<?php
						$collections = mysqli_query($sql, "SELECT id, name FROM collections ORDER BY name");
						if ($collections !== false) {
							while ($collection = mysqli_fetch_array($collections)) {
								echo "<a href='collection.php?id=".$collection['id']."'>".$collection['name']."</a>";
								}
						} ?>

                        <!--
							<li><a>Croque-monsieur</a></li>
							<li><a>Quiche saumon fum&eacute; &eacute;pinards</a></li>
							<li><a>Risotto aux champignons et poulet</a></li>
							<li><a>Raviolinnis aux trois fromages</a></li>
							<li><a>Plat cuisin&eacute; de chef bobo BIO</a></li>
						-->
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
						<li><a href="">Profile</a></li>
						<?php if (ft_admin()) { ?>
						<li><a href="admin.php">ADMIN_PANEL</a></li>
						<?php } ?> 
						<li><a href="connexion.php?deconnexion=1">SIGN OUT</a></li>
					</ul>
				</li>
				<?php } ?>
			</ul>
        </nav>
    </header>
