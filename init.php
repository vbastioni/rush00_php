<?PHP 
session_start();
include "functions.php";

$sql = mysqli_connect('192.168.99.100:3306', 'root', 'root', 'ft_minishop');

$page = explode("/", $_SERVER['PHP_SELF']);
$page = explode(".php", $page[count($page) - 1]);
$page = $page[0];

if (ft_logged()) {
	$user = mysqli_query($sql, "SELECT * FROM users WHERE id = ".$_SESSION['id']." LIMIT 1");
	if (mysqli_num_rows($user) == 0) {
		unset($_SESSION['id']);
		header("Location: index.php");
		exit;
	}
	$user = mysqli_fetch_array($user);
	if ($user['desactivated']) {
		unset($_SESSION['id']);
		header("Location: index.php");
		exit;
	}
	$user_id = ceil($user['id']);
}
if ($page == "index") {
	if (isset($_GET['add'])) {
		$id_add = ceil($_GET['add']);
		if (!isset($_SESSION['panier'])) {
			$_SESSION['panier'] = array();
		}
		if (isset($_SESSION['panier'][$id_add])) {
			$_SESSION['panier'][$id_add]++;
		} else {
			$_SESSION['panier'][$id_add] = 1;
		}
	}
	if (isset($_GET['remove']) && isset($_SESSION['panier'])) {
		$id_add = ceil($_GET['remove']);
		if (isset($_SESSION['panier'][$id_add])) {
			if ($_SESSION['panier'][$id_add] == 1) {
				unset($_SESSION['panier'][$id_add]);
			} else {
				$_SESSION['panier'][$id_add]--;
			}
		}
	}
}

if ($page == "inscription") {
	if (ft_logged()) {
		header("Location: index.php");
		exit;
	}
	if (isset($_POST['inscription'])) {
		$email = $_POST['email'];
		$mdp = $_POST['mdp'];
		$mdp_verif = $_POST['mdp_verif'];
		if ($email == "") {
			$msg = "Veuillez indiquer votre email";
		} else if (strlen($email) > 100) {
			$msg = "Votre email est trop long";
		} else if (!preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,3}$#i', $email)) { // A verifier et/ou changer
			$msg = "Votre email est incorrect";
		} else if (mysqli_num_rows(mysqli_query($sql, "SELECT email FROM users WHERE email = '".$email."' LIMIT 1")) > 0) {
			$msg = "Cet email est deja utilise";
		} else if ($mdp == "" || $mdp_verif == "") {
			$msg = "Vous n'avez pas rempli les deux mots de passes";
		} else if (strlen($mdp) > 100) {
			$msg = "Votre mot de passe est trop long";
		} else if ($mdp != $mdp_verif) {
			$msg = "Les deux mots de passe ne sont pas identiques";
		} else {
			mysqli_query($sql, "INSERT INTO users VALUES (NULL, '".$email."', '".crypt_mdp($mdp)."', 0, 0)");
			header("Location: connexion.php");
			exit;
		}
	}
}

if ($page == "connexion") {
	if (ft_logged()) {
		if (isset($_GET['deconnexion'])) {
			unset($_SESSION['id']);
		} else if (isset($_GET['desactivation'])) {
			mysqli_query($sql, "UPDATE users SET desactivated = 1 WHERE id = ".$_SESSION['id']);
			unset($_SESSION['id']);
		}
		header("Location: index.php");
		exit;
	}
	if (isset($_POST['connexion'])) {
		$email = $_POST['email'];
		$mdp = $_POST['mdp'];
		if ($email == "") {
			$msg = "Veuillez indiquer votre email";
		} else if ($mdp == "") {
			$msg = "Veuillez indiquer votre mot de passe";
		} else if (mysqli_num_rows(mysqli_query($sql, "SELECT id FROM users WHERE email = '".$email."' AND password = '".crypt_mdp($mdp)."' LIMIT 1")) < 1) {
			$msg = "Email ou mot de passe incorrect";
		} else if (mysqli_num_rows(mysqli_query($sql, "SELECT desactivated FROM users WHERE email = '".$email."' AND desactivated = 1 LIMIT 1")) > 0) {
			$msg = "Ce compte a ete desactive";
		} else {
			$retour = mysqli_query($sql, "SELECT id FROM users WHERE email = '".$email."' AND password = '".crypt_mdp($mdp)."' LIMIT 1");
			$id = mysqli_fetch_array($retour);
			$_SESSION['id'] = $id['id'];
			header("Location: index.php");
			exit;
		}
	}
}

if ($page == "category") {
	if (isset($_GET['add'])) {
		$id_add = ceil($_GET['add']);
		if (!isset($_SESSION['panier'])) {
			$_SESSION['panier'] = array();
		}
		if (isset($_SESSION['panier'][$id_add])) {
			$_SESSION['panier'][$id_add]++;
		} else {
			$_SESSION['panier'][$id_add] = 1;
		}
	}
}

if ($page == "valider") {
	if (isset($_POST['valider'])) {
		mysqli_query($sql, "INSERT INTO panier VALUES (NULL, ".$user_id.", '".serialize($_SESSION['panier'])."', 0)");
		unset($_SESSION['panier']);
		header("Location: index.php");
		exit;
	}
}

// if ($page == "admin") {
// 	if (!ft_admin()) {
// 		header("Location: index.php");
// 		exit;
// 	}
// }

if ($page == "admin_users") {
	// if (!ft_admin()) {
	// 	header("Location: index.php");
	// 	exit;
	// }
	if (isset($_GET['del_id'])) {
		$del_id = ceil($_GET['del_id']);
		mysqli_query($sql, "DELETE FROM users WHERE id = ".$del_id);
	}
	if (isset($_GET['modif_id'])) {
		$modif_id = ceil($_GET['modif_id']);
		mysqli_query($sql, "UPDATE users SET admin = admin + 1 WHERE id = ".$modif_id);
		mysqli_query($sql, "UPDATE users SET admin = 0 WHERE admin > 1");
	}
	if (isset($_GET['activ_id'])) {
		$activ_id = ceil($_GET['activ_id']);
		mysqli_query($sql, "UPDATE users SET desactivated = desactivated + 1 WHERE id = ".$activ_id);
		mysqli_query($sql, "UPDATE users SET desactivated = 0 WHERE desactivated > 1");
	}
}

if ($page == "admin_articles") {
	// if (!ft_admin()) {
	// 	header("Location: index.php");
	// 	exit;
	// }
	$id_categorie = ceil(@$_GET['id']);
	$retour = mysqli_query($sql, "SELECT * FROM categories WHERE id = ".$id_categorie);
	if (mysqli_num_rows($retour) == 0) {
		header("Location: admin_categories.php");
		exit;
	}
	$categorie = mysqli_fetch_assoc($retour);
	if (isset($_GET['del_id'])) {
		$del_id = ceil($_GET['del_id']);
		mysqli_query($sql, "DELETE FROM articles WHERE id = ".$del_id);
	}
	if (isset($_POST['modif'])) {
		$modif_id = ceil(@$_POST['id']);
		$name = $_POST['name'];
		$photo = $_POST['photo'];
		$price = ceil(@$_POST['price']);
		if ($name == "") {
			$msg = "Le nom de l'article est vide";
		} else if ($photo == "") {
			$msg = "L'url de la photo est vide";
		} else if ($price < 1) {
			$msg = "Le prix ne peut pas etre inferieur a 1 euro.";
		} else {
			$retour = mysqli_query($sql, "UPDATE articles SET name = '".$name."', photo = '".$photo."', price = ".$price." WHERE id = ".$modif_id);
		}
	}
}

if ($page == "admin_categories") {
	// if (!ft_admin()) {
	// 	header("Location: index.php");
	// 	exit;
	// }
	if (isset($_GET['del_id'])) {
		$del_id = ceil($_GET['del_id']);
		if (!$articles = mysqli_query($sql, "SELECT * FROM articles WHERE gamme = ".$del_id))
			$articles = mysqli_query($sql, "SELECT * FROM articles WHERE type = ".$del_id);
		if (mysqli_num_rows($articles) > 0) {
			$msg = "Il y a encore des articles dans cette categorie, vous ne pouvez donc pas la supprimer";
		} else {
			mysqli_query($sql, "DELETE FROM categories WHERE id = ".$del_id);
		}
	}
	if (isset($_POST['modif'])) {
		$modif_id = ceil(@$_POST['id']);
		$name = @$_POST['name'];
		if ($name == "") {
			$msg = "Le nom de la categorie est vide";
		} else {
			$retour = mysqli_query($sql, "UPDATE categories SET name = '".$name."' WHERE id = ".$modif_id);
		}
	}
	if (isset($_POST['add'])) {
		$name = @$_POST['name'];
		if ($name == "") {
			$msg = "Le nom de la categorie est vide";
		} else {
			$msg = "La categorie '".$name."' a bien ete ajoutee";
			mysqli_query($sql, "INSERT INTO categories VALUES (NULL, '".$name."')");
		}
	}
	if (isset($_POST['add2'])) {
		$categorie = ceil(@$_POST['categorie']);
		$name = @$_POST['name'];
		$photo = @$_POST['photo'];
		$price = ceil(@$_POST['price']);
		if (mysqli_num_rows(mysqli_query($sql, "SELECT id FROM categories WHERE id = ".$categorie)) == 0) {
			$msg = "Cette categorie n'existe pas";
		} else if ($name == "") {
			$msg = "Le nom de l'article est vide";
		} else if ($photo == "") {
			$msg = "L'url de la photo est vide";
		} else if ($price < 1) {
			$msg = "Le prix ne peut pas etre inferieur a 1 euro.";
		} else {
			$msg = "L'article '".$name."' a bien ete ajoutee";
			mysqli_query($sql, "INSERT INTO articles VALUES (NULL, ".$categorie.", '".$name."', '".$photo."', ".$price.")");
		}
	}
}

if ($page == "admin_orders") {
	// if (!ft_admin()) {
	// 	header("Location: index.php");
	// 	exit;
	// }
	if (isset($_GET['valid_id'])) {
		$valid_id = ceil($_GET['valid_id']);
		mysqli_query($sql, "UPDATE panier SET finished = finished + 1 WHERE id = ".$valid_id);
		mysqli_query($sql, "UPDATE panier SET finished = 0 WHERE finished > 1");
	}
	if (isset($_GET['del_id'])) {
		$del_id = ceil($_GET['del_id']);
		mysqli_query($sql, "DELETE FROM panier WHERE id = ".$del_id);
	}
}

if ($page == "admin_order") {
	// if (!ft_admin()) {
	// 	header("Location: index.php");
	// 	exit;
	// }
	$id_commande = ceil(@$_GET['id']);
	$retour = mysqli_query($sql, "SELECT * FROM shop WHERE id = ".$id_commande);
	if (mysqli_num_rows($retour) == 0) {
		header("Location: admin_orders.php");
		exit;
	}
	$commande = mysqli_fetch_assoc($retour);
	$content = unserialize($commande['content']);
}
?> 