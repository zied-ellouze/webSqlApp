<?php
/**
 * Name   : webSqlSyncHandlerTest.php for WebSqlSync.js code
 * Creator: sg4r3z 20/05/2013
 * Modified by abeauseigle 2013-10-19 to add the tableName in the JSON
 * This class allow to manage the json flow sended by the client (with the WebSqlSync script by orbitaloop), and make a reply.
 * ToDo: 
*/
	 
final class SqlSyncHandler{
	//private $clientData,$jsonData;
	public $clientData;
	private $jsonData;
	// well formatted Answer for WebSqlSync.js Script
	private $serverAnswer = array("result" => '',"message" => '', "syncDate" => '',"data" => array());
		
	/*
	 * __construct 
	 * Capture the input stream and creates 
	 * an array with the same structure
	 */
/*
	public function __construct($dataFlow = NULL){					
		if($dataFlow == NULL)
			//{$this -> jsonData = file_get_contents('php://input');}	// like jsonfile2string 
			{$this -> jsonData = file_get_contents('php://input');}	// like jsonfile2string 
		else 
			{$this -> jsonData = file_get_contents($dataFlow);}		// like jsonfile2string. On failure, file_get_contents() will return FALSE.
		//$this -> clientData = json_decode($this -> jsonData);		 
		$clientData = json_decode($this -> jsonData);		// like string2array 
		// ToDo: Do something with the Client JSON data
	}
*/
	public function __construct(){					

/* Json of the first sync
	$clientJson = '{"info":
						{
							"userEmail":"name@abc.com","device_uuid":"UNIQUE_DEVICE_ID_287CHBE873JB",
							"lastSyncDate":0,
							"device_version":"5.1","device_name":"test navigator","userAgent":"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.69 Safari/537.36","appName":"webSqlApp","webSqlApp_version":"0.7","lng":"fr"},
							"data":{"Contacts":[],"Unites":[{"UniteID":-1,"UniteSymbol":"C$","last_sync_date":null}]}}';
*/
// Next json after a modification of a record in webSql with the app.
	$clientJson = '{"info":{
						"userEmail":"name@abc.com","device_uuid":"UNIQUE_DEVICE_ID_287CHBE873JB",
						"lastSyncDate":1382232145000,"device_version":"5.1","device_name":"test navigator","userAgent":"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36","appName":"webSqlApp","webSqlApp_version":"0.7","lng":"fr"},
					"data":{
						"Contacts":[
							{"id":9,"ContactID":15,"firstName":"Alain","lastName":"Alarie","qte":"1.10","MaJdate":"1899-11-30","cbFait":"1","rbABC":"A","UniteID":1,"last_sync_date":"2013-10-17 09:38:50"}],
						"Unites":[]
						}
					}';


/*
	$clientJson = '{"info":{
						"userEmail":"name@abc.com","device_uuid":"UNIQUE_DEVICE_ID_287CHBE873JB","lastSyncDate":1382016482000,
						"device_version":"5.1","device_name":"test navigator","userAgent":"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.69 Safari/537.36",
						"appName":"webSqlApp","webSqlApp_version":"0.7","lng":"fr"},
						"data":{
							"Contacts":[{"id":2,"ContactID":4,"firstName":"Wilfried","lastName":"Wild","qte":"1.23","MaJdate":"2013-09-23","cbFait":"1","rbABC":"A","UniteID":1,"last_sync_date":"2013-10-02 08:52:05"},
										{"id":7,"ContactID":7,"firstName":"Zebulon","lastName":"Zala","qte":"2.20","MaJdate":"2013-09-23","cbFait":"0","rbABC":"C","UniteID":2,"last_sync_date":"2013-10-11 17:57:53"},
										{"id":8,"ContactID":2,"firstName":"Uclide","lastName":"Uvil","qte":"1.00","MaJdate":"2013-09-24","cbFait":"1","rbABC":"B","UniteID":1,"last_sync_date":"2013-10-02 08:21:39"},
										{"id":9,"ContactID":-1,"firstName":"Alain","lastName":"Alarie","qte":"1","MaJdate":"2013-10-16","cbFait":"1","rbABC":"A","UniteID":1,"last_sync_date":null}],
							"Unites":[]
						}
					}';
*/

		$this -> jsonData = $clientJson;	 
		//$this -> jsonData = file_get_contents('php://input');	// like jsonfile2string 

		$this -> clientData = json_decode($this -> jsonData,true);
		//X// $clientData = json_decode($this -> jsonData, true);			// json string to array, $clientData is used by setContact.php
		echo "webSqlSyncHandlerTest - clientData:", "<br>";
		print_r($this -> clientData); 
		echo "<br>", "<br>";
		/// require_once('setContact.php');	// With the JSON, it does many INSERTs or UPDATEs to MySQL following some conditions
	}
	/*
	 * reply (Server -> JSON  -> Client)
	 * This method create a well-structred reply for Client in JSON
	 * This method accept status,message,data
	 * STATUS = boolean value (TRUE for OK, FALSE for ERROR)
	 * MESSAGE = string value for message
	 * DATA = array of data for client
	 */
	public function reply($status,$message,$data){		// $data come from the query getAllServerData() from sqlSyncHandlerTest.php
		if($status)
			{$this -> serverAnswer['result'] = 'OK';}
		else
			{$this -> serverAnswer['result'] = 'ERROR';}
			$this -> serverAnswer['message'] = $message;
			$this -> serverAnswer['syncDate'] = strtotime("now")*1000;	// return sync_date: "1372365079000",
			$this -> serverAnswer['data'] = $data;

			echo json_encode($this -> serverAnswer);
//			$myObject = '{"result":"OK","message":"this is a positive reply","syncDate":"1371753757","data":[{"UniteID":"0","UniteSymbol":"h"},{"UniteID":"1","UniteSymbol":"km"},{"UniteID":"2","UniteSymbol":"$"},{"UniteID":"3","UniteSymbol":"U$"},{"UniteID":"4","UniteSymbol":"\u20ac"},{"UniteID":"5","UniteSymbol":"$P"}]}';
//			echo $myObject;
	}

	/*
	* call 
	* This method allows class to call an
	* external functon to make a custom job
	*/
	public function call($function,SqlSyncHandler $param = NULL){
		call_user_func($function,$param);
	}
		
	/*
	* getter clientData 
	* get a clientData property
	*/
	public function get_clientData(){
		return $this -> clientData;
	}
		
	/*
	* get serverAnswer 
	* get a serverAnswer property
	*/
	public function get_serverAnswer(){
		return $this -> serverAnswer;
	}
		
	/*
	* get jsonData
	* get a jsonData property
	*/
	public function get_jsonData(){
		return $this -> jsonData;
	}

}
?>
