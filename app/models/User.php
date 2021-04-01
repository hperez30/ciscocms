<?php
	
	/* *********************************************
	 * Class User
	 **********************************************/
	class User{	
		
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
		
		public function login($username, $password)
		{
			$curl = curl_init();
			curl_setopt_array($curl, $this->setCommonArray());
			
			$response = curl_exec($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl); 
			if ($httpcode != "200") return false;
			else {
				$user = new stdClass;
				$user->id = new stdClass;
				$user->username = new stdClass;
				$user->id = 1;
				$user->username = (string)$username;
				
				return $user;
			}
			
		}//end login
		
	}//end of class