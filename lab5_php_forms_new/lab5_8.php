<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../lab3_javascript_all/css/style.css">
    <title>Проверка даты и времени</title>
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

<h1>Проверка правильности даты и времени</h1>

<!-- Форма для ввода даты и времени -->
<form method="POST" action="">
    <label for="datetime">Введите дату и время (формат: ГГГГ-ММ-ДД ЧЧ:ММ:СС):</label>
    <input type="text" id="datetime" name="datetime" required>
    <button type="submit" name="submit">Проверить</button>
</form>

<?php
// Функция для проверки даты и времени
function validateDatetime($datetime) {
    // Проверяем формат даты и времени с помощью регулярного выражения
    if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $datetime)) {
        // Преобразуем строку в объект DateTime
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datetime);
        
        // Проверяем, является ли дата валидной
        if ($date && $date->format('Y-m-d H:i:s') === $datetime) {
            return true;
        }
    }
    return false;
}

// Проверяем, была ли отправлена форма
if (isset($_POST['submit'])) {
    // Получаем введенную дату и время
    $datetime = $_POST['datetime'];

    // Проверяем корректность введенной даты и времени
    if (validateDatetime($datetime)) {
        echo "<p>Дата и время \"$datetime\" корректны.</p>";
    } else {
        echo "<p>Ошибка! Введенная дата и время некорректны.</p>";
    }
}
?>

</body>
</html>
