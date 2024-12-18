<link rel="stylesheet" href="css/style.css">
<header>
        <nav>
            <ul class="menu-center">
                <li><a href="#">Просмотреть работы ▼</a>
                    <ul>
                        <li><a href="../home.html">Домашняя страница</a></li>
                        <li><a href="lab4_1.php">Лабораторная lab4_1</a></li>
                        <li><a href="lab4_2.php">Лабораторная lab4_2</a></li>
                        <li><a href="lab4_3.php">Лабораторная lab4_3</a></li>
                        <li><a href="lab4_4.php">Лабораторная lab4_4</a></li>
                        <li><a href="lab4_5.php">Лабораторная lab4_5</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
<?php
// Функция для извлечения всех цифр из строки
function extractDigits($inputString) {
    // Регулярное выражение для поиска всех цифр
    preg_match_all('/\d/', $inputString, $matches);
    return $matches[0];
}

// Пример строки
$inputString = "Пример строки с цифрами: 123abc456def789";

// Извлекаем цифры
$digits = extractDigits($inputString);

// Выводим результаты
echo "<h1>Анализ строки: \"$inputString\"</h1>";
if (!empty($digits)) {
    echo "<p>Найденные цифры: " . implode(', ', $digits) . "</p>";
    echo "<p>Количество цифр: " . count($digits) . "</p>";
} else {
    echo "<p>Цифры не найдены.</p>";
}
?>
