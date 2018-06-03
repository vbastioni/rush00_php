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

function ft_secure($str) {
	return str_replace('\\', '/', htmlentities(htmlspecialchars(trim($str)), ENT_QUOTES));
}

?>
