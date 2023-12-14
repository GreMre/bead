<?php

class Keszlet_Model
{
    public function getKeszletAdatok()
    {
        // Itt kell megírni a lekérdezést, amely lekéri a készletek adatait
        // Összekapcsolásokkal, például INNER JOIN használatával

        $connection = Database::getConnection();
        $sql = "SELECT g.*, p.gyarto AS processzor_tipus, o.nev AS oprendszer_nev FROM gep AS g
                INNER JOIN processzor AS p ON g.processzorid = p.id
                INNER JOIN oprendszer AS o ON g.oprendszerid = o.id";

        $stmt = $connection->query($sql);
        $keszletAdatok = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $keszletAdatok;
    }


}
