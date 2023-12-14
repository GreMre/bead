<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $method = $_POST['method'];
    $url = "https://gorest.co.in/public-api/users";
    $access_token = "f397fac59a5584161d316ac0e6fafa49e9983e82f8d04a5ab6139f2317c4be59";

    $ch = curl_init();

    switch ($method) {
        case 'GET':
            // GET kérés küldése
            curl_setopt($ch, CURLOPT_URL, $url . "?access-token=" . $access_token);
            break;

        case 'POST':
        case 'PUT':
        case 'DELETE':
            // Ellenőrizzük, hogy a kötelező mezők ne legyenek üresek
            $required_fields = ['name', 'gender', 'email', 'status'];

            if ($method === 'PUT' || $method === 'DELETE') {
                // Ha a PUT vagy DELETE kérés, ellenőrizzük az "id" mezőt
                $required_fields[] = 'id';
            }

            $missing_fields = array_diff($required_fields, array_keys($_POST));

            if (!empty($missing_fields)) {
                echo "Hiányzó mezők: " . implode(', ', $missing_fields);
                exit;
            }

            // POST, PUT és DELETE kérések küldése
            $data = array(
                "id" => $_POST['id'],
                "name" => $_POST['name'],
                "gender" => $_POST['gender'],
                "email" => $_POST['email'],
                "status" => $_POST['status']
            );

            curl_setopt($ch, CURLOPT_URL, $url . "?access-token=" . $access_token);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            break;

        default:
            echo "Érvénytelen kérés típusa.";
            exit;
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    // Kiírjuk a választ
    echo $result;
} else {
    echo "Érvénytelen kérés.";
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Kliens</title>
</head>
<body>
    <h1>API Kliens</h1>

    <form action="" method="post">
        <label for="method">Kérés típusa:</label>
        <select name="method" id="method">
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
        </select>
        <br>

        
            <label for="id">ID:</label>
            <input type="text" name="id">
            <br>
        

        <label for="name">Név:</label>
        <input type="text" name="name">
        <br>

        <label for="gender">Nem:</label>
        <select name="gender">
            <option value="male">Férfi</option>
            <option value="female">Nő</option>
        </select>
        <br>

        <label for="email">E-mail:</label>
        <input type="text" name="email">
        <br>

        <label for="status">Státusz:</label>
        <select name="status">
            <option value="active">Aktív</option>
            <option value="inactive">Inaktív</option>
        </select>
        <br>

        <input type="submit" value="Küldés">
    </form>
</body>
</html>
