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
    <link rel="stylesheet" href="css/style.css">
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

        :root {
            --background-color: #141e30;
            --text-color: #fff;
            --card-background: #1e2b45;
            --button-background: linear-gradient(to right, #ff7e5f, #feb47b);
            --button-hover: linear-gradient(to right, #feb47b, #ff7e5f);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            position: fixed; 
            background-color: var(--card-background);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        footer {
            background-color: var(--card-background);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer a {
            color: #3498db;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .container {
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #3498db;
        }

        label {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 5px;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        input:disabled {
            background-color: #f0f0f0;
            cursor: not-allowed;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        .result {
            margin-top: 20px;
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>
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

<body>
    <div class="container">
        <h2>Проверка данных</h2>
        <form method="POST">
            <div class="section">
                <h3>Проверка сложности пароля</h3>
                <label for="password">Введите пароль:</label>
                <input type="text" name="password" id="password" placeholder="Введите пароль" value="<?= htmlspecialchars($password) ?>">
            </div>

            <div class="section">
                <h3>Проверка даты и времени</h3>
                <label for="dateInput">Введите дату (дд-мм-гггг чч:мм:сс):</label>
                <input type="text" name="dateInput" id="dateInput" placeholder="Введите дату" value="<?= htmlspecialchars($dateInput) ?>">
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

        <div class="section result">
            <h3>Результаты проверки даты</h3>
            <?php if ($dateValidation === null): ?>
                Пожалуйста, введите данные для проверки.
            <?php elseif ($dateValidation): ?>
                <span style="color: green;">Дата и время корректны.</span>
            <?php else: ?>
                <span style="color: red;">Некорректная дата или время.</span>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
