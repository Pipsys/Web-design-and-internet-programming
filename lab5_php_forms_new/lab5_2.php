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
                    case "sqrt":
                        $sqrt_operand = $_POST["sqrt_operand"];
                        if ($sqrt_operand === "op1" && $op1 >= 0) {
                            $r = sqrt($op1);
                        } elseif ($sqrt_operand === "op2" && $op2 !== null && $op2 >= 0) {
                            $r = sqrt($op2);
                        } else {
                            $r = "Ошибка: невозможно вычислить корень из отрицательного числа.";
                        }
                        break;
                    default:
                        $r = "Операция не поддерживается";
                }

                if ($round && is_numeric($r)) {
                    $r = round($r, 3);
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
