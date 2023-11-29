<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>NB1</title>
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/stilus.css">
    <?php if($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="'.$viewData['style'].'">'; ?>
</head>
<body>
<header>
    <div id="user"><em><?= $_SESSION['userlastname']." ".$_SESSION['userfirstname'] ?></em></div>
    <h1 class="header">NB1-Játékoskeret</h1>
</header>
<nav>
    <?php echo Menu::getMenu($viewData['selectedItems']); ?>
</nav>
<aside>
    <p>Webpogramozás beadandó feladat</p>
    <p> Az oldalt készítették: Törőcsik Norbet és Mrena Gréta</p>
</aside>
<section>
    <?php if($viewData['render']) include($viewData['render']); ?>
</section>
<footer>&copy; NB1 Játékoskeret KFT. <?= date("Y") ?></footer>
</body>
</html>