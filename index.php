<?php
$logged = true;
?>

<html>
<head>
    <title>ft_minishop</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/header.css">
</head>
<body>
    <header>
        <nav id="left-nav">
            <ul>
                <li class="cat_a"><a>SANDWICHS</a>
                    <ul class="submenu">
                        <li><a>Club Poulet C&eacute;sar</a></li>
                        <li><a>Pain aux c&eacute;r&eacute;ales jambon crudit&eacute;s</a></li>
                        <li><a>Wrap bacon laitue tomate</a></li>
                        <li><a>Navette fromage frais</a></li>
                        <li><a>Navette jambon beurre</a></li>
                    </ul>
                </li>
                <li class="cat_b"><a>SOUPES &amp; SALADES</a>
                    <ul class="submenu">
                        <li><a>Soupe carotte coriandre BIO</a></li>
                        <li><a>Salade chou asiatique</a></li>
                        <li><a>Salade de lentilles saumon sauce gravlax</a></li>
                    </ul>
                </li>
                <li class="cat_b"><a>CHAUD</a>
                    <ul class="submenu">
                        <li><a>Croque-monsieur</a></li>
                        <li><a>Quiche saumon fum&eacute; &eacute;pinards</a></li>
                        <li><a>Risotto aux champignons et poulet</a></li>
                        <li><a>Raviolinnis aux trois fromages</a></li>
                        <li><a>Plat cuisin&eacute; de chef bobo BIO</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav id="right-nav">
            <ul>
<?php
if ($logged === false) 
    echo "<li><a class=\"cat_d\">LOGIN / REGISTER</a></li>\n";
else
    echo "<li class=\"cat_d\">
<a>Account</a>
<ul class=\"submenu\">
<li><a>Profile</a></li>
<li><a>SIGN OUT</a></li>
</ul>
</li>\n";
?>
            </ul>
        </nav>
    </header>
    <div class="container"></div>
    <footer>
        &copy; clucas - vbastion 2018
    </footer>
</body>
</html>