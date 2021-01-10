<?php
/*
App Core class
Creates URL & loads controller class
URL FORMAT /controller/method/params
*/

class Core{
	protected $currentController= 'Pages';
	protected $currentMethod = 'index';
	protected $params = [];


public function __construct(){
 $url = $this->getUrl();

 if (file_exists('../app/controller/' . ucwords($url[0]). '.php')) {
 	//If File Exist, set controller to the value of the existing file
 	$this->currentController = ucwords($url[0]);

 	//Unset 0 index
 	unset($url[0]);
 }

 	require_once '../app/controller/' . $this->currentController . '.php';

 	//instatiate the controller class
 	$this->currentController = new $this->currentController;

 	if (isset($url[1])) {
 		if (method_exists($this->currentController, $url[1])){
 				$this->currentMethod = $url[1];

 				unset($url[1]);
 			}	
 	}
 	 $this->params = $url ? array_values($url) : [];

 	 call_user_func_array([$this->currentController,$this->currentMethod], $this->params);


 
}
	public function getUrl(){
	if (isset($_GET['url'])) {
		$url = rtrim($_GET['url'], '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode('/', $url);
		return $url;
	}
	}
}


?>