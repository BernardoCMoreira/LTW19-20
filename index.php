<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>
        HomeFull
    </title>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
</head>

<body>
    <header>
        <h1> <a href="html/MainPage.html">HomeFull </a></h1>
        <img src="images/logo.png" alt="Logo " width="150" height="150" />
        <div id="signup">
            <a href="html/register.html">Register</a>
            <a href="html/login.html">Login</a>

        </div>
    </header>


    <nav id="menu">
        <ul>
            <li><a href="user.html">User</a></li>
            <li><a href="rents.html">Rents</a></li>
            <li><a href="AboutUs.html">AboutUs</a></li>
            <li><a href="contacts.html">Contacts</a></li>
        </ul>
    </nav>

<div id="properties">
<?php
    $db = new PDO('sqlite:database/database.db');

    $stmt = $db->prepare(
        'SELECT ownerID, propertyID, address, city, description, price
        FROM property');
    $stmt->execute();
    $properties = $stmt->fetchAll();

    foreach( $properties as $property) {
        writeProperty($property);
    }

    function writeProperty($property) {
        echo '<div id="property' . $property['propertyID'] . '"';
            echo '<h1> ID do dono: ' . $property['ownerID'] . '</h1>';
            echo '<p> Descição da propriedade: ' . $property['description'] . '</p>';
            echo '<p> Endereço da propriedade: ' . $property['address'] . '</p>';
            echo '<p> Cidade da propriedade: ' . $property['city'] . '</p>';
            echo '<p> Preço da propriedade: ' . $property['price'] . '</p>';
        echo '</div>';
    }
?>
</div>

    <aside id="searchBar">
        <label for="search">Search:</label>
        <input type="search" id="search">
        <br>
        <label for="Bedrooms">Bedrooms:</label>
        <select id="Bedrooms" name="Bedrooms">
            <option value="t0">T0</option>
            <option value="t1">T1</option>
            <option value="t2">T2</option>
            <option value="t3">T3</option>
            <option value="t4+">T4+</option>
        </select>
        <br>
        <label for="local">Location:</label>
        <select id="local" name="local" size="1">
            <option value="faro">Faro</option>
            <option value="lisboa">Lisboa</option>
            <option value="aveiro">Aveiro</option>
            <option value="porto">Porto</option>
            <option value="bragança">Bragança</option>
            <option value="santarém">Santarém</option>
            <option value="Coimbra">Coimbra</option>
            <option value="Covilha">Covilhã</option>
        </select>

    </aside>
    <section id="news">

    </section>

    <footer>
        <p>&copy; HomeFull, 2019</p>
    </footer>
</body>

</html>