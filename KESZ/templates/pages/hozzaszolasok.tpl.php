<?php
try {
    $dbh = new PDO('mysql:host=mysql.omega;dbname=beadtest', 'beadtest', 'Test123', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

} catch (PDOException $e) {
    print "Hiba: " . $e->getMessage() . "<br/>";
    die();
}

$sqlSelect = "SELECT * FROM uzenetek ORDER BY Ido DESC";
$stmt = $dbh->prepare($sqlSelect); 
$stmt->execute(); 
$uzenetek = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="logicals/hozz.css">
</head>
<body>
    <?php foreach ($uzenetek as $uzenet): ?>
   
        <div style="display: flex; align-items: center; justify-content: center;">
        <div style="margin: 10px; padding: 20px; width: 400px; border-radius: 30px; background-color: red; word-wrap: break-word;" class="wrapper">
             <div class="nev">By:<?= $uzenet['Nev'] ?>:</div><br>
		
		Subject: <?= $uzenet['tema'] ?>
		<br>
		<br>

            <?= $uzenet['uzenet'] ?>
        </div>
        </div>
    <?php endforeach; ?>
</body>
</html>