<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="../lab3_javascript_all/css/style.css">
    <title>Генератор .htpasswd</title>
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
    <form method="post">
        <label>Логин <input type="text" placeholder="Введите логин" name="login" required></label>
        <label>Пароль <input type="password" placeholder="Введите пароль" name="password" required></label>
        <input type="submit" value="Создать">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!empty($login) && !empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            echo "<p>Сгенерированная строка: <code>{$login}:{$hashedPassword}</code></p>";
        } else {
            echo "<p class=\"error\">Логин и пароль не должны быть пустыми</p>";
        }
    }
    ?>
</body>
</html>
