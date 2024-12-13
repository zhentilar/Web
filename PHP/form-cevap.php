<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>MySQL Anket</title>
</head>
<body>
    <h1>Anket</h1>

    <form method="post" action="">
        <label>
            <input type="radio" name="cevap" value="Evet"> Evet
        </label><br>
        <label>
            <input type="radio" name="cevap" value="Hayır"> Hayır
        </label><br>
        <label>
            <input type="radio" name="cevap" value="Belki"> Belki
        </label><br><br>
        <input type="submit" value="Gönder">
    </form>

    <?php
    // Veritabanı bağlantı bilgileri
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bote2024";
    
    // Bağlantıyı oluştur
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Bağlantı başarısız: " . mysqli_connect_error());
    }
    echo "Veritabanına başarıyla bağlanıldı.<br>";

    // Cevaplar tablosunu oluştur
    $sql = "CREATE TABLE IF NOT EXISTS Cevaplar (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cevap ENUM('Evet', 'Hayır', 'Belki') NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Tablo başarıyla oluşturuldu.</p>";
    } else {
        echo "Tablo oluşturulurken hata oluştu: " . $conn->error . "<br>";
    }

    // Cevap ekleme işlemi
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cevap'])) {
        $cevap = $_POST['cevap'];
        $insert_query = "INSERT INTO Cevaplar (cevap) VALUES ('$cevap')";
        if ($conn->query($insert_query) === TRUE) {
            echo "<p>Cevabınız kaydedildi.</p>";
        } else {
            echo "<p>Cevap kaydedilirken hata oluştu: " . $conn->error . "</p>";
        }
    }

    // Toplam kayıt sayısını al
    $total_query = "SELECT COUNT(*) AS toplam FROM Cevaplar";
    $total_result = $conn->query($total_query);
    $total_row = $total_result->fetch_assoc();
    $total_count = $total_row['toplam'];

    // Her bir cevabın sayısını ve oranlarını hesapla
    $query = "SELECT cevap, COUNT(*) AS count FROM Cevaplar GROUP BY cevap";
    $result = $conn->query($query);

    $oranlar = [];
    while ($row = $result->fetch_assoc()) {
        $cevap = $row['cevap'];
        $count = $row['count'];
        $oranlar[$cevap] = $total_count > 0 ? ($count / $total_count) * 100 : 0;
    }

    // Oranları göster
    echo "<h2>Cevap Oranları</h2>";
    foreach ($oranlar as $cevap => $oran) {
        echo "<p>$cevap: " . "%" . number_format($oran, 2) . "</p>";
    }

    // Bağlantıyı kapat
    $conn->close();
    ?>
</body>
</html>
