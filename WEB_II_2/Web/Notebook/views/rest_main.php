<?php

$url = "http://localhost/Notebook/RestS/szerver.php";
$result = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST['id'] = trim($_POST['id']);
    $_POST['gyarto'] = trim($_POST['gyarto']);
    $_POST['tipus'] = trim($_POST['tipus']);

    // Ellenőrizze, hogy minden mezőben van-e érték a PUT, POST, DELETE műveleteknél
    $fieldsAreNotEmpty = !empty($_POST['id']) && !empty($_POST['gyarto']) && !empty($_POST['tipus']);

    if ($_POST['action'] === 'GET' || ($fieldsAreNotEmpty && ($_POST['action'] === 'PUT' || $_POST['action'] === 'POST' || $_POST['action'] === 'DELETE'))) {
        $ch = curl_init();

        switch ($_POST['action']) {
            case "GET":
                // GET kérés küldése
                curl_setopt($ch, CURLOPT_URL, $url);
                break;

            case "POST":
                // POST kérés küldése
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
                break;

            case "PUT":
                // PUT kérés küldése
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
                break;

            case "DELETE":
                // DELETE kérés küldése
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
                break;
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);
    } else {
        $result = "Minden mező kitöltése szükséges a PUT, POST, DELETE műveleteknél.";
    }
}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processzorok kezelése</title>
    <style>
        table {
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Processzorok kezelése</h2>

    <!-- Űrlap az adatok bevitele és kezelése céljából -->
    <form method="post">
        <label>Azonosító:</label>
        <input type="text" name="id">
        <br>
        <label>Gyártó:</label>
        <input type="text" name="gyarto">
        <br>
        <label>Typus:</label>
        <input type="text" name="tipus">
        <br>
        <br>
        <!-- Különböző műveletek elvégzésére szolgáló gombok -->
        <input type="submit" name="action" value="GET">
        <input type="submit" name="action" value="POST">
        <input type="submit" name="action" value="PUT">
        <input type="submit" name="action" value="DELETE">
    </form>

    <!-- Események eredményének kiíratása -->
    <p><?php echo $result; ?></p>

    <?php
    // GET kérés esetén megjelenítjük a processzorok tábláját
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'GET' && !empty($result)) {
        echo $result;
    }
    ?>

</body>
</html>