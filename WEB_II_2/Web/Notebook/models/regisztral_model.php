<?php
class Regisztral_Model
{
    public function create_user($vars)
    {
        $retData = ['eredmeny' => ''];
        try {
            $connection = Database::getConnection();
            // Ellenőrizd, hogy a kötelező mezők értékei megfelelőek-e
            if (isset($vars['csaladi_nev']) && isset($vars['utonev']) && isset($vars['login_nev']) && isset($vars['jelszo_reg'])) {
                // Ellenőrizd, hogy nincs-e már felhasználó ezzel a felhasználónévvel
                $query = "SELECT COUNT(*) AS user_count FROM felhasznalok WHERE bejelentkezes = :login";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(':login', $vars['login_nev']);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result['user_count'] > 0) {
                    $retData['eredmeny'] = 'ERROR: Már létezik felhasználó ezzel a bejelentkezéssel.';
                } else {
                    // Hozzáadás az adatbázishoz
                    $query = "INSERT INTO felhasznalok (csaladi_nev, utonev, bejelentkezes, jelszo) VALUES (:csaladi_nev, :utonev, :login, :password)";
                    $stmt = $connection->prepare($query);
                    $stmt->bindParam(':csaladi_nev', $vars['csaladi_nev']);
                    $stmt->bindParam(':utonev', $vars['utonev']);
                    $stmt->bindParam(':login', $vars['login_nev']);
                    $stmt->bindParam(':password', sha1($vars['jelszo_reg']));
                    $stmt->execute();

                    $retData['eredmeny'] = 'Sikeres regisztráció.';
                }
            } else {
                $retData['eredmeny'] = 'ERROR: Hiányzó kötelező mezők.';
            }
        } catch (PDOException $e) {
            $retData['eredmeny'] = 'ERROR: Adatbázis hiba: ' . $e->getMessage();
        }

        return $retData;
    }
}
?>