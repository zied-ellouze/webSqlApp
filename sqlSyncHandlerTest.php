<?php
// sqlSyncHandlerTest.php (futur name: sqlSyncAdapter.php) - used by the webSqlApp (index.html)
// Goal   : To communicate data from a MySQL query using myJob to a webSqlSync json format. Result: It works one way. All server table data to Client.
// To do  : Improve to have a complete 2 way sync adapter.
// Version: 2013-08-16
// It uses SqlSyncHandler.php 
		
	include("SqlSyncHandler.php");
	
	// initialize the json handler from 'php://input' 
	$handler = new SqlSyncHandler();
	
	// initialize the json handler from a file
	// $handler = new SqlSyncHandler('flow.json');	// flow.json contents:	{"info":[],"data":{"name": "sg4r3z"}}
	// $handler = new SqlSyncHandler('flow.json');	// flow.json contents:	{"result":"OK","message":"this is a positive reply","sync_date":1371753757,"data":[{"UniteID":"0","UniteSymbol":"h"},{"UniteID":"1","UniteSymbol":"km"},{"UniteID":"2","UniteSymbol":"$"},{"UniteID":"3","UniteSymbol":"U$"},{"UniteID":"4","UniteSymbol":"\u20ac"},{"UniteID":"5","UniteSymbol":"$P"}]}
	
	// call a custom function which will make a job with parsed data
	$handler -> call('myJob',$handler);
	
	// myJob function
	function myJob($handler){
		
		// getting a clientData
		//AB: line removed and it works finally// print_r($handler -> get_clientData());	// usefull for deboging only

		// getting a row json flow
		//AB: line removed and it works finally// echo $handler -> get_jsonData();			// usefull for deboging only

		// My job is to get all the table data from the server and send a json to client
		$handler -> reply(true,"this is a positive reply", getAllServerData());	// with a dynamic array coming from a MySQL query //function reply($status,$message,$data)
		// It return $serverAnswer from SqlSyncHandler.php:	{"result":"OK","message":"this is a positive reply","sync_date":1371581851,"data":{"Unites":[{"UniteID":"0","UniteSymbol":"h"},{"UniteID":"1","UniteSymbol":"km"},{"UniteID":"2","UniteSymbol":"$"},{"UniteID":"3","UniteSymbol":"U$"},{"UniteID":"4","UniteSymbol":"\u20ac"},{"UniteID":"5","UniteSymbol":"$P"}]}} 

		// a error reply example
		//$handler -> reply(false,"this is a error reply",array('browser' => 'firefox'));
	}

// Goal   : This function get MySQL data, format it, and send it to webSqlSync.js of my webSqlApp
// Status : It works.
// Created: 2013-08-14
// By (c) : Alain Beauseigle of AffairesUP.com

function getAllServerData(){		//using an associative array
// Define here the tables to sync Server side param1 is the webSql table name and param2 is the MySQL table name
	$tablesToSync = array(
	//	array( "tableNameWebSql" => 'Categories', "tableName_MySql" => 'RN_Categorie' ),
		array( "tableNameWebSql" => 'Unites', "tableName_MySql" => 'RN_Unite' )
	);

	$getServerData = array();
	connectdb();
	foreach($tablesToSync as $value){
		$query = "SELECT * FROM " . $value['tableName_MySql'];
		$sql = mysql_query($query);
		$sql_result = array();
		while($row = mysql_fetch_object($sql)){
			$sql_result[] = $row;
		}
		$getServerData[$value['tableNameWebSql']] = $sql_result;
	}
	//unset($value); // Usefull ??? Supposé détruire la référence sur le dernier élément
	return $getServerData;
}

// Goal   : This function will sync MySQL tables with data coming from webSqlApp database
// Status : In creation. Phase 1: see jsonToMySqlTest.php
// Created: 2013-08-14...
// By (c) : Alain Beauseigle of AffairesUP.com

// Inspired by: 	http://appinventor.blogspot.ca/2011/09/android-mysql-connectivity-via-json.html and http://www.daniweb.com/web-development/php/threads/381669/json-to-mysql-with-php
// 					http://www.webdeveloper.com/forum/showthread.php?207248-From-JSON-to-MySQL
// 					http://www.daniweb.com/web-development/php/threads/381669/json-to-mysql-with-php
//					http://www.developphp.com/view_lesson.php?v=860
/*
function syncClientData()(){
	//$jsonString = file_get_contents('php://input');  
	$jsonArray = json_decode($jsonString, true);  //
	connectdb();

	mysql_close();  
	echo "Success";  
}
*/

/*
function getAllUnits(){		    // ToDo: put it seperately in getUnits.php, getContacts.php, ...

	connectdb();
	$query = "SELECT * FROM RN_Unite";

	$getUnits = array();
	$sql_result = mysql_query($query);
    while($row = mysql_fetch_array($sql_result)){
		$getUnits[] = $row;
    }
	//mysql_close($dbname); //bug
	return $getUnits;
}
*/

function connectdb(){			// ToDo: put it seperate in loginCheck.php
// Prevent caching.
///header('Cache-Control: no-cache, must-revalidate');
///header('Expires: Mon, 01 Jan 1996 00:00:00 GMT');

// The JSON standard MIME header.
///header('Content-type: application/json');
//$id = $_GET['id'];	// usefull if we need a specific record

//Connexion to the database WITHOUT access control. 
$dbhost  = "localhost";
$dbname  = "__________";
$dbuname = "__________";
$dbpass  = "__________";
	
	$connect=mysql_pconnect($dbhost, $dbuname, $dbpass) or die("Impossible de se connecter au serveur $server" + mysql_error()); 
	$db= mysql_select_db($dbname) or die("Could not select database"+ mysql_error());
	
	mysql_set_charset('utf8', $connect);		
}
?>

