<?php
class Regisztral_Controller
{
    public $baseName = 'belepes';

    public function main(array $vars)
    {
        $regisztralModel = new Regisztral_Model;
        $retData = $regisztralModel->create_user($vars);

        //betöltjük a nézetet
        $view = new View_Loader($this->baseName . '_main');
        //átadjuk a lekérdezett adatokat a nézetnek
        $view->assign('uzenet', $retData['eredmeny']);
    }
}

?>