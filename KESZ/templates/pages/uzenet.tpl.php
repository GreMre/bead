<?php

try {
  $dbh = new PDO('mysql:host=mysql.omega;dbname=beadtest', 'beadtest', 'Test123', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

} catch (PDOException $e) {
    print "Hiba: " . $e->getMessage() . "<br/>";
    die();
}


if(strlen($_POST['subject']) < 4 || strlen($_POST['subject']) > 32 )
{
  echo" Rossz adatok";
}else if (strlen($_POST['comment']) < 5 || strlen($_POST['comment']) > 500)
{

}else{
  if (isset($_POST['subject']) && isset($_POST['comment'])) {
    $subject = $_POST['subject'];
    $comment = $_POST['comment'];
    $time = date('Y-m-d H:i:s');

    if(isset($_SESSION["login"]))
    {
        $nev = $_SESSION["login"];
    }else 
    {
        $nev= "Vend�g";
    }
   
    $sqlInsert = "INSERT INTO uzenetek (Tema, Uzenet, Ido, Nev) VALUES (:tema, :uzenet, :ido, :nev)";
    $stmt = $dbh->prepare($sqlInsert); 
    $stmt->execute(array(':tema' => $subject, ':uzenet' => $comment, ':ido' => $time, ':nev' => $nev)); 
  }
}
?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Űrlap</title>
    <link rel="stylesheet" href="styles/urlap.css">
    
    <script type="text/javascript" src="logicals/java.js"></script>
  </head>
  <body>
    <div id="form">
      <form action="" method="post" onsubmit="return ellenoriz()">
      <p id=sujectr></p>
        <h2>Téma(4-30):</h2>
        <p id="subjectr"></p>
        <input type="text" id="subject" name="subject">
        <br>
        <p id=commentr></p>
        <H2>Komment(5-500):</H2>
        <p id="commentr"></p>
        <textarea id="comment" name="comment" ></textarea>

        <div class="kep">
        <img src="images/Kerdes.png" alt="Kép" style="border: none;">
        </div>

        <br>
        <button type="submit" onclick="ellenoriz()">Küldés</button>
      </form>
    </div>
  </body>
</html>