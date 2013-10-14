<?php
// getModifiedContact.php - called by sqlSyncAdapter.php
// Goal   : To communicate data from a MySQL query using myJob to a webSqlSync json format. Result: It works one way. All server table data to Client.
// By (c) : Alain Beauseigle de AffairesUP inc.
// Version: 2013-10-08
// To do  : Nothing

//include "loginCheck.php";

//if ($CLnum_rows){
//	switch ($_REQUEST['Version']){
//    case $KEY_RDNET:
/*      $query = "SELECT *"
            	." FROM Contacts"
            	." ORDER BY id ASC ";
*/
      $query = "SELECT *"
            	." FROM Contacts"
            	." WHERE last_sync_date > $lastModifyDate"
            	." ORDER BY id ASC ";
//Note: from sqlSyncAdapter.php line 64: $lastModifyDate = $handler -> clientData.lastSyncDate/1000;
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
	return $sql_result;

//} end if ($CLnum_rows) used for authentication
?>