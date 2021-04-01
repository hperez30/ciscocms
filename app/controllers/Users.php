<?php
	
	/* 
	 * class users controller
	 */ 
	class Users extends Controller
	{
		public function __construct()
		{
			$this->userModel = $this->model('User');
		}
		
		public function login()
		{
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					'user' => trim($_POST['user']),
					'password' => trim($_POST['password']),
					'user_err' => '',
					'password_err' => '',
				];
				
				if (empty($data['user']))
					$data['user_err'] = "Please, a valid user account is required";
				if (empty($data['password']))
					$data['password_err'] = "Please, a valid password is required";
					
				if (empty($data['user_err']) && empty($data['password_err']))
				{		
						$loggedInUser = $this->userModel->login($data['user'], $data['password']);
						if($loggedInUser)
						{
							$this->createUserSession($loggedInUser);
						}else{
							$data['password_err'] = 'Invalid credentials';
							$data['user'] = '';
							$data['password'] = '';
							$data['user_err'] = '';
							$this->view('users/login', $data);
						}
				} else{
					$this->view('users/login', $data);
				}
				
			}else
			{
				$data = [
					'user' => '',
					'password' => '',
					'user_err' => '',
					'password_err' => '',
				];
			}	
			$this->view('users/login', $data);
		}//end of login
		
		public function createUserSession($user)
		{
			$_SESSION['user_id'] = $user->id;
			$_SESSION['user_name'] = $user->username;

			redirect('cmsusers');
		}//end of createUserSession
		
		public function logout()
		{
			unset($_SESSION['user_id']);
			unset($_SESSION['user_name']);
			session_destroy();
			redirect('users/login');
		}//end of logout
		
	}//end of class	
