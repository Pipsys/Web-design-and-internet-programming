<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../lab3_javascript_all/css/style.css">
    <title>Определение цифр в строке</title>
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

<h1>Определение цифр в строке</h1>

<!-- Форма для ввода строки -->
<form method="POST" action="">
    <label for="inputString">Введите строку:</label>
    <input type="text" id="inputString" name="inputString" required>
    <button type="submit" name="submit">Определить цифры</button>
</form>

<?php
// Функция для извлечения всех цифр из строки
function extractDigits($inputString) {
    // Регулярное выражение для поиска всех цифр
    preg_match_all('/\d/', $inputString, $matches);
    return $matches[0];
}

// Проверяем, была ли отправлена форма
if (isset($_POST['submit'])) {
    // Получаем введенную строку
    $inputString = $_POST['inputString'];

    // Извлекаем цифры
    $digits = extractDigits($inputString);

    // Выводим результаты
    echo "<h2>Анализ строки: \"$inputString\"</h2>";
    if (!empty($digits)) {
        echo "<p>Найденные цифры: " . implode(', ', $digits) . "</p>";
        echo "<p>Количество цифр: " . count($digits) . "</p>";
    } else {
        echo "<p>Цифры не найдены.</p>";
    }
}
?>

</body>
</html>
