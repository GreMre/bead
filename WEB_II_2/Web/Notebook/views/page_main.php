<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MVC - PHP</title>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/main_style.css">
        <?php if($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="'.$viewData['style'].'">'; ?>
    </head>
    <body>
        <header>
            <div id="user"><em><?= $_SESSION['userlastname']." ".$_SESSION['userfirstname'] ?></em></div>
            <div class="container">
            <h1 class="header">LaptopLand</h1>
		<div class="logo"><img src="img/logo.png" alt="Kép leírása"></div>
            </div>
            
        </header>
        <nav>
            <?php echo Menu::getMenu($viewData['selectedItems']); ?>
        </nav>
        <aside>
        <div class="container">
        <div class="kep"><img src="img/aside/1.jpg" alt="Kép leírása"></div>
            </div>
            <div class="container">
        <div class="kep"><img src="img/aside/2.jpg" alt="Kép leírása"></div>
            </div>
            <div class="container">
        <div class="kep"><img src="img/aside/3.jpg" alt="Kép leírása"></div>
            </div>
            <div class="container">
        <div class="kep"><img src="img/aside/4.jpg" alt="Kép leírása"></div>
            </div>
            <div class="container">
        <div class="kep"><img src="img/aside/1.jpg" alt="Kép leírása"></div>
            </div>
            <div class="container">
        <div class="kep"><img src="img/aside/1.jpg" alt="Kép leírása"></div>
            </div>
      
                
        </aside>
        <section>
            <?php if($viewData['render']) include($viewData['render']); ?>
        </section>
        <footer>&copy; NJE - GAMF - Informatika Tanszék <?= date("Y") ?></footer>
    </body>
</html>
