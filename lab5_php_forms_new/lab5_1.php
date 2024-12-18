<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="../lab3_javascript_all/css/style.css">
    <title>Калькулятор</title>
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
        <label>Операнд 1 <input type="text" placeholder="Введите первое число" name="op1"></label>
        <label>Операнд 2 <input type="text" placeholder="Введите второе число" name="op2"></label>
        <fieldset>
            <legend>Вид операции</legend>
            <select name="s1">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
        </fieldset>
        <input type="submit" value="Вычислить">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST["op1"]) && !empty($_POST["op2"])) {
            $op1 = $_POST["op1"];
            $op2 = $_POST["op2"];
            $operation = $_POST["s1"];

            if (is_numeric($op1) && is_numeric($op2)) {
                $op1 = (float)$op1;
                $op2 = (float)$op2;

                switch ($operation) {
                    case "+":
                        $r = $op1 + $op2;
                        break;
                    case "-":
                        $r = $op1 - $op2;
                        break;
                    case "*":
                        $r = $op1 * $op2;
                        break;
                    case "/":
                        if ($op2 != 0) {
                            $r = $op1 / $op2;
                        } else {
                            $r = "Ошибка: деление на ноль.";
                        }
                        break;
                    default:
                        $r = "Операция не поддерживается";
                }

                echo "<p>Результат: $r</p>";
            } else {
                echo "<p class=\"error\">Операнды должны быть числами</p>";
            }
        } else {
            echo "<p class=\"error\">Не все операнды определены</p>";
        }
    }
    ?>
</body>
</html>
