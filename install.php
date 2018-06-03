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
    email VARCHAR(255) NOT NULL UNIQUE,
    password text NOT NULL,
    admin bit NOT NULL,
    desactivated bit NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

mysqli_query($sql, "CREATE TABLE categories (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `cat_type` bit NOT NULL,
    `name` VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1");

mysqli_query($sql, "CREATE TABLE articles (
	id int(11) NOT NULL AUTO_INCREMENT,
    gamme int(2) NOT NULL,
    type int(2) NOT NULL,
	name VARCHAR(255) NOT NULL UNIQUE,
	photo text NOT NULL,
	price int(11) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");


/*  INSERTION INTO TABLES   */

/*  INSERT CATEGORIES   */

mysqli_query($sql, "INSERT INTO categories (name, cat_type)
                    VALUES ('Crayons graphite', 0),
                            ('Crayons de couleur', 0),
                            ('Feutres', 0),
                            ('Sets', 0),
                            ('Craie', 0),
                            ('Fusains', 0),
                            ('Gommes', 0),
                            ('Equipement', 0),
                            ('Albrecht D&uuml;rer', 1),
                            ('Albrecht D&uuml;rer Magnus', 1),
                            ('Pastel PITT', 1),
                            ('Pitt Monochrome', 1),
                            ('Polychromos', 1),
                            ('Castell 9000', 1),
                            ('Pitt Artist Pens', 1),
                            ('Sans Gamme', 1)");

/*  INSERT ARTICLES */
$root = dirname($_SERVER['PHP_SELF']);
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayon Polychromos coffret bois de 120 pieces', 13, 2, '$root/img/110013_10_PM1.jpg', 350)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayon Polychromos boîte métal de 24 pièces', 13, 2, '$root/img/110024_10_PM1.jpg', 43)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayon Polychromos boîte métal de 36 pièces', 13, 2, '$root/img/110036_10_PM1.jpg', 65)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayon Polychromos studio box de 36 pièces', 13, 2, '$root/img/110038_10_PM1.jpg', 70)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayon Polychromos boîte métal de 60 pièces', 13, 2, '$root/img/110060_10_PM1.jpg', 115)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayon Polychromos boîte métal de 12 pièces', 13, 2, '$root/img/110012_10_PM3.jpg', 22)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayon Polychromos boîte métal de 120 pièces', 13, 2, '$root/img/110011_10_PM1.jpg', 225)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayon Polychromos coffret bois de 72 pièces', 13, 2, '$root/img/110072_10_PM1.jpg', 290)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Pot x 68 crayons Polychromos', 13, 2, '$root/img/210050_10_PM1.jpg', 130)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayons A. Dürer Magnus boîte de métal de 24', 10, 2, '$root/img/116924_10_PM3.jpg', 70)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayons A. Dürer Magnus boîte de métal de 12', 10, 2, '$root/img/116912_10_PM3.jpg', 35)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Coffret bois A. Dürer Magnus x30+acc.', 10, 2, '$root/img/116900_10_PM1.jpg', 135)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayon Pitt Pastel boîte métal de 12 pièces', 11, 2, '$root/img/112112_10_PM3.jpg', 21)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayon Pitt Pastel boîte métal de 24 pièces', 11, 2, '$root/img/112124_10_PM1.jpg', 43)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayon Pitt Pastel boîte métal de 36 pièces', 11, 2, '$root/img/112136_10_PM1.jpg', 63)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Crayon Pitt Pastel boîte métal de 60 pièces', 11, 2, '$root/img/112160_10_PM1.jpg', 102)");
mysqli_query($sql, "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('Blister de 3 crayons Pitt Pastel', 11, 2, '$root/img/112797_10_PM1.jpg', 6)");
/*  INSERT USERS    */

mysqli_query($sql, "INSERT INTO users VALUES (NULL, 'clucas@student.42.fr', '06948D93CD1E0855EA37E75AD516A250D2D0772890B073808D831C438509190162C0D890B17001361820CFFC30D50F010C387E9DF943065AA8F4E92E63FF060C', 1, 0)");
mysqli_query($sql, "INSERT INTO users VALUES (NULL, 'vbastion@student.42.fr', '06948D93CD1E0855EA37E75AD516A250D2D0772890B073808D831C438509190162C0D890B17001361820CFFC30D50F010C387E9DF943065AA8F4E92E63FF060C', 1, 0)");

echo "database ok";

?>