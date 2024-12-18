<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="../lab3_javascript_all/css/style.css">
    <title>Калькулятор</title>
    <meta charset="utf8">
    <style>
        .addition { background-color: #d4f1f4; }
        .subtraction { background-color: #f2d1d1; }
        .multiplication { background-color: #f7f7b8; }
        .division { background-color: #d0f7d0; }
        .sqrt { background-color: #f0e1f1; }
        .error { color: red; }
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
                <option value="sqrt">Квадратный корень</option>
            </select>
        </fieldset>
        <fieldset>
            <legend>Выберите операнд для квадратного корня</legend>
            <label><input type="radio" name="sqrt_operand" value="op1" checked> Операнд 1</label>
            <label><input type="radio" name="sqrt_operand" value="op2"> Операнд 2</label>
        </fieldset>
        <label><input type="checkbox" name="round_result"> Округлить результат до 3 знаков</label>
        <input type="submit" value="Вычислить">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST["op1"]) && (!empty($_POST["op2"]) || $_POST["s1"] === "sqrt")) {
            $op1 = $_POST["op1"];
            $op2 = $_POST["op2"] ?? null;
            $operation = $_POST["s1"];
            $round = isset($_POST["round_result"]);

            if (is_numeric($op1) && (is_numeric($op2) || $operation === "sqrt")) {
                $op1 = (float)$op1;
                $op2 = $op2 !== null ? (float)$op2 : null;

                // Выполнение операции
                switch ($operation) {
                    case "+":
                        $r = $op1 + $op2;
                        $class = "addition";
                        break;
                    case "-":
                        $r = $op1 - $op2;
                        $class = "subtraction";
                        break;
                    case "*":
                        $r = $op1 * $op2;
                        $class = "multiplication";
                        break;
                    case "/":
                        if ($op2 != 0) {
                            $r = $op1 / $op2;
                            $class = "division";
                        } else {
                            $r = "Ошибка: деление на ноль.";
                            $class = "error";
                        }
                        break;
                    case "sqrt":
                        $sqrt_operand = $_POST["sqrt_operand"];
                        if ($sqrt_operand === "op1" && $op1 >= 0) {
                            $r = sqrt($op1);
                            $class = "sqrt";
                        } elseif ($sqrt_operand === "op2" && $op2 !== null && $op2 >= 0) {
                            $r = sqrt($op2);
                            $class = "sqrt";
                        } else {
                            $r = "Ошибка: невозможно вычислить корень из отрицательного числа.";
                            $class = "error";
                        }
                        break;
                    default:
                        $r = "Операция не поддерживается";
                        $class = "error";
                }

                // Округление результата, если нужно
                if ($round && is_numeric($r)) {
                    $r = round($r, 3);
                }

                echo "<p class=\"$class\">Результат: $r</p>";

                // Запись операции в лог-файл
                $date = date("d.m.Y H:i:s");
                $round_status = $round ? "да" : "нет";
                $log_entry = "$date $op1 $operation $op2 = $r округление: $round_status\n";

                file_put_contents("calc.log", $log_entry, FILE_APPEND);

                // Вывод содержимого файла calc.log с разными фонами для операций
                echo "<h3>История операций:</h3>";
                if (file_exists("calc.log")) {
                    $log_contents = file_get_contents("calc.log");
                    $log_lines = explode("\n", $log_contents);
                    foreach ($log_lines as $line) {
                        if (!empty($line)) {
                            $line_parts = explode(" ", $line, 5);
                            $operation_type = trim($line_parts[3]);
                            $bg_class = "";

                            switch ($operation_type) {
                                case "+":
                                    $bg_class = "addition";
                                    break;
                                case "-":
                                    $bg_class = "subtraction";
                                    break;
                                case "*":
                                    $bg_class = "multiplication";
                                    break;
                                case "/":
                                    $bg_class = "division";
                                    break;
                                case "sqrt":
                                    $bg_class = "sqrt";
                                    break;
                            }

                            echo "<p class=\"$bg_class\">$line</p>";
                        }
                    }
                }
            }
        } else {
            echo "<p class=\"error\">Не все операнды определены</p>";
        }
    }
    ?>
</body>
</html>
