<?php

class Menu {
    public static $menu = array();

    public static function setMenu() {
        self::$menu = array();
        $connection = Database::getConnection();
        $userLevel = isset($_SESSION['userlevel']) ? $_SESSION['userlevel'] : 0; // Az aktuális felhasználói szint vagy alapértelmezésben 0

        // A menüpontok lekérdezése az aktuális felhasználói jogosultság alapján
        $stmt = $connection->prepare("SELECT url, nev, szulo, jogosultsag FROM menu WHERE jogosultsag <= :userLevel ORDER BY sorrend");
        $stmt->execute(array(':userLevel' => $userLevel));
        while($menuitem = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$menu[$menuitem['url']] = array($menuitem['nev'], $menuitem['szulo'], $menuitem['jogosultsag']);
        }
    }

    public static function getMenu($sItems) {
        $submenu = "";

        $menu = "<ul>";
        foreach(self::$menu as $menuindex => $menuitem)
        {
            if($menuitem[1] == "")
            { $menu.= "<li><a href='".SITE_ROOT.$menuindex."' ".($menuindex==$sItems[0]? "class='selected'":"").">".$menuitem[0]."</a></li>"; }
            else if($menuitem[1] == $sItems[0])
            { $submenu .= "<li><a href='".SITE_ROOT.$sItems[0]."/".$menuindex."' ".($menuindex==$sItems[1]? "class='selected'":"").">".$menuitem[0]."</a></li>"; }
        }
        $menu.="</ul>";

        if($submenu != "")
            $submenu = "<ul>".$submenu."</ul>";

        return $menu.$submenu;
    }
}

Menu::setMenu();
?>
