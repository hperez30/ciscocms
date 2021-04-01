<?php
	
	/* *********************************************
	 * Class Cospace
	 **********************************************/
	class Cospace 
	{	
		const URL_COSPACE = APICMS."api/v1/coSpaces";
		private $COMMON_ARRAY;
		
		public function __construct(){
			// user 						 
		}
		
		public function setCommonArray($serv='', $method='GET'){
			$COMMON_ARRAY = array(
			  CURLOPT_URL => self::URL_COSPACE.$serv,
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
		
		public function getCoSpaces($page = 0, $numPages = 0)
		{
			$requestData = $_REQUEST;
			
			$curl = curl_init();
			curl_setopt_array($curl, $this->setCommonArray('/?offset='.$page));
			
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
			$data->total = new stdClass;
			$data->cospaces = array();
			$data->draw = new stdClass();
			$data->totalFiltered = new stdClass();
			$data->draw = $requestData['draw'];
			
			$data->total = $newArr['@attributes']['total'];
			
			if ($data->total == 1)
			{ 
				$cospaceData = new stdClass;
				$cospaceData->id = $newArr['coSpace']['@attributes']['id'];
				$cospaceData->nombre = $newArr['coSpace']['name'];
				
				if (array_key_exists('uri', $newArr['coSpace']))
					$cospaceData->uri = $newArr['coSpace']['uri'];
				else $cospaceData->uri = "";
				
				$data->cospaces[]= $cospaceData;

			} else
			{
				foreach ($newArr['coSpace'] as $clave => $valor){
					$cospaceData = new stdClass;
					$cospaceData->id = $valor['@attributes']['id'];
					$cospaceData->nombre = $valor['name'];
					$cospaceData->uri = $valor['uri'];
					$data->cospaces[]= $cospaceData;
				}	 
			}
			
			foreach ($data->cospaces  as $cospace){
				$cospace->acciones = new stdClass;
				$cospace->acciones = '<td><center>
                     <a href='.URLROOT.'/cospaces/edit/'.$cospace->id .'  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-info"> <i class="fas fa-pencil-alt"></i> </a>
                     <a href='.URLROOT.'/cospaces/delete/'.$cospace->id.'  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </a>
				     </center></td>';
			}		
			
			return $data;
		}//end getCoSpaces
		
		public function getCoSpaceById($id)
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
			$data->id      = $newArr['@attributes']['id'];
			$data->name    = $newArr['name'];
			$data->uri     = $newArr['uri'];
			$data->callid  = $newArr['callId'];
			$data->ownerid = $newArr['ownerId'];
			$data->ownejid = $newArr['ownerJid'];
			$data->secret  = $newArr['secret'];
			
			if (array_key_exists('passcode', $newArr)) 
				$data->passcode = $newArr['passcode'];
			else $data->passcode = '';	
			
			return $data;
			
		}//end of getCoSpaceById
		
		public function addCoSpace($data)
		{
			$curl = curl_init();
			curl_setopt_array($curl, $this->setCommonArray('/', 'POST'));
			$response = curl_exec($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			if ($httpcode != "200") return $httpcode;
			
			return "200";
		}// end of addCoSpace
		
		public function deleteCoSpace($id)
		{	
			$curl = curl_init();
			curl_setopt_array($curl, $this->setCommonArray('/'.$id, 'DELETE'));
			
			$response = curl_exec($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			if ($httpcode != "200") return $httpcode;
			
			return "200";
		}//end of deleteCoSpace
		
	}//end class