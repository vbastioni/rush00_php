<?php

function ft_logged() {
	return isset($_SESSION['id']);
}

function ft_admin() {
	global $user;
	return (ft_logged() && $user['admin'] == 1);
}

function crypt_mdp($mdp) {
	return hash("whirlpool", $mdp);
}
?>
