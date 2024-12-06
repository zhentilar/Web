<!DOCTYPE html>
<head>
    </head>
<body>
    <h1>MySQL</h1>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bote2024";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";

    // Create table query
    $sql = "CREATE TABLE IF NOT EXISTS Students (
        ogrno VARCHAR(20) PRIMARY KEY,
        isim VARCHAR(50),
        soyisim VARCHAR(50)
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table 'Students' created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }

    // List all databases
    $result = mysqli_query($conn, 'SHOW DATABASES');
    $dbs = array();
    while ($db = mysqli_fetch_row($result)) {
        $dbs[] = $db[0];
    }

    // Display the list of databases
    echo "<h3>List of Databases:</h3>";
    echo implode('<br/>', $dbs);
    ?>


</body>