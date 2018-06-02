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

mysqli_query($sql, "CREATE TABLE cart
(
    id int(11) NOT NULL AUTO_INCREMENT,
    pdt_id int(11) NOT NULL,
    pdt_qty int(11) NOT NULL,
    pdt_cost int(11) NOT NULL,
    usr_id int(11) NOT NULL,
    cart_cost int(11) NOT NULL,
    paid bit NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");


mysqli_query($sql, "CREATE TABLE users
(
    id int(11) NOT NULL AUTO_INCREMENT,
    email text NOT NULL,
    passwd text NOT NULL,
    is_admin bit NOT NULL,
    desactivated bit NOT NULL,
    id_cart int(11) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

mysqli_query($sql, "CREATE TABLE categori
(
    id int(11) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

mysqli_query($sql, "CREATE TABLE category
(
    id int(11) NOT NULL AUTO_INCREMENT,
    cat_name text NOT NULL,
    PRIMARY KEY (id)--,
    -- CONSTRAINT name_unique UNIQUE (cat_name)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

mysqli_query($sql, "CREATE TABLE articles
(
    id int(11) NOT NULL AUTO_INCREMENT,
    id_category int(11) NOT NULL,
    id_type int(11) NOT NULL,
    pdt_name text NOT NULL,
    photo text NOT NULL,
    price int(11) NOT NULL,
    PRIMARY KEY (id)--,
    -- CONSTRAINT name_unique UNIQUE (name)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

/*  INSERTION INTO TABLES   */

/*  INSERT CATEGORIES   */

mysqli_query($sql, "INSERT INTO categories (name) VALUES ('type')");
mysqli_query($sql, "INSERT INTO categories (name) VALUES ('crayons')");
mysqli_query($sql, "INSERT INTO categories (name) VALUES ('feutres')");
mysqli_query($sql, "INSERT INTO categories (name) VALUES ('world')");

/*  INSERT ARTICLES */

mysqli_query($sql, "INSERT INTO articles VALUES (NULL, 124, 'Woodstock', 'https://media.cdnws.com/_i/25864/2304/1160/7/skateboard-skate-penny-nickel-complete-27-tie-dye-die-multicolore-flashy-pouces-pas-cher-woodstock.png', 152)");
mysqli_query($sql, "INSERT INTO articles VALUES (NULL, 124, 'Rasta', 'http://www.boardridersguide.com/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/p/e/penny-skateboard-rasta.jpg', 140)");

/*  INSERT USERS    */

mysqli_query($sql, "INSERT INTO users VALUES (NULL, 'clucas@student.42.fr', 'motdepasse', 1, 0)");
mysqli_query($sql, "INSERT INTO users VALUES (NULL, 'vbastion@student.42.fr', 'motdepasse', 1, 0)");

echo "database ok";

?> 