<!DOCTYPE html>
<html>
<body>
<style>
    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 10px;
    }
    </style>
<?php
echo "Tek Sayılar:\n";
for ($i = 0; $i <= 100; $i++) 
{ 
    if ($i % 2 == 0) 
    {
        continue;
    }
    else 
    {
        echo "$i\n";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $satir_sayi = $_POST['satir_sayi'];
    $sutun_sayi = $_POST['sutun_sayi'];

    echo "<table>";
    for ($i = 0; $i < $satir_sayi; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $sutun_sayi; $j++) {
            $random = rand(1, 100);
            echo "<td>$random</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>
<form method="post">
        Satır Sayısı: <input type="number" name="satir_sayi" min="1" required><br>
        Sütun Sayısı: <input type="number" name="sutun_sayi" min="1" required><br>
        <input type="submit" value="Tabloyu Oluştur">
    </form>
</body>
</html>