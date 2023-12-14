<?php

class Keszlet_Controller
{
	public $baseName = 'keszlet';  //meghatározni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router által továbbított paramétereket kapja
	{
		$keszletModel = new Keszlet_Model;
		$keszletData = $keszletModel->getKeszletAdatok();
	
		$view = new View_Loader($this->baseName . '_main');
		$view->assign('keszletData', $keszletData);

		
	}
	
	
}

?>