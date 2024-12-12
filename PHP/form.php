<!DOCTYPE html>
<head>
    </head>
    <body>
        <h1>Lab Gorev</h1>

        <form name='form' method='post' action="form.php">
        Text: <input type="text" name="text" id="text" ><br/>
        <input type="submit" name="submit" value="Kaydet"> 
        <input type="submit" name="submit" value="Sil">
        <input type="submit" name="submit" value="Getir">
        </form>

        <?php
        $button = $_POST['submit'];
        $filePath = "texts.txt";
    
        if ($button == 'Kaydet') {
            $text = $_POST['text'];
            file_put_contents($filePath, 
            $text . PHP_EOL, 
            FILE_APPEND);
            echo "Kaydedildi";
        }
        else if ($button == 'Sil') {
            file_put_contents($filePath, '');
            echo "Silindi";
        }
        else if ($button == 'Getir') {
            $lines = file($filePath, 
            FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $randomLine = $lines[array_rand($lines)];
            echo "<p>Rastgele metin: \"$randomLine\"</p>";
        }
        ?>
    </body>