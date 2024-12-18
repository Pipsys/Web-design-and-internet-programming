<?php
function generateTable() {
    echo "<table>";
    echo "<tr>
            <th>Число</th>
            <th>Квадрат</th>
            <th>Куб</th>
            <th>Квадратный корень</th>
          </tr>";

    for ($i = 1; $i <= 20; $i++) {
        $square = $i ** 2; 
        $cube = $i ** 3;   
        $sqrt = sqrt($i); 

        echo "<tr>
                <td>$i</td>
                <td>$square</td>
                <td>$cube</td>
                <td>" . number_format($sqrt, 2) . "</td>
              </tr>";
    }

    echo "</table>";
}
?>
