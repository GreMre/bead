<?php
$ablakcim = array(
    'cim' => 'Filmadatbázis',
);

$fejlec = array(
    'kepforras' => 'film.jpg',
    'kepalt' => 'logo',
	'cim' => 'Filmadatbázis',
	'motto' => ''
);

$lablec = array(
    'copyright' => 'Copyright '.date("Y").'.',
    'ceg' => 'Filmek Kft.'
);



$oldalak = array(
    '/' => array('fajl' => 'cimlap', 'szoveg' => 'Cimlap', 'menun' => array(1,1)),
    'filmek' => array('fajl' => 'filmek', 'szoveg' => 'Filmek', 'menun' => array(1,1)),
    'palyazat' => array('fajl' => 'palyazat', 'szoveg' => 'Palyazat', 'menun' => array(1,1)),
    'hozzaszolasok' => array('fajl' => 'hozzaszolasok', 'szoveg' => 'Hozzaszolasok', 'menun' => array(1,1)),
    'esemenyek' => array('fajl' => 'esemenyek', 'szoveg' => 'Esemenyek', 'menun' => array(1,1)),
    'premierek' => array('fajl' => 'premierek', 'szoveg' => 'Premierek', 'menun' => array(1,1)),
    'kapcsolat' => array('fajl' => 'kapcsolat', 'szoveg' => 'Kapcsolat', 'menun' => array(1,1)),
    'uzenet' => array('fajl' => 'uzenet', 'szoveg' => 'Uzenet', 'menun' => array(1,1)),
    'belepes' => array('fajl' => 'belepes', 'szoveg' => 'Belepes', 'menun' => array(1,0)),
    'kilepes' => array('fajl' => 'kilepes', 'szoveg' => 'Kilepes', 'menun' => array(0,1)),
    'belep' => array('fajl' => 'belep', 'szoveg' => '', 'menun' => array(0,0)),
    'regisztral' => array('fajl' => 'regisztral', 'szoveg' => '', 'menun' => array(0,0))
);

$hiba_oldal = array ('fajl' => '404', 'szoveg' => 'A keresett oldal nem található!');
?>