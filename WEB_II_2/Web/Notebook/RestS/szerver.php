<?php

$eredmeny = "";

try {
    // Adatbázis kapcsolat létrehozása
    $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

    // HTTP kérés típusának ellenőrzése
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            // GET kérés esetén adatok lekérése a processzor táblából
            $sql = "SELECT * FROM processzor";
            $sth = $dbh->query($sql);

            // HTML táblázat készítése az adatokkal
            $eredmeny .= "<table style=\"border-collapse: collapse;\"><tr><th>Id</th><th>Gyártó</th><th>Typus</th></tr>";
            while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                $eredmeny .= "<tr>";
                foreach ($row as $column)
                    $eredmeny .= "<td style=\"border: 1px solid black; padding: 3px;\">" . $column . "</td>";
                $eredmeny .= "</tr>";
            }
            $eredmeny .= "</table>";
            break;

        case "POST":
            // POST kérés esetén új sor beszúrása a processzor táblába
            $sql = "INSERT INTO processzor VALUES (:id, :gyarto, :tipus)";
            $sth = $dbh->prepare($sql);
            $incoming = file_get_contents("php://input");
            parse_str($incoming, $data);
            $count = $sth->execute(array(":id" => $data["id"], ":gyarto" => $data["gyarto"], ":tipus" => $data["tipus"]));
            $newid = $dbh->lastInsertId();
            $eredmeny .= $count . " beszúrt sor: " . $newid;
            break;

        case "PUT":
            // PUT kérés esetén sor módosítása a processzor táblában
            $data = array();
            $incoming = file_get_contents("php://input");
            parse_str($incoming, $data);

            $modositando = "id=id";
            $params = array(":id" => $data["id"]);

            if ($data['gyarto'] != "") {
                $modositando .= ", gyarto = :gyarto";
                $params[":gyarto"] = $data["gyarto"];
            }

            if ($data['tipus'] != "") {
                $modositando .= ", tipus = :tipus";
                $params[":tipus"] = $data["tipus"];
            }

            $sql = "UPDATE processzor SET " . $modositando . " WHERE id=:id";
            $sth = $dbh->prepare($sql);
            $count = $sth->execute($params);
            $eredmeny .= $count . " módosított sor. Azonosítója:" . $data["id"];
            break;

        case "DELETE":
            // DELETE kérés esetén sor törlése a processzor táblában
            $data = array();
            $incoming = file_get_contents("php://input");
            parse_str($incoming, $data);

            $sql = "DELETE FROM processzor WHERE id=:id";
            $sth = $dbh->prepare($sql);
            $count = $sth->execute(array(":id" => $data["id"]));
            $eredmeny .= $count . " sor törölve. Azonosítója:" . $data["id"];
            break;
    }
} catch (PDOException $e) {
    $eredmeny = $e->getMessage();
}

echo $eredmeny;
?>
