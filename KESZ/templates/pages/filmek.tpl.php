<?php
if(isset($_SESSION["csn"])  && isset($_SESSION["un"])  && isset($_SESSION["login"])  )
{
    $upload_dir = 'kepek/'; 

if(isset($_POST['submit'])) {
    $upload_files = $_FILES['upload_files'];
    $errors = array();
    
    foreach($upload_files['tmp_name'] as $key => $tmp_name) {
        $file_name = $upload_files['name'][$key];
        $file_size = $upload_files['size'][$key];
        $file_tmp = $upload_files['tmp_name'][$key];
        $file_type = $upload_files['type'][$key];
        
       
        if($file_type != 'image/jpeg' && $file_type != 'image/png') {
            $errors[] = 'Csak JPG és PNG formátumú fájlok tölthetők fel!';
        }
        
        
        if($file_size > 5*1024*1024) { 
            $errors[] = 'A fájl mérete nem lehet nagyobb, mint 5 MB!';
        }
        
       
        if(empty($errors)) {
            move_uploaded_file($file_tmp, $upload_dir . $file_name);
        }
    }
    
    
    if(!empty($errors)) {
        foreach($errors as $error) {
            echo $error . '<br>';
        }
    } else {
        echo 'A fájlok sikeresen feltöltve!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Képfeltöltés</title>
</head>
<body>
    <div id="feltolt">
    <h1>Képfeltöltés</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="upload_files[]" multiple>
        <br><br>
        <input type="submit" name="submit" value="Feltöltés">
    </form>

    </div>
    
</body>
</html>
<?php
}
?>



<?php
$MAPPA = 'kepek/'; 
$TIPUSOK = array ('.jpg', '.png'); 
$MEDIATIPUSOK = array('image/jpeg', 'image/png');
$DATUMFORMA = "Y.m.d. H:i";

$MAXMERET = 500*1024;


$kepek = array();
$olvaso = opendir($MAPPA);
while (($fajl = readdir($olvaso)) !== false) {
 if (is_file($MAPPA.$fajl)) { 
 $vege = strtolower(substr($fajl, strlen($fajl)-4));
 if (in_array($vege, $TIPUSOK)) 
 $kepek[$fajl] = filemtime($MAPPA.$fajl);
}
}
closedir($olvaso);

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<title>Galéria</title>
<link rel="stylesheet" href="styles/test.css">
</head>
<body>
<div id="galeria">
<h1>Galéria</h1>
<?php
arsort($kepek);
foreach($kepek as $fajl => $datum)
{
    ?>
   <div class="kep">
   <a href="<?php echo $MAPPA.$fajl ?>">
<img src="<?php echo $MAPPA.$fajl ?>">
</a>

</div>
<?php
 }
 ?>
</div>
</body>
</html>