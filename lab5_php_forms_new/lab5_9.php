<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    $dateInput = $_POST['dateInput'] ?? '';

    function evaluatePasswordStrength($password) {
        $score = 0;
        $criteria = [];

        // 1. Длина пароля
        $length = strlen($password);
        if ($length < 5) {
            $criteria[] = "Длина менее 5: 0 баллов";
        } elseif ($length >= 5 && $length <= 9) {
            $score += 1;
            $criteria[] = "Длина 5-9: 1 балл";
        } elseif ($length >= 10 && $length <= 12) {
            $score += 2;
            $criteria[] = "Длина 10-12: 2 балла";
        } else {
            $score += 3;
            $criteria[] = "Длина свыше 12: 3 балла";
        }

        // 2. Типы символов
        $types = 0;
        if (preg_match('/[a-zA-Z]/', $password)) $types++; // буквы
        if (preg_match('/\d/', $password)) $types++; // цифры
        if (preg_match('/[^a-zA-Z\d]/', $password)) $types++; // спецсимволы

        if ($types === 2) {
            $score += 1;
            $criteria[] = "2 типа символов: 1 балл";
        } elseif ($types === 3) {
            $score += 2;
            $criteria[] = "3 типа символов: 2 балла";
        }

        // 3. Регистр букв
        if (preg_match('/[a-z]/', $password) && preg_match('/[A-Z]/', $password)) {
            $score += 1;
            $criteria[] = "Регистр букв: 1 балл";
        }

        // 4. Иные символы
        $nonAlphanumericCount = preg_match_all('/[^a-zA-Z0-9]/', $password);
        if ($nonAlphanumericCount / $length > 0.3) {
            $score += 2;
            $criteria[] = "Иные символы > 30%: 2 балла";
        }

        // Итоговый результат
        return [
            'score' => $score,
            'criteria' => $criteria
        ];
    }

    function validateDateTime($dateInput) {
        $regex = '/^(\d{2})-(\d{2})-(\d{4}) (\d{2}):(\d{2}):(\d{2})$/';
        if (preg_match($regex, $dateInput, $matches)) {
            [$full, $day, $month, $year, $hour, $minute, $second] = $matches;
            $date = DateTime::createFromFormat('Y-m-d H:i:s', "$year-$month-$day $hour:$minute:$second");
            return $date && $date->format('Y-m-d H:i:s') === "$year-$month-$day $hour:$minute:$second";
        }
        return false;
    }

    $passwordResult = evaluatePasswordStrength($password);
    $dateValidation = validateDateTime($dateInput);
} else {
    $password = '';
    $dateInput = '';
    $passwordResult = ['score' => 0, 'criteria' => []];
    $dateValidation = null;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../lab3_javascript_all/css/style.css">
    <title>Проверка данных</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
            color: #333;
            padding-top: 0; 
        }
        .container {
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        h2 { margin-bottom: 20px; color: #3498db; }
        label { font-size: 1.1rem; color: #555; margin-bottom: 5px; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; }
        button { background-color: #3498db; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #2980b9; }
        .result { margin-top: 20px; font-size: 1.5rem; font-weight: bold; color: #2c3e50; }
    </style>
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
    <div class="container">
        <h2>Проверка данных</h2>
        <form method="POST">
            <div class="section">
                <h3>Проверка сложности пароля</h3>
                <label for="password">Введите пароль:</label>
                <input type="text" name="password" id="password" placeholder="Введите пароль" value="<?= htmlspecialchars($password) ?>">
            </div>

   

            <div class="button-container">
                <button type="submit">Проверить</button>
            </div>
        </form>

        <div class="section result">
            <h3>Результаты проверки пароля</h3>
            <strong>Итоговая оценка: <?= $passwordResult['score'] ?> баллов</strong><br>
            <strong>Подошедшие критерии:</strong><br>
            <?= implode('<br>', array_map('htmlspecialchars', $passwordResult['criteria'])) ?>
        </div>


    </div>
</body>
</html>
