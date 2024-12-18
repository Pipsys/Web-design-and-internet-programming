<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Таблица чисел</title>
    
    <style>
        table {
            width: 60%;
            border-collapse: collapse;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
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
    <h1 style="text-align: center;">Таблица чисел, квадратов, кубов и квадратных корней</h1>
    <?php
    include 'tab.php'; 
    generateTable();
    ?>
</body>
</html>
