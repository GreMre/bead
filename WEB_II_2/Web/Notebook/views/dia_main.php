<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

    // Lekérdezés az adatbázisból
    $query = "SELECT gyarto, COUNT(*) as darab FROM processzor GROUP BY gyarto";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Adatok előkészítése Chart.js számára
    $labels = [];
    $data = [];

    foreach ($result as $row) {
        $labels[] = $row['gyarto'];
        $data[] = $row['darab'];
    }

    $chart_data = [
        'labels' => $labels,
        'datasets' => [
            [
                'data' => $data,
                'backgroundColor' => [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    // További színek hozzáadhatók szükség szerint
                ],
            ],
        ],
    ];

    // JSON kódolás a JavaScript számára
    $json_data = json_encode($chart_data);
} catch (PDOException $e) {
    echo "Hiba: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processzor Gyártó Arány</title>
</head>
<body>
    <!-- Kisebb méretű diagramhoz a canvas méretét állítsd be itt -->
    <canvas id="myChart" width="50" height="50" style="width: 50px; height: 50px;"></canvas>

    <script src="js/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Adatok betöltése a PHP scriptből
            var chartData = <?php echo $json_data; ?>;

            // Grafikon létrehozása
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar', // Kör diagram
                data: chartData,
            });
        });
    </script>
</body>
</html>
