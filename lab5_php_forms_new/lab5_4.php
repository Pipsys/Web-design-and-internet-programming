<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="../lab3_javascript_all/css/style.css">
        
    <title>Запись и чтение строк</title>
    <meta charset="utf8">
</head>
<header>
    <nav>
        <ul class="menu-center">
            <li><a href="#">Просмотреть работы ▼</a>
                <ul>
                    <li><a href="../home.html">Домашняя страница</a></li>
                    <li><a href="lab5_1.php">Лабораторная lab5_1</a></li>
                    <li><a href="lab5_2.php">Лабораторная lab5_2</a></li>
                    <li><a href="lab5_3.php">Лабораторная lab5_3</a></li>
                    <li><a href="lab5_4.php">Лабораторная lab5_4</a></li>
                    <li><a href="lab5_5.php">Лабораторная lab5_5</a></li>
                    <li><a href="lab5_6.php">Лабораторная lab5_6</a></li>
                    <li><a href="lab5_7.php">Лабораторная lab5_7</a></li>
                    <li><a href="lab5_8.php">Лабораторная lab5_8</a></li>
                    <li><a href="lab5_9.php">Лабораторная lab5_9</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<body>
    <h2>Запись и чтение строк</h2>
    <?php  
        $file = 'test_strings.txt';  

        // Новые данные, которые нужно добавить в файл
        define("divider", "|");
        $logdate = date("d.m.y G:i:s");
        $serviceNumber = 898820;
        $person = "John Smith";
        $log = $logdate . divider . $serviceNumber . divider . $person . "\n";

        // Пишем содержимое в файл, используя флаг FILE_APPEND для добавления данных в конец файла
        // и флаг LOCK_EX для предотвращения записи файла другими процессами в это время
        if ($bytes = file_put_contents($file, $log, FILE_APPEND | LOCK_EX)) {
            echo "Успешная запись $bytes байт";
        }

        $fullname = realpath($file);
        echo "<p>Файл $fullname содержит данные</p>";

        // Чтение содержимого файла
        if ($content = file_get_contents($file)) {
            echo "<p>Успешное чтение " . strlen($content) . " байт</p>";
            
            // Разделяем содержимое на строки
            $lines = explode("\n", $content);
            
            // Выводим каждую строку в отдельном теге <p>
            echo "<div>";
            foreach ($lines as $line) {
                if (!empty($line)) {
                    echo "<p>" . htmlspecialchars($line) . "</p>";
                }
            }
            echo "</div>";
        }
        ?>
</body>
</html>
