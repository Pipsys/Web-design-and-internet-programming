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

$S = "Davidov Igor";
$P = "Febr";

function findOccurrences($string, $substring) {
    $positions = [];
    $offset = 0;
    while (($pos = strpos($string, $substring, $offset)) !== false) {
        $positions[] = $pos;
        $offset = $pos + 1;   
    }
    return $positions;
}


function findOccurrencesOnEvenPositions($string, $substring) {
    $positions = [];
    $offset = 0;
    

    for ($i = 0; $i < strlen($string); $i++) {
        if ($i % 2 == 0) { // Проверяем, является ли позиция чётной
            // Ищем вхождение подстроки P начиная с позиции $i
            if (strpos($string, $substring, 0) === $i) {
               array_push($positions, $i); // Если подстрока найдена, добавляем позицию
            }
        }
    }
    return $positions;
}
$evenOccurrences = findOccurrencesOnEvenPositions($S, $P);

$charOccurrences = [];
foreach (str_split($P) as $char) {
    $charOccurrences[$char] = findOccurrences($S, $char);
}

$occurrences = findOccurrences($S, $P);

?>
<h1>Результаты поиска подстроки и символов в строке</h1>

<div class="results">
    <h2>1. Общее количество вхождений подстроки '<?php echo $P; ?>' в строку <?php echo $S; ?></h2>
    <table>
        <thead>
            <tr>
                <th>Количество вхождений</th>
                <th>Номера вхождений</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo count($occurrences); ?></td>
                <td><?php echo implode(", ", $occurrences); ?></td>
            </tr>
        </tbody>
    </table>

    <h2>2. Вхождения подстроки '<?php echo $P; ?>' на чётных позициях</h2>
    <table>
        <thead>
            <tr>
                <th>Количество вхождений на чётных позициях</th>
                <th>Номера вхождений на чётных позициях</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo count($evenOccurrences); ?></td>
                <td><?php echo implode(", ", $evenOccurrences); ?></td>
            </tr>
        </tbody>
    </table>

    <h2>3. Количество вхождений каждого символа из подстроки '<?php echo $P; ?>'</h2>
    <table>
        <thead>
            <tr>
                <th>Символ</th>
                <th>Количество вхождений</th>
                <th>Номера вхождений</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($charOccurrences as $char => $positions): ?>
                <tr>
                    <td><?php echo $char; ?></td>
                    <td><?php echo count($positions); ?></td>
                    <td><?php echo implode(", ", $positions); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
