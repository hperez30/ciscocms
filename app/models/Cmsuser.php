<?php
	
	/* *********************************************
	 * Class CMSUsers  
	 **********************************************/
	class Cmsuser{	
		
		const URL_COSPACE = APICMS."api/v1/users";
		
		public function __construct(){
			// user 						 
		}
		
		public function setCommonArray($serv = "", $method = 'GET'){
			if ($serv != "") $url = self::URL_COSPACE.$serv;
			else $url = self::URL_COSPACE;
			
			$COMMON_ARRAY = array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => $method,
			  CURLOPT_HEADER      => true
			);
			return $COMMON_ARRAY;
		}//end of setCommonArray
		
		public function getUsers($page = 1, $numPages = 20, $order = 'ASC')
		{
			$requestData = $_REQUEST;
			
			$curl = curl_init();
			if (array_key_exists('search', $requestData))
			{//just for filtering 
				if ($requestData['search']['value'] != " "){
					$filter = "?filter=".$requestData['search']['value'];
				}
			} else $filter = "";
			
			curl_setopt_array($curl, $this->setCommonArray($filter, "GET"));
			
			$response = curl_exec($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			
			if ($httpcode != "200") return false;
			
			$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
			$header = substr($response, 0, $header_size);
			$body = substr($response, $header_size);
			
			curl_close($curl); 
			
			//traverse the response 
			$xml = simplexml_load_string($body);
			$xml = json_encode($xml);
			$newArr = json_decode($xml, true);
			
			$users = new stdClass;
			$users->usuarios = array();
			$users->total = new stdClass;
			$users->draw  = new stdClass;
			$users->totalFiltered = new stdClass;
			
			if (array_key_exists('draw', $requestData))
			{
				$users->draw = $requestData['draw'];
			} else $users->draw = "";
			
			$users->total = $newArr['@attributes']['total'];
			//miss control filters
			$users->totalFiltered = $newArr['@attributes']['total'];
			
			if ($users->total == 1)
			{ 
				$user = new stdClass;
				$user->id = $newArr['user']['@attributes']['id'];
				$user->userjid = $newArr['userJid']['name'];
				
				$user->acciones = '<td><center>
					 <a href='.URLROOT.'/cmsusers/edit/'.$user->id .'  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-info"> <i class="fas fa-pencil-alt"></i> </a>
					 </center></td>';
					 
				$users->usuarios[]= $user;

			} else{ 
				//In a real environment, yo have to catch more attributes such as access method, passcode, etc 
				foreach ($newArr['user'] as $clave => $valor)
				{
					$user = new stdClass;
					$user->id = $valor['@attributes']['id'];
					$user->userjid = $valor['userJid'];
					
					$user->acciones = '<td><center>
					 <a href='.URLROOT.'/cmsusers/edit/'.$user->id .'  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-info"> <i class="fas fa-pencil-alt"></i> </a>
					 </center></td>';
					 
					$users->usuarios[]= $user;
				}	 
			}			
			
			return $users;
		}//end of getUsers
		
		public function getUserById($id)
		{
			$curl = curl_init();
			curl_setopt_array($curl, $this->setCommonArray('/'.$id));
			
			$response = curl_exec($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			
			if ($httpcode != "200") return false;
			
			$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
			$header = substr($response, 0, $header_size);
			$body = substr($response, $header_size);
			curl_close($curl);
			
			$xml = simplexml_load_string($body);
			$xml = json_encode($xml);
			$newArr = json_decode($xml, true); 
			
			$data = new stdClass;
			$data->id = $newArr['@attributes']['id'];
			$data->userjid = $newArr['userJid'];
			
			return $data;
			
		}//end of getUserById
		
	}//end of class
		
		

