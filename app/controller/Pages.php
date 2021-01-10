<?php
class Pages extends Controller{
	public function __construct(){

		//Loading the model...
		// $this->pageModel = $this->model('Post');
	}
//Method for home page
	public function index(){
  //       $posts = $this->pageModel->getAllPost();

		// $data = [
  //          'post' => $posts,
		// ];
         $this->view('pages/home');
		
	}

// Method for about page
	public function about(){
       $this->view('pages/about');
	}	
}


?>