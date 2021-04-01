<?php
	
	class Versions extends Controller
	{
		public function __construct()
		{
			if (!isLoggedIn()){
				redirect('users/login');
			}
		}
		
		public function about()
		{
			$data = [
				'title' => 'About',
				'description' => 'This is a test of the site',
			];
			
			$this->view('versions/about', $data);
		}
		
	}//end of class	
