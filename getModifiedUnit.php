<?php
//include "loginCheck.php";

//if ($CLnum_rows){
//	switch ($_REQUEST['Version']){
//    case $KEY_RDNET:
      $query = "SELECT UniteID, UniteSymbol"
            	." FROM RN_Unite"
            	." ORDER BY UniteID ASC ";
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