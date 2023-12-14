<?php

//alkalmazás gyökér könyvtára a szerveren
define('SERVER_ROOT', $_SERVER['DOCUMENT_ROOT'].'/Notebook/');

//URL cím az alkalmazás gyökeréhez
define('SITE_ROOT', 'http://localhost/Notebook/');

// a router.php vezérlõ betöltése
require_once(SERVER_ROOT . 'controllers/' . 'router.php');

?>