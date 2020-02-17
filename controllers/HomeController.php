<?php

class HomeController {
	public function actionIndex(){
		ob_start();
	  include ROOT.'/../templates/home.html.php';
		$output = ob_get_clean();
		include ROOT.'/../templates/output.php';
	  return true;

	}
}
