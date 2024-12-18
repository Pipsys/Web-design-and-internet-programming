<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="../lab3_javascript_all/css/style.css">
    <style>
        /* Стили для радиокнопок */
        .radio-container {
            display: inline-block;
            margin-right: 20px;
            position: relative;
            vertical-align: middle; /* Для выравнивания с текстом */
        }

        input[type="radio"] {
            display: none;
        }

        label {
            position: relative;
            padding-left: 35px; /* Отступ для метки, чтобы радиокнопка была слева */
            cursor: pointer;
            font-size: 16px;
            color: #333;
            display: inline-block;
            vertical-align: middle; /* Чтобы текст и радиокнопка были на одном уровне */
        }

        label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid transparent;
            background: linear-gradient(to bottom right, #FF7043, #FF5722); /* Оранжевый градиент */
            transition: all 0.3s ease-in-out;
        }

        input[type="radio"]:checked + label::after {
            content: '';
            position: absolute;
            left: 6px;
            top: 50%;
            transform: translateY(-50%);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #fff; /* Белая точка внутри радиокнопки */
        }

        input[type="radio"]:hover + label::before {
            border-color: #FF5722; /* Оранжевая граница при наведении */
        }

        /* Анимация для радиокнопок */
        input[type="radio"]:checked + label::before {
            background: linear-gradient(to bottom right, #FF5722, #FF7043); /* Перевернутый градиент */
        }

        input[type="radio"]:checked + label {
            font-weight: bold;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .radio-container label {
            font-weight: normal;
        }

        /* Стили для таблицы */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e9e9e9;
        }
    </style>
    <title>Калькулятор и генератор .htpasswd</title>
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

    <form action="" method="POST">
        <div class="form-section">
            <input type="text" id="fullname" name="fullname" placeholder="Введите ФИО" required><br><br>
        </div>

        <div class="form-section">
            <select id="faculty" name="faculty" required>
                <option value="Факультет 1">Факультет 1</option>
                <option value="Факультет 2">Факультет 2</option>
                <option value="Факультет 3">Факультет 3</option>
            </select><br><br>
        </div>

        <div class="form-section">
            <div class="radio-container">
                <input type="radio" id="male" name="gender" value="Мужской" required>
                <label for="male">Мужской</label>
            </div>
            <div class="radio-container">
                <input type="radio" id="female" name="gender" value="Женский" required>
                <label for="female">Женский</label>
            </div>
            <br><br>
        </div>

        <input type="submit" value="Отправить">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $file = 'text.txt';

        $logdate = date("d.m.y G:i:s");
        $fullname = htmlspecialchars($_POST['fullname']);
        $faculty = htmlspecialchars($_POST['faculty']);
        $gender = htmlspecialchars($_POST['gender']);
        $log = $logdate . " | " . $fullname . " | " . $faculty . " | " . $gender . "\n";

        // Пишем данные в файл
        define("divider", "|");
        if ($bytes = file_put_contents($file, $log, FILE_APPEND | LOCK_EX)) {
            echo "<p>Успешная запись $bytes байт</p>";
        }

        $fullname = realpath($file);
        echo "<p>Файл $fullname содержит данные</p>";
    }

    // Выводим данные из файла в таблице
    $file = 'text.txt';
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $lines = explode("\n", $content);

        if (count($lines) > 0) {
            echo '<table>';
            echo '<thead><tr><th>Дата и время</th><th>ФИО</th><th>Факультет</th><th>Пол</th></tr></thead>';
            echo '<tbody>';
            foreach ($lines as $line) {
                if (trim($line) !== "") {
                    $fields = explode(" | ", $line);
                    echo '<tr>';
                    foreach ($fields as $field) {
                        echo '<td>' . htmlspecialchars($field) . '</td>';
                    }
                    echo '</tr>';
                }
            }
            echo '</tbody>';
            echo '</table>';
        }
    }
    ?>
</body>
</html>
