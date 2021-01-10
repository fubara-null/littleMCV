<?php

/**
* Base CONTROLLER
  Loads model and views
*/
class Controller{
	public function model($model){
		//Require model file
		require_once  '../app/model/' . $model . '.php';

		//Instatiate the model
		return new $model();

    }

    public function view($view, $data = []){
    	//Checking view file
     if (file_exists('../app/views/' . $view . '.php')) {
         require_once '../app/views/' . $view . '.php';
     	
     }else{
     	die('View file does not exist');
     }

    }

}

?>