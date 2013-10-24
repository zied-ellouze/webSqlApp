<?php
/*
 * Name  : setContactTest.php	called by: sqlSyncAdapter4.php
 * Goal  : To INSERT and UPDATE in Contact table in the sync process with a JSON coming from the webSqlApp 
 * By (c): Alain Beauseigle from AffairesUP inc.
 * Date  : 2013-10-19
 * ToDo  : Test if the json is working with accents
 * ToDo  : Activate the authenetication
 * Status: This test is working, it updates the data
 * To test, use: http://www.affairesup.com/webSqlApp/setContactTest.php
*/

//include "loginCheck.php";
$CLnum_rows = 1;
if ($CLnum_rows){
	//$isOk = "1";

// Selon le json créé par webSynSql.js (obtenu via le log de la concole, clientData sent, ln 228: )
//$jsonString = '';
/* du proto -> ça marche
$jsonString = '{	"info":{"userEmail":"name@abc.com","device_uuid":"UNIQUE_DEVICE_ID_287CHBE873JB",
					"lastSyncDate":"1198112400",
					"device_version":"5.1","device_name":"test navigator","userAgent":"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36","appName":"webSqlApp","webSqlApp_version":"0.7","lng":"fr"},
				"data":{
					"Contacts":[
						{"id":3,"ContactID":-1,"firstName":"a","lastName":"aa","qte":"1","MaJdate":"2013-09-24","cbFait":"1","rbABC":"A","UniteID":1,"last_sync_date":null},
						{"id":4,"ContactID":12,"firstName":"VictorB","lastName":"VilleneuveBB","qte":"2","MaJdate":"2013-09-24","cbFait":"0","rbABC":"B","UniteID":2,"last_sync_date":null}],
					"Unites":[{"UniteID":-1,"UniteSymbol":"C$","last_sync_date":null}]
				}
			  }';
//
/* de webSqlSync -> ne marche pas, pourquoi? À cause de l'accent dans Zébulon -> Corrigé, voir la ligne d'appel de webSqlSync.js dans le header de index.html. À tester. 
$jsonString = '{"info":{
					"userEmail":"name@abc.com","device_uuid":"UNIQUE_DEVICE_ID_287CHBE873JB",
					"lastSyncDate":1381371814000,
					"device_version":"5.1","device_name":"test navigator",
					"userAgent":"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.69 Safari/537.36",
					"appName":"webSqlApp","webSqlApp_version":"0.7","lng":"fr"},
					"data":{
						"Contacts":[
							{"id":0,"ContactID":5,"firstName":"Xavier","lastName":"Xoland","qte":"1","MaJdate":"2011-09-22","cbFait":"1","rbABC":"A","UniteID":5,"last_sync_date":"2013-10-02 08:52:00"},	
							{"id":1,"ContactID":7,"firstName":"Zébulon","lastName":"Zala","qte":"2","MaJdate":"2013-09-23","cbFait":"0","rbABC":"C","UniteID":2,"last_sync_date":"2013-10-02 08:21:44"},
							{"id":3,"ContactID":1,"firstName":"Thomas","lastName":"Toupin","qte":"1","MaJdate":"2013-09-24","cbFait":"1","rbABC":"A","UniteID":1,"last_sync_date":"2013-10-02 08:21:59"},
							{"id":4,"ContactID":6,"firstName":"Yvon","lastName":"Yale","qte":"1","MaJdate":"2013-09-26","cbFait":"0","rbABC":"B","UniteID":2,"last_sync_date":"2013-10-02 08:21:47"},
							{"id":5,"ContactID":3,"firstName":"Victor","lastName":"Villeneuve","qte":"11","MaJdate":"2013-09-30","cbFait":"0","rbABC":"C","UniteID":1,"last_sync_date":"2013-10-02 08:21:33"},
							{"id":6,"ContactID":8,"firstName":"Sylvie","lastName":"Sirois","qte":"8","MaJdate":"2013-10-08","cbFait":"0","rbABC":"A","UniteID":5,"last_sync_date":"2013-10-07 22:09:48"}
						],
						"Unites":[]
					}
				}';
*/
/*
$jsonString = '{"info":{
					"userEmail":"name@abc.com","device_uuid":"UNIQUE_DEVICE_ID_287CHBE873JB",
					"lastSyncDate":1381371814000,
					"device_version":"5.1","device_name":"test navigator",
					"userAgent":"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.69 Safari/537.36",
					"appName":"webSqlApp","webSqlApp_version":"0.7","lng":"fr"},
					"data":{
						"Contacts":[
							{"id":0,"ContactID":-1,"firstName":"Xavier","lastName":"Xoland","qte":"1.11","MaJdate":"2011-09-22","cbFait":"1","rbABC":"A","UniteID":5,"last_sync_date":"2013-10-02 08:52:00"},
							{"id":1,"ContactID":7,"firstName":"Zebulon","lastName":"Zala","qte":"2","MaJdate":"2013-09-23","cbFait":"0","rbABC":"C","UniteID":2,"last_sync_date":"2013-10-02 08:21:44"},
							{"id":3,"ContactID":1,"firstName":"Thomas","lastName":"Toupin","qte":"1","MaJdate":"2013-09-24","cbFait":"1","rbABC":"A","UniteID":1,"last_sync_date":"2013-10-02 08:21:59"},
							{"id":4,"ContactID":6,"firstName":"Yvon","lastName":"Yale","qte":"1","MaJdate":"2013-09-26","cbFait":"0","rbABC":"B","UniteID":2,"last_sync_date":"2013-10-02 08:21:47"},
							{"id":5,"ContactID":3,"firstName":"Victor","lastName":"Villeneuve","qte":"11","MaJdate":"2013-09-30","cbFait":"0","rbABC":"C","UniteID":1,"last_sync_date":"2013-10-02 08:21:33"},
							{"id":6,"ContactID":8,"firstName":"Sylvie","lastName":"Sirois","qte":"8","MaJdate":"2013-10-08","cbFait":"0","rbABC":"A","UniteID":5,"last_sync_date":"2013-10-20 22:09:48"}
						],
						"Unites":[]
					}
				}';
*/
	//var_dump(json_decode($jsonString, true));

	require_once('connections/connDbUP.php');
	$currentDateTime =  date("Y-m-d H:i:s");				// usefull for the unit test of this function
	//echo "setContactTest - currentDateTime: ", $currentDateTime, '<br />';	// usefull for the unit test of this function

	$clientData = $handler -> clientData;
	echo '<br />', "setContactTest - print_r clientData: ";
	print_r($clientData);
	echo '<br />';

	//echo '<br />', "setContactTest - print_r handler -> clientData: ";
	//print_r($handler -> clientData);
	//echo '<br />';

	$clientLastSyncDate = $clientData['info']['lastSyncDate']/1000;	// It gives a 10 digits unix date time
	//$clientLastSyncDate = $handler -> clientData['info']['lastSyncDate']/1000;	// It gives a 10 digits unix date time
	echo "setContactTest - clientLastSyncDate: ", $clientLastSyncDate, '<br />';	// usefull for the unit test of this function

	//$clientData is produced by json_decode of $clientJson string in webSqlSyncAdapter.php 

	//echo "userEmail: ", $clientData['info']['userEmail'], '<br />';	// Should give Xavier --> good answer
	//echo "fisrtName: ", $clientData['data']['Contacts'][0]['firstName'], '<br />';	// Should give Xavier --> good answer
	$clientLastSyncDateUnix= $clientData['info']['lastSyncDate']/1000;	// It gives a 10 digits Unix dateTime format
	//$clientLastSyncDateUnix= $handler -> clientData['info']['lastSyncDate']/1000;	// It gives a 10 digits Unix dateTime format
	$clientLastSyncDate= date('Y-m-d H:i:s', $clientLastSyncDateUnix);	// to show the date in YYYY-MM-DD HH:MM:SS format (MySQL datetime format). Result: 2007-12-20 14:00:00
	echo "setContactTest - 10 digit Unix date: ", $clientLastSyncDateUnix, '<br />';
	echo "setContactTest - ISO date          : ", $clientLastSyncDate, '<br />';
	echo "<br>";
	
	$count = count($clientData['data']['Contacts']);
	echo "setContactTest - count: ", $count, '<br />';
	
	for ($i=0; $i < $count; $i++) {
		$newrec = $clientData['data']['Contacts'][$i];  
		$ContactID = $newrec['ContactID']; $ContactID = mysql_real_escape_string($ContactID);
		//echo ($ContactID);	// donne --> good answer
		$id = $newrec['id']; $id = mysql_real_escape_string($id);
		$firstName = $newrec['firstName']; $firstName = mysql_real_escape_string($firstName);
		$lastName = $newrec['lastName']; $lastName = mysql_real_escape_string($lastName);
		$qte = $newrec['qte']; $qte = mysql_real_escape_string($qte);
		$MaJdate = $newrec['MaJdate']; $MaJdate = mysql_real_escape_string($MaJdate);
		$cbFait = $newrec['cbFait']; $cbFait = mysql_real_escape_string($cbFait);
		$rbABC = $newrec['rbABC']; $rbABC = mysql_real_escape_string($rbABC);
		$UniteID = $newrec['UniteID']; $UniteID = mysql_real_escape_string($UniteID);
		$clientRecLastSyncDate = $newrec['last_sync_date']; $clientRecLastSyncDate = mysql_real_escape_string($clientRecLastSyncDate);
		//echo "clientRecLastSyncDate: ",$clientRecLastSyncDate, '<br />';
	
		//if (ID == -1 ) do an INSERT INTO MySQL
		//if (ID <> -1 AND last_sync_date < lastSyncDate) do an UPDATE INTO MySQL
		//if (ID <> -1 AND last_sync_date > lastSyncDate) do nothing because MySQL is more recent
		if ($ContactID == -1) {
			$insert_value 	 = "(" .$id. ", '".$firstName."', '".$lastName."', ".$qte.", ".$MaJdate.", ".$cbFait.", '".$rbABC."', ".$UniteID.", '" .$currentDateTime. "')";
			$sqlInsert = "INSERT INTO Contacts (id, firstName, lastName, qte, MaJdate, cbFait, rbABC, UniteID, last_sync_date) VALUES ".$insert_value;
			echo $sqlInsert, "<br>", "<br>";
			//$queryInsert = mysql_query($sqlInsert) or die('line 72. '.mysql_error());
			// Note: By changing last_sync_date to the currentDateTime, the getModifiedContact.php SELECT query will force to update ContactID in webSQL db  

/*			// Do an UPDATE to MySQL to force webSqlSync to change the ContactID from -1 to N
			$getNewContactIDsql = "SELECT ContactID FROM Contacts WHERE id = ". $id;
			//echo $getNewContactIDsql, "<br>", "<br>";
			$newContactIDResult = mysql_query($getNewContactIDsql) or die(mysql_error());
			$row_NewContactIDResult = mysql_fetch_assoc($newContactIDResult);
			//echo $totalRows_moreRecentResult = mysql_num_rows($moreRecentResult);	// donne 0 
			$NewContactID = $row_NewContactIDResult['ContactID'];
			$sqlUpdate = "UPDATE Contacts SET last_sync_date='". $currentDateTime ."' WHERE id = ". $id ;
			//echo $sqlUpdate, "<br>", "<br>";
			$queryUpdate = mysql_query($sqlUpdate) or die('line 82. '.mysql_error());
*/
		}
		if ($ContactID <> -1) {
			$moreRecentSQL = "SELECT last_sync_date FROM Contacts WHERE ContactID = ". $ContactID;
			echo $moreRecentSQL, "<br>";
			$moreRecentResult = mysql_query($moreRecentSQL) or die(mysql_error());
			$row_moreRecentResult = mysql_fetch_assoc($moreRecentResult);
			//echo $totalRows_moreRecentResult = mysql_num_rows($moreRecentResult);	// donne 0 
			$serverRec_last_sync_date = $row_moreRecentResult['last_sync_date'];
			echo "serverRec_last_sync_date = ", $serverRec_last_sync_date, "<br>";
			echo "clientRecLastSyncDate   = ", $clientRecLastSyncDate, "<br>";
			echo "if serverRec_last_sync_date:", $serverRec_last_sync_date, "< clientLastSyncDate: ", $clientLastSyncDate, " do an update", "<br>";
	
			if ($serverRec_last_sync_date < $clientLastSyncDate){
				$sqlUpdate = "UPDATE Contacts SET id='". $id. "', firstName='". $firstName. "', lastName='". $lastName. "', qte=". $qte. ", MaJdate='". $MaJdate. "', cbFait=". $cbFait .", rbABC='". $rbABC ."', UniteID=". $UniteID .", last_sync_date='". $currentDateTime ."' WHERE ContactID=". $ContactID ;
				echo $sqlUpdate, "<br>", "<br>";
				//$queryUpdate = mysql_query($sqlUpdate) or die('line 100. '.mysql_error());
			}
			echo "<br>";
			//Else -> Do nothing because server is more recent than the client. The getContact will send the more recent data to client. 
		}
	}	//end for
}	//end if ($CLnum_rows)
?>