<?php
// Name   : getModifiedContact.php - called by webSqlSyncAdapter.php
// Goal   : To communicate data from a MySQL query to a webSqlSync json format. 
// By (c) : Alain Beauseigle de AffairesUP inc.
// Version: 2013-10-19
// To do  : Successful unit test, but to debug after integration

// For unit test: http://www.affairesup.com/webSqlApp/getModifiedContact.php
// To test the query: $clientLastSyncDate = 0; 

//include "loginCheck.php";

//if ($CLnum_rows){
//	switch ($_REQUEST['Version']){
//    case $KEY_RDNET:
/*      $query = "SELECT *"
            	." FROM Contacts"
            	." ORDER BY id ASC ";
*/

	//echo "clientLastSyncDate", $clientLastSyncDate;	// For the first sync, it equal zero
	require_once('connections/connDbUP.php');

	$query = "SELECT * FROM Contacts WHERE last_sync_date > '". $clientLastSyncDate ."' ORDER BY id DESC ";
	//echo $query;
	//Note: $clientLastSyncDate comes from webSqlSyncAdapter.php line 41: $clientLastSyncDate = $clientData['info']['lastSyncDate']/1000;

	$sql_result = array();
	$sql = mysql_query($query);
	while($row = mysql_fetch_object($sql)){
		$sql_result[] = $row;
	}
	//print_r ($sql_result);	//R: Good array result, but the result is not passed to the adapter
	return $sql_result;
	//echo $sql_result;

//} end if ($CLnum_rows) used for authentication
?>