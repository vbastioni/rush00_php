<?php
include "init.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ft_minishop</title>
	</head>
	<body>
		<table cellspacing="0">
			<tr>
				<td colspan="2"><a href="index.php">ft_minishop</a></td>
				<td>
					<?php if (ft_logged()) { ?>
					<p><?php echo $user['email']; ?><br /><?php if (ft_admin()) { ?><a href="admin.php">Administration</a><br /><?php } ?><a href="connexion.php?deconnexion=1">Se deconnecter</a><br /><a onclick="return confirm('Voulez-vous vraiment desactiver votre compte? Cette action est irreversible !');" href="connexion.php?desactivation=1">Desactiver ce compte</a></p>
					<?php } else { ?>
					<p><a href="connexion.php">Connexion</a><a href="inscription.php">Inscription</a></p>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<h1>Categories</h1>
					<?php
					$categories = mysqli_query($sql, "SELECT id, name FROM categories ORDER BY name");
					while ($category = mysqli_fetch_array($categories)) {
						echo "<a href='category.php?id=".$category['id']."'>".$category['name']."</a>";
					}
					?>
				</td>
				<td valign="top">
