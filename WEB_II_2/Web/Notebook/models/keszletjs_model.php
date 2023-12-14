<?php


switch($_POST['op']) {
    case 'oprec':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->query("SELECT oprendszer.id, oprendszer.nev FROM oprendszer INNER JOIN gep ON gep.oprendszerid = oprendszer.id GROUP BY oprendszer.nev");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "nev" => $row['nev']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
    case 'proc':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->query("select DISTINCT id, gyarto from processzor Group by gyarto");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "gyarto" => $row['gyarto']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;

      case 'gep':
        $eredmeny = array("lista" => array());
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
    
            $stmt = $dbh->prepare("SELECT gep.id, gep.gyarto FROM gep 
                                  INNER JOIN oprendszer ON gep.oprendszerid = oprendszer.id 
                                  INNER JOIN processzor ON processzor.id = gep.processzorid 
                                  WHERE processzor.gyarto = :gyarto AND oprendszer.nev = :nev
                                  GROUP BY gep.gyarto");
    
            $stmt->execute(array(":gyarto" => $_POST["proc"], ":nev" => $_POST["oprec"]));
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $eredmeny["lista"][] = array("id" => $row['id'], "gyarto" => $row['gyarto']);
            }
        } catch (PDOException $e) {
            // Kezelj hibát, például hibauzenet küldésével
        }
        echo json_encode($eredmeny);
        break;

        case 'First':
          $eredmeny = array("lista" => array());
          try {
              $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
              $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
              $stmt = $dbh->query("SELECT gep.gyarto, gep.tipus, gep.kijelzo, gep.memoria, gep.merevlemez, gep.videovezerlo, gep.ar, gep.db
                  FROM (gep INNER JOIN oprendszer on oprendszer.id = gep.oprendszerid)
                  INNER JOIN processzor on processzor.id = gep.processzorid");
           
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $eredmeny["lista"][] = array(
                      "gyarto" => $row['gyarto'],
                      "tipus" => $row['tipus'],
                      "kijelzo" => $row['kijelzo'],
                      "memoria" => $row['memoria'],
                      "merevlemez" => $row['merevlemez'],
                      "videovezerlo" => $row['videovezerlo'],
                      "ar" => $row['ar'],
                      "db" => $row['db']
                  );
              }
          } catch (PDOException $e) {
              // Kezelj hibát, például hibauzenet küldésével
          }
          echo json_encode($eredmeny);
          break;

          case 'Resp':
            $eredmeny = array("lista" => array());
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                $stmt = $dbh->prepare("SELECT gep.gyarto, gep.tipus, gep.kijelzo, gep.memoria, gep.merevlemez, gep.videovezerlo, gep.ar, gep.db
                    FROM (gep INNER JOIN oprendszer on oprendszer.id = gep.oprendszerid)
                    INNER JOIN processzor on processzor.id = gep.processzorid
                    WHERE processzor.gyarto = :gyarto AND oprendszer.nev = :nev AND gep.gyarto=:marka");
             $stmt->execute(array(":gyarto" => $_POST["proc"], ":nev" => $_POST["oprec"], ":marka" => $_POST["mark"]));
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $eredmeny["lista"][] = array(
                        "gyarto" => $row['gyarto'],
                        "tipus" => $row['tipus'],
                        "kijelzo" => $row['kijelzo'],
                        "memoria" => $row['memoria'],
                        "merevlemez" => $row['merevlemez'],
                        "videovezerlo" => $row['videovezerlo'],
                        "ar" => $row['ar'],
                        "db" => $row['db']
                    );
                }
            } catch (PDOException $e) {
                // Kezelj hibát, például hibauzenet küldésével
            }
            echo json_encode($eredmeny);
            break;
    
      
    
  }
?>
