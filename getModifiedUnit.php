<?php
//include "loginCheck.php";

//if ($CLnum_rows){
//	switch ($_REQUEST['Version']){
//    case $KEY_RDNET:

//get updated records from the last sync date
// If first sync:
	if ($clientLastSyncDate = 0){	//If first sync
		$query = "SELECT UniteID, UniteSymbol"
            	." FROM RN_Unite"
            	." ORDER BY UniteID ASC ";
	}
	else{
		$query = "SELECT UniteID, UniteSymbol FROM RN_Unite WHERE last_sync_date > '". $clientLastSyncDate ."' ORDER BY UniteID ASC ";
	}
/*
	$query = "SELECT UniteID, UniteSymbol"
            	." FROM RN_Unite"
            	." ORDER BY UniteID ASC ";
*/

/*     break;
	  case $KEY_EXPERTUP:
      $query = "SELECT UniteID, UniteSymbol"
            	." FROM EX_Unite"
            	." ORDER BY UniteID ASC ";
     break;
  	 default: echo $_REQUEST['Version'];
	}		
*/
	$sql_result = array();
	$sql = mysql_query($query);
	while($row = mysql_fetch_object($sql)){
		$sql_result[] = $row;
	}
/* To do: Change last_sync_date of the server record
	//$count = count($clientData['data']['Contacts']);
	for ($i=0; $i < $count; $i++) {

	$moreRecentSQL = "SELECT last_sync_date FROM RN_Unite WHERE ContactID = ". $ContactID;
	//echo $moreRecentSQL, "<br>", "<br>";
	$moreRecentResult = mysql_query($moreRecentSQL) or die(mysql_error());
	$row_moreRecentResult = mysql_fetch_assoc($moreRecentResult);
	$serverRec_last_sync_date = $row_moreRecentResult['last_sync_date'];

	$clientRecLastSyncDate = $newrec['last_sync_date']; $clientRecLastSyncDate = mysql_real_escape_string($clientRecLastSyncDate);

	if ($serverRec_last_sync_date < $clientLastSyncDate){
		$sqlUpdate = "UPDATE RN_Unite SET last_sync_date='". $currentDateTime ."' WHERE ContactID=". $ContactID ;
		//echo $sqlUpdate, "<br>", "<br>";
		$queryUpdate = mysql_query($sqlUpdate) or die('line 100. '.mysql_error());
	}
*/
	return $sql_result;

//} end if ($CLnum_rows) used for authentication
?>