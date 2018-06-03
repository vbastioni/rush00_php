<?PHP 

// Command docker 
// Init container
// docker run -it -d --name rush00-mysql -e MYSQL_ROOT_PASSWORD=root -p 3306:3306 mysql:5.7

// Start container
// docker start rush00-mysql

// Reset container
// docker rm -f rush00-mysql

$sql = mysqli_connect('192.168.99.100:3306', 'root', 'root'); 
if (!$sql)
    die("Connection Failed:".mysqli_connect_error());
    
mysqli_query($sql, "CREATE DATABASE IF NOT EXISTS ft_minishop");
mysqli_query($sql, "USE ft_minishop");

mysqli_query($sql, "CREATE TABLE panier
(
    id int(6) NOT NULL AUTO_INCREMENT,
    id_user int(6) NOT NULL,
    content text NOT NULL,
    finished int(6) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");


mysqli_query($sql, "CREATE TABLE users
(
    id int(11) NOT NULL AUTO_INCREMENT,
    email text NOT NULL,
    password text NOT NULL,
    admin bit NOT NULL,
    desactivated bit NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

mysqli_query($sql, "CREATE TABLE categories (
    id int(11) NOT NULL AUTO_INCREMENT,
    name text NOT NULL,
    PRIMARY KEY (id)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1");

mysqli_query($sql, "CREATE TABLE articles (
	id int(11) NOT NULL AUTO_INCREMENT,
	id_category int(11) NOT NULL,
	name text NOT NULL,
	photo text NOT NULL,
	price int(11) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");


/*  INSERTION INTO TABLES   */

/*  INSERT CATEGORIES   */

mysqli_query($sql, "INSERT INTO categories (name) VALUES ('type')");
mysqli_query($sql, "INSERT INTO categories (name) VALUES ('crayons')");
mysqli_query($sql, "INSERT INTO categories (name) VALUES ('feutres')");
mysqli_query($sql, "INSERT INTO categories (name) VALUES ('world')");

/*  INSERT ARTICLES */

mysqli_query($sql, "INSERT INTO articles VALUES (NULL, 1, 'Woodstock', 'https://media.cdnws.com/_i/25864/2304/1160/7/skateboard-skate-penny-nickel-complete-27-tie-dye-die-multicolore-flashy-pouces-pas-cher-woodstock.png', 152)");
mysqli_query($sql, "INSERT INTO articles VALUES (NULL, 1, 'Rasta', 'http://www.boardridersguide.com/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/p/e/penny-skateboard-rasta.jpg', 140)");

/*  INSERT USERS    */

mysqli_query($sql, "INSERT INTO users VALUES (NULL, 'clucas@student.42.fr', '06948D93CD1E0855EA37E75AD516A250D2D0772890B073808D831C438509190162C0D890B17001361820CFFC30D50F010C387E9DF943065AA8F4E92E63FF060C', 1, 0)");
mysqli_query($sql, "INSERT INTO users VALUES (NULL, 'vbastion@student.42.fr', '06948D93CD1E0855EA37E75AD516A250D2D0772890B073808D831C438509190162C0D890B17001361820CFFC30D50F010C387E9DF943065AA8F4E92E63FF060C', 1, 0)");

echo "database ok";

?>