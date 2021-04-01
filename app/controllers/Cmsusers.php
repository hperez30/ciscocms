<?php

	/* 
	 * class Cmsusers controller
	 * Don't provide delete and edit functions.
	 */ 

	class Cmsusers extends Controller{
				
		public function __construct(){
			if (!isLoggedIn()){
				redirect('users/login');
			}
			else{
				$this->cmsModel = $this->model('Cmsuser');
			}
		}
		
		public function index()
		{
			$data = [
				'title'           => 'Cisco CMS',
				'description'     => 'List of users',
				'data'            => '',
				'recordsTotal'	  => '',
				'recordsFiltered' => '',
			];
			$this->view('cmsusers/index', $data);
		}
		
		public function getUsers()
		{
			
			$users = $this->cmsModel->getUsers();
			$data = [
				'draw'            => intval($users->draw),  
				'data'            => $users->usuarios,
				'recordsTotal'	  => intval($users->total),
				'recordsFiltered' => intval($users->totalFiltered),
				//'length'          => intval($users->length)
			];
			
			echo json_encode($data);
			exit();
			
		}//end of getUsers
		
		public function edit($id)
		{
			$users = $this->cmsModel->getUserById($id);
			
			if ($users)
			{ 
				$data = [
					'title'       => 'Cisco CMS',
					'description' => 'List of users',
					'response'    => $users
				];

				$this->view('cmsusers/edit', $data);
			} else{
				flash('cmsuser_message', 'There was an error');
				redirect('cmsusers');
			}
		}//end of index
		
	}//end of class	
