<!DOCTYPE html>
<head>
    </head>

<body>
    <h1>File Open</h1>

    <?php
    $file = fopen("readme.txt", "w+") or die("Dosya açılamadı!");
    $text = "Satır 1\n";
    fwrite($file, $text);
    rewind($file);
    $data = fread($file, 64);
    echo $data;
    fclose($file);
    
    ?>
</body>