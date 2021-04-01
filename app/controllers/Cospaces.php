<?php

	/* 
	 * class cospaces controller
	 */ 
	class Cospaces extends Controller{
				
		public function __construct()
		{
			if (!isLoggedIn()){
				redirect('users/login');
			}
			else{
				$this->cospaceModel = $this->model('Cospace');
				$this->cmsModel = $this->model('Cmsuser');
			}
		}
		
		public function index()
		{
			$data = [
				'title'            => 'Cisco CMS',
				'description'      => 'List of cospaces',
				'data'             => '',
				'recordsTotal'	   => '',
				'recordsFiltered'  => '',
			];
			$this->view('cospaces/index', $data);
		}
		
		public function getCoSpaces()
		{	
			$cospaces = $this->cospaceModel->getCoSpaces();

			$data = [
				'draw'            => intval($cospaces->draw),   
				'data'            => $cospaces->cospaces,
				'recordsTotal'	  => intval($cospaces->total),
				'recordsFiltered' => intval($cospaces->total),
			];
			
			echo json_encode($data);
			exit();
			
		}//end of index
		
		public function edit($id)
		{	
			$cospaces = $this->cospaceModel->getCoSpaceById($id);
			if ($cospaces)
			{ 
				$data = [
					'title'       => 'Cisco CMS',
					'description' => 'List of coSpaces',
					'response'    => $cospaces,
					'id'          => $id
				];
				$this->view('cospaces/edit', $data);
			} else{
				flash('cospace_message', 'There was an error');
				redirect('cospaces');
			}
		}//end of show
		
		public function delete($id)
		{	
			$cospaces = $this->cospaceModel->deleteCoSpace($id);
			
			if ($cospaces == "200")
			{ 
				flash('cospace_message', 'The coSpace was removed');
				redirect('cospaces');
			} else{
				flash('cospace_message', 'There was an error '.$cospaces);
				redirect('cospaces');
			}
		}//end of index
		
		public function add()
		{
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				print_r($_POST);
				$data=[
					'title' => trim($_POST['title']),
					'usuario' => trim($_POST['usuario']),
					//'user_id' => $_SESSION['user_id'],
					'fecha' => trim($_POST['fecha']),
					'hora' => trim($_POST['hora']),
					//'passcode' => trim($_POST['passcode']),
					//'accessMethod'   => trim($_POST['passcode']),
					'password_err' => '',
					'title_err' => '',
					'usuario_err' => '',
					'fecha_err'   => '',
					'hora_err'   => ''
				];
				
				if (empty($data['title'])){
					$data['title_err'] = "Please enter title";
				}
				if (empty($data['usuario'])){
					$data['usuario_err'] = "Please enter usuario";
				}
				if (empty($data['fecha'])){
					$data['fecha_err'] = "Please enter a valid date";
				}
				if (empty($data['hora'])){
					$data['hora_err'] = "Please enter a valid hour";
				}
				
				if (empty($data['title_err']) && empty($data['usuario_err']) 
				    && empty($data['fecha_err']) && empty($data['hora_err']))
				{
					print_r($data);
					$result = $this->cospaceModel->addCoSpace($data);
					if ($result == "200"){
						flash('cospace_message', 'The coSpace was added');
						redirect('cospaces');
					} else{
						flash('cospace_message', 'There was an error '.$result);
						redirect('cospaces');
					}
				} else{
					$users = array();
					$user = new stdClass;
					$user->email = $data['usuario'];
					$users[] = $user;
					$data['usuario'] = $users;
					$this->view('cospaces/add', $data);
				}
			} else{
				//En producción hay que modificar para llamar a getUser($filtered)
				$users = $this->cmsModel->getUsers();
				if ($users->total > 0)
				{	
					$data=[
						'title' => '',
						'fecha' => '',
						'hora'  => '',
						'usuario' => $users->usuarios,
						'password'  => '',
						'password_err'  => '',
						'title_err' => '',
						'usuario_err' => '',
						'fecha_err'   => '',
						'hora_err'   => ''
					];
					$this->view('cospaces/add', $data);
				} else {
					flash('cospace_message', 'There is no users');
					redirect('cospaces');
				}
			}
				
		}//end of add
            
	}//end of class	
